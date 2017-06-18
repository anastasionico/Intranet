<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
 	protected $fillable = ['name', 'description', 'priority','user_id'];

 	public function user()
 	{
 		return $this->belongsTo('App\User');
 	}

 	public static function countTasks(){
        return  $countTask = Task::where('user_id', Auth::user()->id)->get();
    }
}
