<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;
use App\User;
use Illuminate\Support\Facades\Auth;

class EventModel extends Model implements \MaddHatter\LaravelFullcalendar\Event
{
    protected $table = 'events';

    protected $fillable = ['title','allDay','start','end','url','backgroundColor','textColor'];
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['start','end','created_at','update_at'];
    // Implement all Event methods ...

    /**
     * Get the event's id number
     *
     * @return int
     */
    public function users()
    {
        return $this->belongsToMany('App\User', 'event_user', 'event_id', 'user_id')->withPivot('event_id', 'user_id'); // related model, table name, field current model, field joining model
    }

    public static function getId() {
        return $this->id;
    }

    /**
     * Get the event's title
     *
     * @return string
     */

    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Is it an all day event?
     *
     * @return bool
     */
    public function isAllDay()
    {
        return (bool)$this->all_day;
    }

    /**
     * Get the start time
     *
     * @return DateTime
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Get the end time
     *
     * @return DateTime
     */
    public function getEnd()
    {
        return $this->end;
    }

    public static function addEvent($title, $isAllDay, $start, $end, $id = null, $options = [],$partecipants)
    {
        //setting value
        $start=date_create($start);
        $formatstart = date_format($start,"Y-m-d");
        $end=date_create($end);
		$formatend = date_format($end,"Y-m-d");
        $recurring = $options['recurring'];
        
        //$eventDates is an array of all the dates of a selected event
        $eventDates = self::getRecurringDates($recurring, $start, $end);
       
        foreach ($eventDates as $date) {
            $date = date_create($date);
            $formatdate = date_format($date,"Y-m-d");
            
            //creation events
            $event = \Calendar::event(
                $title, //event title
                $isAllDay, //full day event?
                $date, //start time, must be a DateTime object or valid DateTime format (http://bit.ly/1z7QWbg)
                $date, //end time, must be a DateTime object or valid DateTime format (http://bit.ly/1z7QWbg),
                $id, //optional event ID
                [
                    'url' => $options['url'],
                    'backgroundColor' => $options['backgroundColor'],
                    'textColor' => $options['textColor'],
                ]
            );
            $event = EventModel::create([
                'title' => $title,
                'allDay' => $isAllDay,
                'start' => $formatdate,
                'end' => $formatdate,
                //'id' => $id,
                'url' => $options['url'],
                'backgroundColor' => $options['backgroundColor'],
                'textColor' => $options['textColor'],
            ]);

            foreach ($partecipants as $partecipant_id) {
                $event->users()->attach($partecipant_id);
                $partecipantsEmails = User::find($partecipant_id)->pluck('email')->toArray();
            }
            foreach ($partecipantsEmails as $email) {
                mail("$email", "You have a new event" , "New calendar entry $formatdate");
            }
        }
    }

    public static function countTodayEvent()
    {
        $user = User::find(Auth::user()->id);
        return $countTodayEvent = $user->events()
                    ->where([
                        ['events.start', '<=', \DB::raw('curdate()')],
                        ['events.end', '>=', \DB::raw('curdate()')],
                    ])
                    ->count();
    }

    public static function getRecurringDates($recurring, $start, $end){
        if($recurring !== 'null'){
            $interval = new \DateInterval($recurring);
            $dates = new \DatePeriod($start, $interval, $end);
            $out = array();

            if (!empty($dates)) {
                foreach($dates as $dt) {
                    $out[] = array(
                        $dt->format('Y'),
                        $dt->format('m'),
                        $dt->format('d')
                    );
                    // $outRefine += implode(" ",$out);
                }
                foreach ($out as $arrayOfDates) {
                    $outRefine[] = implode("-",$arrayOfDates);
                }
            }
            return $outRefine;
        }else{
            $start =  (array) $start;
            $start= date_create($start['date']);
            $start = date_format($start,"Y-m-d");
            $outRefine[] = $start;
            
            return $outRefine;
        }
    }
}