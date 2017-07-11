@extends('layouts/master')

@section('heroDiv')
@endsection

@section('sectionTable')
	<div class="table-responsive p-2">
		<h1 class="sub-header">Insert Event</h1>
		<br><br><br>
		@include('layouts/errors')
		<form action="/calendar/store" method="post" enctype="multipart/form-data">
			<div class="col-md-10">
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
			<div class="col-md-2">

				<div class="form-group" id="partecipantsDiv">
					<label for="eventType">Partecipants</label>
					<input type="text" name="partecipant[]" id='serchPartecipant1' class="form-control"><br>
				</div>
				<a class="btn btn-success" id="addPartecipant">
					<small><i class="fa fa-plus" aria-hidden="true"></i></small>
				</a>
			</div>
		</form>
	</div>
	<script>
		$(document).ready(function(){
			var i = 1;
			$('#addPartecipant').click(function(){
				i++; 
				console.log(i);
				$('#partecipantsDiv').append("<input type='text' name='partecipant[]' id='serchPartecipant"+i+"' class='form-control'><br>");
			})

		});
	</script>
	<script>
		//Autocomplete the partecipant field
		$( function() {
			var i = 1;

			do{
				var selector = "#serchPartecipant"+i;
				$(document ).on("keydown", selector, function() {
					$(this).autocomplete({
		    			source: 'http://intranet.dev/calendar/search'
		    		});
				}); 	
		    	i++;	
	    	}while(i < 5)
		});
	</script>
@endsection