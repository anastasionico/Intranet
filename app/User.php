<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use App\Role;

class User extends Authenticatable
{
    use Notifiable;
    use EntrustUserTrait; // add this trait to your user model
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'img','name','surname',
            'role_id','email','password',
            'username',
            'birthdate','department_id','expenses_mileage_rate','manager_id','holiday_total','holiday_taken','level','on_holiday'
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
    
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    
    public function events()
    {
        return $this->belongsToMany('App\EventModel', 'event_user', 'user_id', 'event_id')->withPivot('event_id', 'user_id');  // related model, table name, field current model, field joining model
    }

    public function holiday()
    {
        return $this->hasMany('App\Holiday');
    }
    
    public function task()
    {
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
        $roleNew = Role::find($request->input('role_id'));

        //edit all the attribyte of the record with the requested one
        $user->name = $request->input('name');
        $user->surname = $request->input('surname');
        $user->role_id = $request->input('role_id');
        $user->level = $request->input('level');
        $user->email = $request->input('email');
        $user->username = $request->input('username');
        $user->birthdate = $request->input('birthdate');
        $user->department_id = $request->input('department_id');
        $user->expenses_mileage_rate = $request->input('expenses_mileage_rate');
        $user->manager_id = $request->input('manager_id');
        $user->holiday_total = $request->input('holiday_total');
        $user->holiday_taken = $request->input('holiday_taken');
        //the following are command for Entrust
        
        $role = $user->roles()->where("user_id", $user->id)->first();
        $user->roles()->detach($role);
        $user->attachRole($roleNew->id);
        
        $user->save();
        
        return $user = User::find($id);
    }
}
