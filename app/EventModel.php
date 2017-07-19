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
        $end=date_create($end);
        $end=date_add($end, date_interval_create_from_date_string('1 day'));
        
		$recurringOptions = array(
            'recurring' => $options['recurring'],
            'repeatTo' => $options['repeatTo']
        );

        $eventDates[] = array(
            'start' => $start->format("Y-m-d"),
            'end' => $end->format("Y-m-d"),
        );
        $repeatToTimestamp = strtotime($recurringOptions['repeatTo']);

        //if it is not a single event and it does recurr do a do-while until it reaches the repeatTotimestamp 
        if($recurringOptions['recurring'] != 'null'){
            do{
                $start->add(new \DateInterval($recurringOptions['recurring']));
                $end->add(new \DateInterval($recurringOptions['recurring']));  
                $eventDates[] = array(
                    'start' => $start->format("Y-m-d"),
                    'end' => $end->format("Y-m-d"),
                );
                $startTimestamp = $start->getTimestamp();
                $newdate = date("Y-m-d",$startTimestamp);
            }while($startTimestamp <= $repeatToTimestamp);
        }
        

        foreach ($eventDates as $events) {
            $start = date_create($events['start']);
            $end = date_create($events['end']);
            
            //creation events
            $event = \Calendar::event(
                $title, //event title
                $isAllDay, //full day event?
                $start, //start time, must be a DateTime object or valid DateTime format (http://bit.ly/1z7QWbg)
                $end, //end time, must be a DateTime object or valid DateTime format (http://bit.ly/1z7QWbg),
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
                'start' => $start->format('Y-m-d'),
                'end' => $end->format('Y-m-d'),
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
                $mailDate = date_format($date,"l d F Y");
                $mailMessage = "You have been registered to a new event on $mailDate, Please have a look at you calendar. http://intranet.dev/calendar";
                mail("$email", "Imperial Commercials Intranet - New event " , "$mailMessage");
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
}