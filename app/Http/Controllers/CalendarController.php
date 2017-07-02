<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;
use MaddHatter\LaravelFullcalendar\Event;
use Carbon\Carbon;
use App\EventModel;



class CalendarController extends Controller
{
    public function index()
    {
        $events = [];
        $event = EventModel::all();

        foreach ($event as $eve) {
            $start=date_create($eve->start);
            $formatstart = date_format($start,"Y-m-d");
            $end=date_create($eve->end);
            $formatend = date_format($end,"Y-m-d");
            $events[] = \Calendar::event(
                $eve->title, //event title
                $eve->allDay, //full day event?
                $start, //start time (you can also use Carbon instead of DateTime)
                $end, //end time (you can also use Carbon instead of DateTime)
                $eve->id, //optionally, you can specify an event ID
                [
                    'textColor' => $eve->textColor,
                    'url' => $eve->url,
                    'backgroundColor' => $eve->backgroundColor
                ]
             
            );
        }


        
        $calendar = \Calendar::addEvents($events);     
        
        return view('/calendar/index', compact('calendar'));
    }

    
    public function create()
    {
    	return view('/calendar/create');
    }

    public function store(Request $request)
    {
    	
        //valitation
    	$this->validate(request(),[
    		'title' => 'required',
    		'allDay' => 'nullable',
    		'dateStart' => 'required',
    		'dateEnd' => 'nullable',
    		'url' => 'nullable|url',
    		'eventType' => 'required'
		]);

        //set specific data
    	if(request('allDay') == 'on' ){
    		$allDay = true;	
    		$dateStart = request('dateStart');
    		$dateEnd = request('dateStart');
    	}else{
    		$allDay = false;	
    		$dateStart = request('dateStart');
    		$dateEnd = request('dateEnd');
    	}
        
    	switch (request('eventType')) {
            case 'meeting':
                $backgroundColor = '#29d251';
                $textColor = '#eee';
                break;
            case 'leisure':
                $backgroundColor = '#287dd1';
                $textColor = '#eee';
                break;
            case 'conference':
                $backgroundColor = '#d32a2a';
                $textColor = '#eee';
                break;
        }

        $options = [
            'url' => request('url'),
            'backgroundColor' => $backgroundColor,
            'textColor' => $textColor,
        ];



        EventModel::addEvent(request('title'),$allDay,$dateStart,$dateEnd, $id = null, $options);

        //redirect
    	return redirect('/calendar');
    }
}
