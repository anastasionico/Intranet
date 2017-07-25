
@extends('layouts/master')

@section('heroDiv')
<div class="row">
    <div class="col-xs-12 col-md-12">
      <h1 class="page-header">Book a Holiday</h1>
      <i id="bubbleCalendarCreate" class="fa fa-info-circle informationBubble" aria-hidden="true"></i>
    </div>
    <div class="row placeholders">
    	<div class="row placeholders">
    		<div id="piechart" style="width: auto; height: 250px;display: inline-block;padding: 0"></div>
	        
	        
	  	</div>
    	
    </div>
@endsection

@section('sectionTable')
	<div class="table-responsive p-2">
		<?php 
			$holiday_total = $user->holiday_total;
			$holiday_taken = $user->holiday_taken;
		?>
		@include('layouts/errors')
		<form action="/calendar/store" method="post" enctype="multipart/form-data">
			<div class="col-md-9">
				{{ csrf_field() }}
		    	<div class="form-group">
		    		<label for="dateStart">Which day does the holiday start? *</label>
	    			<span style="float: right;">
	    				<span onclick="setToday()" class="btn btn-info btn-sm">Today</span>
			    		<span onclick="setNextWeek()" class="btn btn-info btn-sm">Next Week</span>
			    		<span onclick="setNextMonth()" class="btn btn-info btn-sm">Next Month</span>	
	    			</span>
		    		<input type="date" name="dateStart" class="form-control" id="dateStart" required="">
		    	</div>
		    	<div class="form-group">
		    		<label for="dateStart">Which day does the holiday finish? *</label>
		    		<span style="float: right;">
	    				<span onclick="setToday()" class="btn btn-info btn-sm">Today</span>
			    		<span onclick="setNextWeek()" class="btn btn-info btn-sm">Next Week</span>
			    		<span onclick="setNextMonth()" class="btn btn-info btn-sm">Next Month</span>	
	    			</span>
		    		<input type="date" name="dateStart" class="form-control" id="dateStart" required="">
		    	</div>
		    	<div class="form-group">
		    		<label for="dateStart">Day returning *</label>
		    		<span style="float: right;">
	    				<span onclick="setToday()" class="btn btn-info btn-sm">Today</span>
			    		<span onclick="setNextWeek()" class="btn btn-info btn-sm">Next Week</span>
			    		<span onclick="setNextMonth()" class="btn btn-info btn-sm">Next Month</span>	
	    			</span>
		    		<input type="date" name="dateStart" class="form-control" id="dateStart" required="">
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
					{{ $user->manager_id}}
					<select class="js-example-basic-multiple form-control" multiple="multiple" name='partecipants[]'>
					{{-- 	<option value="{{$user['id']}}">{{$data['name']}} {{$data['surname']}}</option> --}}
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
		
		// allDay.addEventListener("click", setDateEnd );
		// dateStart.addEventListener("change", function(){
		// 	dateEnd.setAttribute("value", dateStart.value);
		// 	dateEnd.setAttribute("min", dateStart.value);
		// 	dateEnd.setAttribute("max", maxDate);
		// } );

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
			console.log(dd)
			dateStart.value = today;
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
	<script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        var holiday_total = {{ $holiday_total }};
        var holiday_taken = {{ $holiday_taken }};
        var holiday_available = holiday_total - holiday_taken;
        console.log(holiday_taken);
        console.log(holiday_available);
        function drawChart() {
            var options = {
            	pieHole: 0.9,
                
                backgroundColor: {
                	fill:'transparent', 
                	strokeWidth: 0,
                },
				
                titleTextStyle: { 
            		color: '#fff',
				  	fontSize: 20,
				  	bold: true,
				},
               	
               	pieSliceBorderColor: 'transparent',
               	colors:['#eee','#55a','#287dd1','#29d251','#d1bd28','#d32a2a','#d1288c'],
               	pieSliceTextStyle: {
                	color: '#fff',
                },

                legend:{
               		position: 'bottom', 
               		textStyle: 
               			{color: '#fff', 
               			fontSize: 16
               		}
               	},
            };
            
            var data = google.visualization.arrayToDataTable([
                ['Holiday', 'unit'],
                ['Taken',  holiday_taken],
                ['Available', holiday_available],
            ]);
            
            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            chart.draw(data, options);
        }
    </script>
@endsection