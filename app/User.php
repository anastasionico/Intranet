<?php

namespace App;

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
    
    public static function updateUser($id, $request)
    {
        //i need to retriev the user based on the id on the method's attribute, update all the field to the database;
        $user = DB::table('users')->where('id', 100)->get();
        dd($user);
        

    }
}
