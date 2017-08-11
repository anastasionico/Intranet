@extends('layouts/master')

@section('heroDiv')
	<h1 class="page-header p-2">Users List</h1>
	{{-- <div class="row placeholders">
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
  	</div> --}}
@endsection

@section('sectionTable')
	<div class="table-responsive p-2">
		<table class="table table-striped usersIndexTable" >
	      	<thead>
		        <tr>
		          	<th>Name</th>
		          	<th>Surname</th>
		          	<th>Email</th>
		          	<th>Details</th>
		          	<th>Action</th>
		        </tr>
	      	</thead>
	      	<tbody>
	      		@foreach($users as $user)
					<tr>
				        <td>{{ $user->name }}</td>
				        <td>{{ $user->surname }}</td>
				        <td>{{ $user->email }}</td>
				        <td>
				        	<span class="label label-info">
					        	@php
									switch ($user->level) {
									case 1:
									    echo "Entry";
									    break;
									case 2:
										echo "Supervisor";
									    break;
								    case 3:
										echo "Manager";
									    break;
								    case 4:
										echo "Admin";
									    break;
									}
								@endphp
							</span>
				        	@if($user->on_holiday != 0)
				        		<span class="label label-warning">On Holiday</span>
				        	@endif	
				        </td>
				        <td>
				        	@permission(('user read'))
								<a href="/users/{{ $user->id }}" class="btn btn-default">
					        		View
					        	</a>
							@endpermission
				        	@permission(('user update'))
								<a href="/users/edit/{{ $user->id }}" class="btn btn-info">
					        		Edit
					        	</a>
							@endpermission
							@permission(('user delete'))
								<a href="/users/delete/{{ $user->id }}" class="btn btn-danger">
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