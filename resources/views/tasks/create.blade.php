@extends('layouts/master')

@section('heroDiv')
@endsection

@section('sectionTable')
	<div class="table-responsive p-2">
		<h1 class="sub-header">Create task</h1>
		<br><br><br>
		@include('layouts/errors')
		<div class="col-md-9">
			<form action="/tasks/store" method="post">
		    	{{ csrf_field() }}
		    	{{-- method_field('PATCH') --}}
				<div class="form-group">
		    		<label for="name">Name *</label>
		    		<input type="text" name="name" class="form-control" placeholder="insert a new duty" required>
		    	</div>
		    	<div class="form-group">
		    		<label for="description">Description</label>
		    		<textarea name='description' class="form-control" placeholder="inser a description"></textarea>
		    	</div>
		    	<div class="form-group">
		    		<label for="priority">Priority</label>
		    		<input type="number" name="priority" class="form-control" min="1" max="3"  value="3">
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
		    		<input type="submit" value="submit" class="btn btn-primary">
		    	</div>
		    </form>
	    </div>
	</div>    
@endsection