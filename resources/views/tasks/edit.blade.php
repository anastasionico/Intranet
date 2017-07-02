@extends('layouts/master')

@section('heroDiv')
@endsection

@section('sectionTable')
	<div class="table-responsive p-2">
		<h1 class="sub-header">Edit task</h1>
		<p class="sub-header">
			<b>Created:</b>
			{{ $task->created_at->diffForHumans()}}
		</p>
		<a href="/tasks/delete/{{ $task->id }}" class="btn btn-danger">
            Set as Done
        </a>
		<br><br><br>
		@include('layouts/errors')
		<form action="/tasks/update/{{ $task->id }}" method="post">
	    	{{ csrf_field() }}
	    	{{-- method_field('PATCH') --}}
			<div class="form-group">
	    		<label for="name">Name *</label>
	    		<input type="text" name="name" class="form-control" value="{{ $task->name }}" required>
	    	</div>
	    	<div class="form-group">
	    		<label for="description">Description</label>
	    		<textarea name='description' class="form-control">
	    			{{ $task->description }}
    			</textarea>
	    	</div>
	    	<div class="form-group">
	    		<label for="priority">Priority</label>
	    		<input type="number" name="priority" class="form-control" min="1" max="3"  value="{{ $task->priority }}">
	    		<small>1 hight, 2 medium, 3 low</small>
	    	</div>
	    	<div class="form-group">
	    		<label for="user_id">User</label>
	    		<select name="user_id" class="form-control">
	    			@foreach($users as $user)
	    				<option value="{{ $user->id }}">{{ $user->name }}</option>
	    			@endforeach
	    		</select>
	    	</div>
	    	<div class="form-group">
	    		<input type="submit" value="submit" class="btn btn-default">
	    	</div>
	    </form>
	</div>    
@endsection