@extends('layouts/master')

@section('heroDiv')
	<div class="row">
        <div class="col-xs-12 col-md-12">
            <h1 class="page-header">Roles List</h1>
            <a href="/roles/create" class="btn btn-primary">
                Create new role
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
			<tbody>
	      		@foreach($roles as $role)
	      			@php
	      				if(strlen($role->description) > 25)
	      					$description = substr($role->description,0,50) . " ...";
	      				else{
	      					$description = $role->description;
	      				}
	      			@endphp
					<tr>
				        <td>{{ $role->name }}</td>
				        <td>{{ $description }}</td>
				        <td>
				        	<a href="/roles/{{ $role->id }}" class="btn btn-default">
				        		View
				        	</a>
				        	<a href="/roles/edit/{{ $role->id }}" class="btn btn-info">
				        		Edit
				        	</a>
				        	<a href="/roles/delete/{{ $role->id }}" class="btn btn-danger">
				        		Delete
				        	</a>
				        </td>
				    </tr>
		    	@endforeach
		    </tbody>
	    </table>

	</div>    
@endsection