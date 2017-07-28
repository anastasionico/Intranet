<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;
use MaddHatter\LaravelFullcalendar\Event;
use Carbon\Carbon;
use App\Holiday;
use App\User;
use App\Department;
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
                    'url' => '/holiday/'.$holiday->id,
                    'user_id' => $holiday_user->id,
                    'backgroundColor' => $holiday_color[$holiday->user_id],
                    'approved' => $holiday->approved,
                    'approved_by' => $holiday->approved_by,
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
            'eventClick' => 'function() {
                showModal();
            }'
        ]);

        return view('/holiday/index', compact('calendar','holidayList','users'));
    }

    public function create()
    {
        $users = User::all();
        $user = User::find(Auth::user()->id);
        $manager = User::find($user->manager_id);
        return view('/holiday/create', compact('user','users','manager'));
    }
    
    public function store(Request $request)
    {

        //validation
        $this->validate(request(),[
            'user_id' => 'required|exists:users,id',
            'holiday_total' => 'required|integer',
            'holiday_taken' => 'required||integer|max:'.$request->holiday_total,
            'holiday_available' => 'required|integer|min:1',
            'holiday_outstanding' => 'required|integer',
            'dateStart' => 'required|date|after:today',
            'dateEnd' => 'required|date|after:dateStart',
            'dateReturning' => 'required|date|after:dateStart',
            'totalDayRequested' => 'required|integer|min:1',
            'totalDayRemaining' => 'required|integer|min:0',
            'manager' => 'required|integer'
        ]);
        
        //add user details
        $user=User::where('id',$request->user_id)->first();
                
        //save
        Holiday::create([
            'user_id' => request('user_id'),
            'start' => request('dateStart'),
            'end' => request('dateEnd'),
            'returning_day' => request('dateReturning'),
            'approved_by' => request('manager')
        ]);
        
        //send request via email //notification sent
        
        $request->session()->flash('alert-success', 'The request was successfully sent.');
        return redirect('/holiday');
    }

    public function show($id)
    {
        $users = User::all();
        $holiday = Holiday::find($id);
        $totalDayRequested = $holiday->start->diff($holiday->end);
        $user = User::find($holiday->user_id);

        $manager = User::find($user->manager_id);
        $department = Department::where('id', $user->department_id)->first();
        $totalDayRemaining = (($user->holiday_total + $user->outstanding) - $user->holiday_taken) - $totalDayRequested->d; 

        return view('holiday.show', compact('users', 'user', 'holiday', 'totalDayRequested', 'totalDayRemaining', 'manager', 'department'));
    }

    public function accept($id)
    {
        $holiday = Holiday::find($id);
        $holiday->approved = 1;
        $holiday->save();
        \Session::flash('alert-success', 'You have accepted the holiday request'); 
        // $request->session()->flash('alert-success', '');
        return redirect('/holiday');
    }

    public function deny($id)
    {
        $holiday = Holiday::find($id);
        $holiday->approved = 2;
        $holiday->save();
        \Session::flash('alert-danger', 'This holiday request has been declined'); 
        return redirect('/holiday');
    }

    public function delegate(Request $request)
    {
        $holiday = Holiday::find($request->holiday_id);
        $holiday->approved_by = $request->manager;
        $holiday->save();
        \Session::flash('alert-success', 'This holiday has been delegated'); 
        return redirect('/holiday');   
    }
}

