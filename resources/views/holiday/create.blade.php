
@extends('layouts/master')

@section('heroDiv')
<div class="row">
    <div class="col-xs-12 col-md-12">
      <h1 class="page-header">Book a Holiday</h1>
      <i id="bubbleCalendarCreate" class="fa fa-info-circle informationBubble" aria-hidden="true"></i>
    </div>
    <div class="row placeholders">
    	<div class="row placeholders">
    		<div id="HolidayOutstandingPie" style="width: auto; height: 250px;display: inline-block;padding: 0"></div>
    		<div id="HolidayTotalPie" style="width: auto; height: 250px;display: inline-block;padding: 0"></div>
    	</div>
    </div>
@endsection

@section('sectionTable')
	<?php 
		$holiday_total = $user->holiday_total;
		$holiday_taken = $user->holiday_taken;
		$holiday_outstanding = $user->holiday_outstanding;
	?>
	<div class="table-responsive p-2">
		@include('layouts/errors')
		<form action="/calendar/store" method="post" enctype="multipart/form-data">
			<div class="col-md-9">
				{{ csrf_field() }}
		    	<div class="form-group">
		    		<label for="dateStart">Which day does the holiday start? *</label>
	    			<span style="float: right;">
	    				<span onclick="setTomorrow()" class="btn btn-info btn-sm">Tomorrow</span>
			    		<span onclick="setNextWeek()" class="btn btn-info btn-sm">Next Week</span>
			    		<span onclick="setNextMonth()" class="btn btn-info btn-sm">Next Month</span>	
	    			</span>
		    		<input type="date" name="dateStart" class="form-control" id="dateStart" required="">
		    	</div>
		    	<div class="form-group">
		    		<label for="dateStart">Which day does the holiday finish? *</label>
		    		<i id="bubbleEventEndCreate" class="fa fa-info-circle Bubble" aria-hidden="true"></i>
		    		<span id="allday_warning" class="hidden">
		    			<small> 
		    				<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
		    				You cannot edit this field if the Full Day option is active.
	    				</small>
		    		</span>
		    		<span style="float: right;">
	    				<span onclick="setOneWeek()" class="btn btn-info btn-sm">In One Week</span>
			    		<span onclick="setTwoWeeks()" class="btn btn-info btn-sm">In Two Weeks</span>
			    	</span>
		    		<input type="date" name="dateEnd" class="form-control" id="dateEnd" required="">
		    	</div>
		    	<div class="form-group">
		    		<label for="dateReturning">Day returning *</label>
		    		<input type="date" name="dateReturning" class="form-control" id="dateReturning" required="">
		    	</div>
				<div class="form-group">
		    		<label for="totalDayRequested">Total Day requested</label>
		    		<input type="number" name="totalDayRequested" class="form-control" id="totalDayRequested" value="3" readonly="">
		    	</div>
		    	<div class="form-group">
		    		<label for="totalDayRequested">Day remaining after this request</label>
		    		<input type="number" name="totalDayRequested" class="form-control" id="totalDayRequested" value="4" readonly="">
		    	</div>
		    </div>    
		    <div class="col-md-3">
		    	<div class="form-group" id="partecipantsDiv">
					<label for="manager">Manager</label>
					<select class="js-example-basic-multiple form-control" multiple="multiple" name='manager[]'>
						@foreach($users as $user => $data)
							@if($data['id'] != $manager->id && $data['id'] != Auth::user()->id)
								@if($data['on_holiday'] == 1)
									<option value="{{$data['id']}}">
										{{$data['name']}} {{$data['surname']}} 
										<span class="btn btn-info">ON HOLIDAY</span>
									</option>
								@else
									<option value="{{$data['id']}}">
										{{$data['name']}} {{$data['surname']}} 
									</option>
								@endif
							@endif
					  	@endforeach
					  	@if($manager->on_holiday == 0)
							<option value="{{ $manager->id}}" selected>
								{{ $manager->name}} {{ $manager->surname}}
							</option>
						@else
							<option value="{{ $manager->id}}">
								{{ $manager->name}} {{ $manager->surname}} 
								<span class="btn btn-info">ON HOLIDAY</span>
							</option>
						@endif
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
		function setTomorrow(){
			var day = new Date();
			
			day.setDate(day.getDate() + 1);
			var dd = day.getFullYear() + '-' + ("0" + (day.getMonth() + 1)).slice(-2) + '-' + ("0" +  day.getDate() ).slice(-2);
			
			dateStart.value = dd;
		}
		function setNextWeek(){
			var day = new Date();
			
			day.setDate(day.getDate() + 7);
			var dd = day.getFullYear() + '-' + ("0" + (day.getMonth() + 1)).slice(-2) + '-' + ("0" +  day.getDate() ).slice(-2);
			
			dateStart.value = dd;
		}
		function setNextMonth(){
			var day = new Date();
			
			day.setMonth(day.getMonth()+1);
			var dd = day.getFullYear() + '-' + ("0" + (day.getMonth() + 1)).slice(-2) + '-' + ("0" +  day.getDate() ).slice(-2);
			
			dateStart.value = dd;
		}
		function setOneWeek(){
			var day = new Date(dateStart.value);
			
			day.setDate(day.getDate() + 7);
			var dd = day.getFullYear() + '-' + ("0" + (day.getMonth() + 1)).slice(-2) + '-' + ("0" +  day.getDate() ).slice(-2);
			
			dateEnd.value = dd;
			var dayOfWeek = day.getDay()

			if(dayOfWeek != 0 && dayOfWeek != 6){
				dateReturning.value = dd;		
			}else{
				while(day.getDay() == 0 || day.getDay() == 6){
					day.setDate(day.getDate() + 1);
					var rd = day.getFullYear() + '-' + ("0" + (day.getMonth() + 1)).slice(-2) + '-' + ("0" +  day.getDate() ).slice(-2);
					console.log(rd);
					dateReturning.value = rd;				
				}	
			}
		}
		function setTwoWeeks(){
			var day = new Date(dateStart.value);
			
			day.setDate(day.getDate() + 14);
			var dd = day.getFullYear() + '-' + ("0" + (day.getMonth() + 1)).slice(-2) + '-' + ("0" +  day.getDate() ).slice(-2);
			
			dateEnd.value = dd;
			var dayOfWeek = day.getDay()

			if(dayOfWeek != 0 && dayOfWeek != 6){
				dateReturning.value = dd;		
			}else{
				while(day.getDay() == 0 || day.getDay() == 6){
					day.setDate(day.getDate() + 1);
					var rd = day.getFullYear() + '-' + ("0" + (day.getMonth() + 1)).slice(-2) + '-' + ("0" +  day.getDate() ).slice(-2);
					console.log(rd);
					dateReturning.value = rd;				
				}	
			}
		}
	</script>
	<script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        var holiday_total = {{ $holiday_total }};
        var holiday_taken = {{ $holiday_taken }};
        var holiday_available = holiday_total - holiday_taken;
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
                ['Days Taken',  holiday_taken],
                ['Available', holiday_available],
            ]);
            
            var chart = new google.visualization.PieChart(document.getElementById('HolidayTotalPie'));
            chart.draw(data, options);
        }
    </script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        var holiday_total = {{ $holiday_total }};
        var holiday_outstanding = {{ $holiday_outstanding }};
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
                ['Total Days',  holiday_total],
                ["Outstanding Previous Year", holiday_outstanding],
            ]);
            
            var chart2 = new google.visualization.PieChart(document.getElementById('HolidayOutstandingPie'));
            chart2.draw(data, options);
        }
    </script>
@endsection