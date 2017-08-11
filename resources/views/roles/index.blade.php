@extends('layouts/master')

@section('heroDiv')
	<div class="row">
        <div class="col-xs-12 col-md-12">
            <h1 class="page-header">Roles List</h1>
            @permission(('role create'))
				<a href="/roles/create" class="btn btn-primary">
	                Create new role
	            </a>        
			@endpermission
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
				        	@permission(('role read'))
								<a href="/roles/{{ $role->id }}" class="btn btn-default">
					        		View
					        	</a>
							@endpermission
							@permission(('role update'))
								<a href="/roles/edit/{{ $role->id }}" class="btn btn-info">
					        		Edit
					        	</a>	
							@endpermission
							@permission(('role delete'))
								<a href="/roles/delete/{{ $role->id }}" class="btn btn-danger">
					        		Delete
					        	</a>
							@endpermission
						</td>
				    </tr>
		    	@endforeach
		    </tbody>
	    </table>

	</div>    
@endsection