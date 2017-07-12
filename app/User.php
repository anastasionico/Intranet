<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'img','name','surname',
            'job_title','email','password',
            'username',
            'birthdate','department_id','expenses_mileage_rate','expenses_auth_id',
            'holiday_manager','holiday_total','holiday_taken',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    //All the fields present on the array $dates array will be automatically accessible in the views with Carbon 
    protected $dates = ['created_at', 'updated_at', 'last_login', 'birthdate'];
    
    
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    
    public function events()
    {
        return $this->belongsToMany('App\EventModel', 'event_user', 'user_id', 'event_id')->withPivot('event_id', 'user_id');  // related model, table name, field current model, field joining model
    }
    
    public function task(){
        return $this->hasMany('App\Task');
    }

    public function manager()
    {
        return $this->belongsTo(Department::class, 'manager_id');
    }
    

    public static function updateUser( $request, $id)
    {
        
        //find the user with the selected id
        $user = User::find($id);
        
        //edit all the attribyte of the record with the requested one
        $user->name = $request->input('name');
        $user->surname = $request->input('surname');
        $user->job_title = $request->input('job_title');
        $user->email = $request->input('email');
        $user->username = $request->input('username');
        $user->password = $request->input('password');
        $user->birthdate = $request->input('birthdate');
        $user->department_id = $request->input('department_id');
        $user->expenses_auth_id = $request->input('expenses_auth_id');
        $user->expenses_mileage_rate = $request->input('expenses_mileage_rate');
        $user->holiday_manager = $request->input('holiday_manager');
        $user->holiday_total = $request->input('holiday_total');
        $user->holiday_taken = $request->input('holiday_taken');
        
        //save
        $user->save();
        
        return $user = User::find($id);
        

    }
    
}
