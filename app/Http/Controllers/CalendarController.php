<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;

class CalendarController extends Controller
{
    public function index()
    {
    	$events = [];

		$events[] = \Calendar::event(
		    "Valentine's Day", //event title
		    true, //full day event?
		    new \DateTime('2017-02-14'), //start time (you can also use Carbon instead of DateTime)
		    new \DateTime('2017-02-15'), //end time (you can also use Carbon instead of DateTime)
			'stringEventId' //optionally, you can specify an event ID
		);

		// $eloquentEvent = EventModel::first(); //EventModel implements MaddHatter\LaravelFullcalendar\Event

		$calendar = \Calendar::addEvents($events) //add an array with addEvents
		    // ->addEvent($eloquentEvent, [ //set custom color fo this event
		    //     'color' => '#800',
		    // ])
		    ->setOptions([ //set fullcalendar options
				'firstDay' => 1
			])
			->setCallbacks([ //set fullcalendar callback options (will not be JSON encoded)
		        // 'viewRender' => 'function() {alert("Callbacks!");}'
		    ]); 

		return view('calendar/index', compact('calendar'));
    }
    public function create()
    {
    	return view('/calendar/create');
    }
}
