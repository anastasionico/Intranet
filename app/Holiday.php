<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class Holiday extends Model implements \MaddHatter\LaravelFullcalendar\Event
{
    protected $guarded = [];
    protected $dates = ['created_at', 'updated_at', 'start', 'end', 'returning_day'];

    public function users()
    {
    	return $this->belongsTo("App\User");
    }
	
    /**
     * Get the event's id number
     *
     * @return int
     */
    public function getId() {
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

    public static function countPendingHoliday()
    {
        $user = User::find(Auth::user()->id);
        return  $countPendingHoliday = DB::table('holidays')
                                ->join('users', 'users.id', '=', 'holidays.user_id')
                                ->where('user_id', Auth::user()->id)
                                ->where('approved', 0)
                                ->select('holidays.id', 'holidays.start', 'holidays.end','users.name', 'users.surname')
                                ->get();
    }
    public static function countPendingHolidayRequest()
    {
        $user = User::find(Auth::user()->id);

        return  $countPendingHoliday = DB::table('holidays')
                                ->join('users', 'users.id', '=', 'holidays.user_id')
                                ->where('approved_by', Auth::user()->id)
                                ->where('approved', 0)
                                ->select('holidays.id', 'holidays.start', 'holidays.end','users.name', 'users.surname')
                                ->get();



        return  $countPendingHoliday = Holiday::where('approved_by', Auth::user()->id)
                                ->where('approved', 0)
                                ->get();
    }
}
