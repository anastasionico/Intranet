<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\User;
use Illuminate\Support\Facades\Auth;

class TasksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$tasks = Task::where('done', '0')
            ->where('user_id', Auth::user()->id)
            ->orderBy('priority', 'asc')
            ->get();
        $tasksArchived = Task::where('done', '1')
            ->where('user_id', Auth::user()->id)
            ->orderBy('updated_at', 'desc')
            ->paginate(5);
        return view('tasks/index', compact(['tasks','tasksArchived','countTask']));
    }

    public function create()
    {
        $users = User::all();
        return view('tasks/create' , compact('users'));
    }

    public function store(Request $request)
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
        $users = User::all();
    	return view('tasks/edit', compact('task','users'));
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
