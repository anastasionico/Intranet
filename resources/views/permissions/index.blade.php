@extends('layouts/master')

@section('heroDiv')
	<div class="row">
        <div class="col-xs-12 col-md-12">
            <h1 class="page-header">Permissions List</h1>
            <a href="/permissions/create" class="btn btn-primary">
                Create new set of Permissions
            </a>        
        </div>
    </div>
	
@endsection

@section('sectionTable')
	<div class="table-responsive p-2">
		<table class="table table-striped usersIndexTable" >
	      	<thead>
		        <tr>
		          	<th>Name</th>
		          	<th>Description</th>
		          	<th>Action</th>
		        </tr>
	      	</thead>
			{{-- {{dd($permissions)}} --}}
	      	<tbody>
	      		@foreach($permissions as $permission)
	      			@php
	      				if(strlen($permission->description) > 25)
	      					$description = substr($permission->description,0,50) . " ...";
	      				else{
	      					$description = $permission->description;
	      				}
	      			@endphp
					<tr>
				        <td>{{ $permission->name }}</td>
				        <td>{{ $description }}</td>
				        <td>
				        	<a href="/permissions/{{ $permission->id }}" class="btn btn-default">
				        		View
				        	</a>
				        	<a href="/permissions/edit/{{ $permission->id }}" class="btn btn-info">
				        		Edit
				        	</a>
				        	<a href="/permissions/delete/{{ $permission->id }}" class="btn btn-danger">
				        		Delete
				        	</a>
				        </td>
				    </tr>
		    	@endforeach

		    </tbody>
	    </table>
	    {{ $permissions->links() }}
	</div>    
@endsection