@extends('layouts/master')

@section('heroDiv')
@endsection

@section('sectionTable')
	<div class="p-2">
		<h1 class="sub-header">Edit {{ $role->name }}s Role</h1>
		<form action="/roles/update/{{ $role->id }}" method="post" enctype="multipart/form-data">
			<div class="col-sm-12 col-md-9">
				@include('layouts/errors')
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
		    </div>
		    <div class="col-md-3">
				<h3>Permissions per {{ $role->name }}s</h3>
				@foreach($permissions as $permission)
					@if (in_array($permission->id, $permissionsPerRole))
						<div class="checkbox">
							<label><input type="checkbox" value="{{$permission->id}}" name="permissions[]" checked>{{$permission->slug}}</label>
						</div>		
					@else	
						<div class="checkbox">
							<label><input type="checkbox" value="{{$permission->id}}" name="permissions[]" >{{$permission->slug}}</label>
						</div>		
					@endif
				@endforeach	
		    </div>
	    </form>
   	</div>    
@endsection