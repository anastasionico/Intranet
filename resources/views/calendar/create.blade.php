@extends('layouts/master')

@section('heroDiv')
<div class="row">
    <div class="col-xs-12 col-md-12">
      <h1 class="page-header">Create a new event</h1>
      <i id="bubbleCalendarCreate" class="fa fa-info-circle informationBubble" aria-hidden="true"></i>
    </div>
@endsection

@section('sectionTable')
	<div class="table-responsive p-2">
		@include('layouts/errors')
		<form action="/calendar/store" method="post" enctype="multipart/form-data">
			<div class="col-md-9">
				{{ csrf_field() }}
		    	<div class="form-group">
		    		<label for="title">Title* </label>
		    		<input type="text" name="title" class="form-control"  required>
		    	</div>
		    	<div class="form-group">
		    		<label for="dateStart">Which day is the event start? * </label>
		    		<input type="date" name="dateStart" class="form-control" id="dateStart" required="">
		    	</div>
		    	<div class="form-group">
		    		<label for="allDay">Full Day *</label>
		    		<input type="checkbox" name="allDay" id="allDay" >
		    	</div>
		    	<div class="form-group">
		    		<label for="dateEnd">Event ends</label>
		    		<span id="allday_warning" class="hidden">
		    			<small> 
		    				<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
		    				You cannot edit this field if the Full Day option is active.
	    				</small>
		    		</span>
		    		<input type="date" name="dateEnd"  class="form-control" id="dateEnd">
		    	</div>
		    	<div class="form-group">
		    		<label for="url">External Link</label>
		    		<input type="text" name="url" class="form-control" placeholder="https://www.imperialcommercials.co.uk/">
		    	</div>
		    	<div class="form-group">
		    		<label for="eventType">Type of event</label>
			    	<select name='eventType' class="form-control">
			    		<option value="meeting">Meeting</option>
			    		<option value="leisure">Leisure</option>
			    		<option value="conference">Conference</option>
			    		<option value="appointment">Appointment</option>
			    	</select>
		    	</div>
		    	<div class="form-group">
		    		<label for="eventType">Type of event</label>
			    	<select name="recurring"  class="form-control">
						<option value="null" selected="">Single event</option>
						<option value="P1D">Daily</option>
						<option value="P7D">Weekly</option>
						<option value="P1M">Monthly</option>
						<option value="P3M">Every 3 months</option>
						<option value="P6M">Every 6 months</option>
						<option value="P1Y">Annually</option>
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

	<script>
		$(document).ready(function() {
			$(".js-example-basic-multiple").select2();
		});
	</script>

	<script type="text/javascript">
		var allDay = document.getElementById('allDay');
		var dateStart = document.getElementById('dateStart');
		var dateEnd = document.getElementById('dateEnd');
		var allday_warning = document.getElementById('allday_warning');
		var maxDate = 2117 + "-" + 12 + "-" + 31;

		allDay.addEventListener("click", setDateEnd );
		dateStart.addEventListener("change", function(){
			dateEnd.setAttribute("value", dateStart.value);
			dateEnd.setAttribute("min", dateStart.value);
			dateEnd.setAttribute("max", maxDate);
		} );
		
		function setDateEnd(){
			if(allDay.checked) {
			    dateEnd.value = dateStart.value;
			    dateEnd.readOnly = true;
			    allday_warning.className -= " hidden";
			    allday_warning.className = " warning isActive";
			} else {
				
				dateEnd.readOnly = false;
			    allday_warning.className -= " isActive";
			    allday_warning.className = " warning isHidden ";
			    setTimeout(function() {
				    allday_warning.className += " hidden ";
				}, 300);
			}
		}
		

	</script>
@endsection