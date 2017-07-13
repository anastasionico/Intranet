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

        $event = \Calendar::event(
		    $title, //event title
		    $isAllDay, //full day event?
		    $formatstart, //start time, must be a DateTime object or valid DateTime format (http://bit.ly/1z7QWbg)
		    $formatend, //end time, must be a DateTime object or valid DateTime format (http://bit.ly/1z7QWbg),
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
            'start' => $start,
            'end' => $end,
            //'id' => $id,
            'url' => $options['url'],
            'backgroundColor' => $options['backgroundColor'],
            'textColor' => $options['textColor'],
        ]);

        foreach ($partecipants as $partecipant_id) {
            $event->users()->attach($partecipant_id);
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