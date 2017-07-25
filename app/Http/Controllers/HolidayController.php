<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;
use MaddHatter\LaravelFullcalendar\Event;
use Carbon\Carbon;
use App\Holiday;
use App\User;
use Illuminate\Support\Facades\Auth;

class HolidayController extends Controller
{
   	public function index()
    {
        $holidayList = [];
        $user = User::find(Auth::user()->id);
        $holidays = Holiday::all();
        $users = User::all();

        foreach ($holidays as $holiday) {
			$currentEvent = Holiday::find($holiday->id);
    	    $start=date_create($holiday->start);
    	    $formatstart = date_format($start,"Y-m-d");
            $end=date_create($holiday->end);
            $formatend = date_format($end,"Y-m-d");
           	$holiday_user = User::find($holiday->user_id);
           	unset($random_dechex);
            for ($i=0; $i <= 2; $i++) { 
				$random_dechex[] = str_pad( dechex( mt_rand( 50, 205 ) ), 2, '0', STR_PAD_LEFT);
            }
            $random_color = "#". implode('', $random_dechex);
            $holiday_color[$holiday->user_id] = $random_color;
            
			$holidayList[] = \Calendar::event(
                "$holiday_user->name $holiday_user->surname", // $holiday->title, //event title
                1, // $holiday->allDay, //full day event?
                $start, //start time (you can also use Carbon instead of DateTime)
                $end, //end time (you can also use Carbon instead of DateTime)
                $holiday->id, //optionally, you can specify an event ID
                [
                    'user_id' => $holiday_user->id,
                    'backgroundColor' => $holiday_color[$holiday->user_id],
                    'approved' => $holiday->approved,
                ]
            );
        }

        $calendar = \Calendar::addEvents($holidayList);     
        $calendar = \Calendar::setCallbacks([
            'eventRender' => "function(event, element) {
            	if(event.approved == 0){
                    element.addClass('holidayNotConfirmed');	
            	}
            }",
        ]);

        return view('/holiday/index', compact('calendar','holidayList','users'));
    }

    public function create()
    {
        $users = User::all();
        $user = User::find(Auth::user()->id);
        return view('/holiday/create', compact('user','users'));
    }
    
}
