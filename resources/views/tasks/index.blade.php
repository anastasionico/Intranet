@extends('layouts/master')

@section('heroDiv')
    <div class="row">
        <div class="col-xs-12 col-md-12">
            <h1 class="page-header">Task List</h1>
            @permission(('task create'))
                <a href="/tasks/create" class="btn btn-primary">
                    Create new task
                </a>
            @endpermission
            
            <i id="bubbleTasksIndex" class="fa fa-info-circle informationBubble" aria-hidden="true"></i>        
        </div>
    </div>
    
    {{-- //These are nice layouted graph that can be used in the future
    <div class="row placeholders">
        <div class="col-xs-6 col-sm-3 placeholder">
            <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
            <h4>Label</h4>
            <span class="text-muted">Something else</span>
        </div>
        <div class="col-xs-6 col-sm-3 placeholder">
            <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
            <h4>Label</h4>
            <span class="text-muted">Something else</span>
        </div>
        <div class="col-xs-6 col-sm-3 placeholder">
            <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
            <h4>Label</h4>
            <span class="text-muted">Something else</span>
        </div>
        <div class="col-xs-6 col-sm-3 placeholder">
            <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
            <h4>Label</h4>
            <span class="text-muted">Something else</span>
        </div>
    </div>
     --}}
@endsection

@section('sectionTable')
    <div class="table-responsive p-2">
        @if( count($tasks))
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Priority</th>
                        <th colspan="2" style="min-width:300px;">Created</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $task)
                            <tr>
                                <td>{{ $task->user->name }}</td>
                                <td>{{ ucfirst($task->name) }}</td>
                                <td>{{ $task->description }}</td>
                                <td>
                                    @if($task->priority == 3)
                                        <i class="fa fa-thermometer-empty" aria-hidden="true"></i>
                                    @elseif($task->priority == 2)
                                        <i class="fa fa-thermometer-half" aria-hidden="true"></i>
                                    @elseif($task->priority == 1)
                                        <i class="fa fa-thermometer-full" aria-hidden="true" style="color:#a17f1a;"></i>
                                    @endif
                                </td>
                                <td>
                                    {{$task->created_at->diffForHumans()}}
                                </td>
                                <td>
                                    {{--
                                        <a href="/tasks/{{ $task->id }}" class="btn btn-default">
                                            View
                                        </a>
                                    --}}
                                    @permission(('task update'))
                                        <a href="/tasks/edit/{{ $task->id }}" class="btn btn-info">
                                            Edit
                                        </a>
                                    @endpermission
                                    @permission(('task delete'))
                                        <a href="/tasks/delete/{{ $task->id }}" class="btn btn-danger">
                                            Set as Done
                                        </a>
                                    @endpermission
                                </td>
                            </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="page-header p-2">No task currently available</p>
        @endif   
        @if( count($tasksArchived))
            <h4 class="page-header">Complete Tasks</h4>
            <table class="table table-striped rowTaskArchived">
                <thead>
                    <tr class="rowTaskArchived">
                        <th>User</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Priority</th>
                        <th colspan="2" style="min-width:300px;">Completed</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasksArchived as $taskArchived)
                           <tr class="rowTaskArchived">
                                <td>{{ $taskArchived->user->name }}</td>
                                <td>{{ ucfirst($taskArchived->name) }}</td>
                                <td>{{ $taskArchived->description }}</td>
                                <td>
                                    @if($taskArchived->priority == 3)
                                        <i class="fa fa-thermometer-empty" aria-hidden="true"></i>
                                    @elseif($taskArchived->priority == 2)
                                        <i class="fa fa-thermometer-half" aria-hidden="true"></i>
                                    @elseif($taskArchived->priority == 1)
                                        <i class="fa fa-thermometer-full" aria-hidden="true" style="color:#a17f1a;"></i>
                                    @endif
                                </td>
                                <td colspan="2">
                                    {{$taskArchived->updated_at->diffForHumans()}}
                                </td>
                            </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $tasksArchived->links() }}
        @endif     
    </div>    
@endsection