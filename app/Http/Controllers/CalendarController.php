<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;
use MaddHatter\LaravelFullcalendar\Event;
use Carbon\Carbon;
use App\EventModel;
use App\User;
use Illuminate\Support\Facades\Auth;
class CalendarController extends Controller
{
    public function index()
    {
        //instanziate the events array and find all the event of the logged user
        $events = [];
        $user = User::find(Auth::user()->id);
        $event = $user->events()->get();

        foreach ($event as $eve) {
            $currentEvent = EventModel::find($eve->id);
            $userPerEvent = $currentEvent->users()->get(); 
            foreach ($userPerEvent as $use_eve) {
                // echo $use_eve->name. "<br>";
                $partecipants[] = $use_eve->name;

            };
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
                    'backgroundColor' => $eve->backgroundColor,
                    'partecipants' => $partecipants
                ]
            );
            unset($partecipants);
        }
        
        $calendar = \Calendar::addEvents($events);     
        $calendar = \Calendar::setCallbacks([
            'eventRender' => "function(event, element) {
                element.attr('title', event.partecipants);
            }",

        ]);

        return view('/calendar/index', compact('calendar'));
    }

    
    public function create()
    {
    	$users = User::all();
        return view('/calendar/create', compact('users'));
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
    		'eventType' => 'required',
            'recurring' => 'required'
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
            case 'appointment':
                $backgroundColor = '#d1bd28';
                $textColor = '#eee';
                break;
            case 'holiday':
                $backgroundColor = '#d1288c';
                $textColor = '#eee';
                break;        
        }
        $options = [
            'url' => request('url'),
            'backgroundColor' => $backgroundColor,
            'textColor' => $textColor,
            'recurring' => $request->recurring,
            'eventLenght' => $request->eventLenght,
            'repeatTo' => $request->Repeat_to,
        ];
        $partecipants = $request->partecipants;
        
        EventModel::addEvent(request('title'),$allDay,$dateStart,$dateEnd, $id = null, $options, $partecipants);
        //redirect
    	return redirect('/calendar');
    }

    public function search(Request $request)
    {
        //this method search the user in the field select2 in the page calendar/create
        $term = $request->term;
        $users = User::where('name', "LIKE", '%'.$term.'%')->get();
        $searchResult=[];
        if( count($users) == 0){
            $searchResult[] = "no user found";
        }else{
            foreach ($users as $user) {
                $searchResult[] = $user->username;
            }
        }
        return $searchResult;
    }
}