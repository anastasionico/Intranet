@extends('layouts/master')

@section('heroDiv')
@endsection

@section('sectionTable')
	<div class="table-responsive p-2">
		<h1 class="sub-header">Insert Event</h1>
		<br><br><br>
		@include('layouts/errors')
		<form action="/calendar/store" method="post" enctype="multipart/form-data">
			<div class="col-md-9">
				{{ csrf_field() }}
		    	<div class="form-group">
		    		<label for="title">Title</label>
		    		<input type="text" name="title" class="form-control"  required>
		    	</div>
		    	<div class="form-group">
		    		<label for="allDay">Full Day *</label>
		    		<input type="checkbox" name="allDay">
		    	</div>
		    	<div class="form-group">
		    		<label for="dateStart">date and hour start</label>
		    		<input type="date" name="dateStart" class="form-control">
		    	</div>
		    	<div class="form-group">
		    		<label for="dateEnd">date and hour end</label>
		    		<input type="date" name="dateEnd"  class="form-control"  >
		    	</div>
		    	<div class="form-group">
		    		<label for="url">U.R.L.</label>
		    		<input type="text" name="url" class="form-control">
		    	</div>
		    	<div class="form-group">
		    		<label for="eventType">Type of event</label>
			    	<select name='eventType' class="form-control">
			    		<option value="meeting">meeting</option>
			    		<option value="leisure">leisure</option>
			    		<option value="conference">conference</option>
			    	</select>
		    	</div>
		    	<div class="form-group">
		    		<input type="submit" value="submit" class="btn btn-default">
		    	</div>
		    </div>    
		    <div class="col-md-3">
		    	<div class="form-group" id="partecipantsDiv">
					<label for="partecipants">Partecipants</label>
					
					<select class="js-example-basic-multiple form-control" multiple="multiple" name='partecipants[]'>
						
						@foreach($users as $user => $data)
							<option value="{{$data['id']}}">{{$data['name']}} {{$data['surname']}}</option>
					  	@endforeach
					</select>
				</div>
			</div>
		</form>
	</div>

	<script type="text/javascript">
		$(document).ready(function() {
			$(".js-example-basic-multiple").select2();
		});
	</script>
@endsection