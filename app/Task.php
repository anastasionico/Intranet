<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Task extends Model
{
 	protected $fillable = ['name', 'description', 'priority','user_id'];

 	public function user()
 	{
 		return $this->belongsTo('App\User');
 	}

 	public static function countTasks(){
        return  $countTask = Task::where('user_id', Auth::user()->id)
        						->where('done', 0)
        						->count();
    }
}
