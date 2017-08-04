@extends('layouts/master')

@section('heroDiv')
@endsection

@section('sectionTable')
	<div class="p-2">
		<h1 class="sub-header">Edit {{ $role->name }}s Role</h1>
		<div class="col-sm-12 col-md-9">
			@include('layouts/errors')
			<form action="/roles/update/{{ $role->id }}" method="post" enctype="multipart/form-data">
		    	{{ csrf_field() }}
				<div class="form-group">
		    		<label for="name">Name *</label>
		    		<input type="text" name="name" class="form-control" value="{{ $role->name }}" required>
		    	</div>
		    	<div class="form-group">
		    		<label for="description">Description *</label>
		    		<input type="text" name="description" class="form-control" value="{{ $role->description }}" required>
		    	</div>
		    	<div class="form-group">
		    		<input type="submit" value="submit" class="btn btn-default">
		    	</div>
		    </form>
	    </div>
	    <div class="col-md-3">
	    	<h3>Currently permissions granted for {{ $role->name }}s</h3>
    		@foreach($role->permissions as $permissionUser)
    			<div class="checkbox">
					<label><input type="checkbox" value="{{$permissionUser->id}}" name="permissions[]" checked>{{$permissionUser->slug}}</label>
				</div>		
			@endforeach	

			<h3>Total permissions</h3>
    		@foreach($permissions as $permission)
    			<div class="checkbox">
					<label><input type="checkbox" value="{{$permission->id}}" name="permissions[]">{{$permission->slug}}</label>
				</div>		
			@endforeach	

	    </div>
   	</div>    
@endsection