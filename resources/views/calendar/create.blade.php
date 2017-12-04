
@extends('layouts/master')

@section('heroDiv')
@php
  	$dateStart = $dateStart ?? null;
@endphp
<div class="row">
    <div class="col-xs-12 col-md-12">
     	<h1 class="page-header">Create a new event
     		
     		@if($dateStart !== null)
     			<span style="font-size: 0.5em;">
     				on the {{ $dateStart }}  
     			</span>
     	 	@endif
     	</h1>
    	
    


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
		    		<label for="title">Title *</label>
		    		<input type="text" name="title" class="form-control"  required>
		    	</div>
		    	<div class="form-group">
		    		<label for="eventType">Type of event *</label>
			    	<select name='eventType' class="form-control">
			    		<option value="meeting">Meeting</option>
			    		<option value="leisure">Leisure</option>
			    		<option value="conference">Conference</option>
			    		<option value="appointment">Appointment</option>
			    		<option value="training">Training</option>
			    	</select>
		    	</div>
		    	<div class="form-group">
		    		<label for="url">External Link</label>
		    		<input type="text" name="url" class="form-control" placeholder="https://www.imperialcommercials.co.uk/">
		    	</div>
		    	<div class="form-group">
		    		<label for="eventType">Recurring *</label>
			    	<select name="recurring"  class="form-control" id="selectRecurring" onchange="showFieldRecurring()">
						<option value="null" selected>Single event</option>
						<option value="P7D">Weekly</option>
						<option value="P1M">Monthly</option>
						<option value="P3M">Every 3 months</option>
						<option value="P6M">Every 6 months</option>
						<option value="P1Y">Annually</option>
					</select>
				</div>
				
		    	<div class="form-group">
		    		<label for="dateStart">Which day is the event start? *</label>
		    			<span style="float: right;">
		    				<span onclick="setToday()" class="btn btn-info btn-sm">Today</span>
				    		<span onclick="setNextWeek()" class="btn btn-info btn-sm">Next Week</span>
				    		<span onclick="setNextMonth()" class="btn btn-info btn-sm">Next Month</span>	
		    			</span>
		    		<input type="date" name="dateStart" class="form-control" id="dateStart" required="" value="{{ $dateStart }}">
		    	</div>

		    	<div class="form-group">
		    		<label for="allDay">Full Day</label>
		    		<input type="checkbox" name="allDay" id="allDay" >
		    	</div>
		    	<div class="form-group" id="dateEndDiv">
		    		<label for="dateEnd">Event ends *</label>
					<i id="bubbleEventEndCreate" class="fa fa-info-circle Bubble" aria-hidden="true"></i>
		    		<span id="allday_warning" class="hidden">
		    			<small> 
		    				<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
		    				You cannot edit this field if the Full Day option is active.
	    				</small>
		    		</span>
		    		<input type="date" name="dateEnd"  class="form-control" id="dateEnd">
		    	</div>
		    	<div class="form-group" id="repeatToDiv">
		    		<label for="Repeat_to">Repeat until* </label>
		    		<input type="date" name="Repeat_to" class="form-control" id="Repeat_to">
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
			<div class="col-md-12">
				<div class="form-group">
		    		<input type="submit" value="submit" class="btn btn-default">
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
		var eventLenghtDiv = document.getElementById('eventLenghtDiv');
		var repeatToDiv = document.getElementById('repeatToDiv');
		var selectRecurring = document.getElementById('selectRecurring');
		var allDay = document.getElementById('allDay');
		var dateStart = document.getElementById('dateStart');
		var dateEndDiv = document.getElementById('dateEndDiv');
		var dateEnd = document.getElementById('dateEnd');
		var selectRecurring = document.getElementById('selectRecurring');
		var allday_warning = document.getElementById('allday_warning');
		var maxDate = 2117 + "-" + 12 + "-" + 31;
		
		allDay.addEventListener("click", setDateEnd );
		dateStart.addEventListener("change", function(){
			dateEnd.setAttribute("value", dateStart.value);
			dateEnd.setAttribute("min", dateStart.value);
			dateEnd.setAttribute("max", maxDate);
		} );

		function showFieldRecurring(){
			if(selectRecurring.value == 'null'){
				repeatToDiv.style.display='none';	
			}else{
				repeatToDiv.style.display='block';	
			}
		}
		function setToday(){
			var today = new Date();
			var dd = today.getFullYear() + '-' + ("0" + (today.getMonth() + 1)).slice(-2) + '-' + today.getDate();
			dateStart.value = dd;
		}
		function setNextWeek(){
			var today = new Date();
			var dd = today.getFullYear() + '-' + ("0" + (today.getMonth() + 1)).slice(-2) + '-' + (today.getDate()+7);
			dateStart.value = dd;
		}
		function setNextMonth(){
			var today = new Date();
			var dd = today.getFullYear() + '-' + ("0" + (today.getMonth() + 2)).slice(-2) + '-' + today.getDate();
			dateStart.value = dd;
		}
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