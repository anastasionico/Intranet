<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Task;
use App\User;


class TasksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$tasks = Task::where('done', '0')->orderBy('priority', 'asc')->get();
        $tasksArchived = Task::where('done', '1')->orderBy('updated_at', 'desc')->limit(10)->get();
        $countTask = Task::countTasks();
        return view('tasks/index', compact(['tasks','tasksArchived','countTask']));
    }

    public function create()
    {
        $users = User::all();
        return view('tasks/create' , compact('users'));
    }

    public function store()
    {
        //validate
        $this->validate(request(),[
            'name' => 'required',
            'description' => 'nullable',
            'priority' => 'integer|nullable',
            'user_id' => 'integer|required'
        ]);

        //save
        Task::create([
            'name' => request('name'),
            'description' => request('description'),
            'priority' => request('priority'),
            'user_id' => request('user_id'),
        ]);
        
        //redirect
        return redirect("/tasks");
    }
    public function edit($id)
    {
		$task = Task::find($id);    	
    	return view('tasks/edit', compact('task'));
    }

    public function update(Request $request, $id)
    {
    	//validate
    	$this->validate(request(),[
    		'name' => 'required',
    		'description' => 'nullable',
    		'priority' => 'integer',
            'user_id' => 'integer|required'
		]);
    	
    	//save
    	$task = Task::find($id);
        $task->name = $request->input('name');
        $task->description = $request->input('description');
        $task->priority = $request->input('priority');
        $task->user_id = $request->input('user_id');
        $task->save();
        
        //redirect
    	return redirect("/tasks");
    }

    public function destroy($id)
    {
        $task = Task::find($id);
        $task->done = 1;
        $task->save();
        return redirect('/tasks');
    }

    
    
}
