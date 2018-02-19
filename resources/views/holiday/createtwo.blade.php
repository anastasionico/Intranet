@extends('layouts/master')

@section('heroDiv')
	@php
	  	$dateStart = $dateStart ?? null;
	@endphp

	<div class="row">
    	<div class="col-xs-12 col-md-12">
      		<h1 class="page-header">
      			Book a Holiday
      		@if($dateStart !== null)
     			<span style="font-size: 0.4em;">
     				starting on the {{ $dateStart }}  
     			</span>
     	 	@endif
     	 	@if($dateEnd !== null)
     			<span style="font-size: 0.4em;">
     				ending on the {{ $dateEnd }}  
     			</span>
     	 	@endif
      	</h1>
      	<i id="bubbleHolidayCreate" class="fa fa-info-circle informationBubble" aria-hidden="true"></i>
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
		$holiday_available = $holiday_total - $holiday_taken;
		$holiday_outstanding = $user->holiday_outstanding; //previous year
	?>

	<div class="table-responsive p-2">
		@include('layouts/errors')
		<form action="/holiday/store" method="post" enctype="multipart/form-data">
			
			<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
			<input type="hidden" name="holiday_total" value="{{$holiday_total}}">
			<input type="hidden" name="holiday_taken" value="{{$holiday_taken}}">
			<input type="hidden" name="holiday_available" value="{{$holiday_available}}">
			<input type="hidden" name="holiday_outstanding" value="{{$holiday_outstanding}}">

			<div class="col-md-9">
				{{ csrf_field() }}
				<div class="form-group">
		    		<label for="HalfDay">Half Day</label>
		    		<div>
		    			<input type="radio" name="halfDay" value="am" id="halfDayFLL" checked=""> Full days &nbsp;&nbsp;&nbsp;
		    			<input type="radio" name="halfDay" value="am" id="halfDayAM"> AM &nbsp;&nbsp;&nbsp;
						<input type="radio" name="halfDay" value="pm" id="halfDayPM"> PM
		    		</div>
		    	</div>
		    	<div class="form-group">
		    		<label for="dateStart">Which day does the holiday start? *</label>
		    		<small id='PreviousYearSmall' class="warning"></small>
	    			<span style="float: right;">
	    				<span onclick="setTomorrow()" class="btn btn-info btn-sm">Tomorrow</span>
			    		<span onclick="setNextWeek()" class="btn btn-info btn-sm">Next Week</span>
			    		<span onclick="setNextMonth()" class="btn btn-info btn-sm">Next Month</span>	
	    			</span>
	    			{{ $dateStart }}
		    		<input type="date" name="dateStart" class="form-control" id="dateStart" value="{{ $dateStart }}">

		    	</div>
		    	<div class="form-group">
		    		<label for="dateStart">Which day does the holiday finish? *</label>
		    		<span id="allday_warning" class="hidden">
		    			<small> 
		    				<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
		    				You cannot edit this field if the Full Day option is active.
	    				</small>
		    		</span>
		    		{{-- <span style="float: right;">
	    				<span onclick="setOneWeek()" class="btn btn-info btn-sm">In One Week</span>
			    		<span onclick="setTwoWeeks()" class="btn btn-info btn-sm">In Two Weeks</span>
			    	</span> --}}
			    	{{ $dateEnd }}
		    		<input type="date" name="dateEnd" class="form-control" id="dateEnd" required="" value="{{ $dateEnd }}">
		    	</div>
		    	
		    	<div class="form-group">
		    		<label for="dateReturning">Day returning *</label>
		    		<i id="bubbleHolidayDayReturning" class="fa fa-info-circle Bubble" aria-hidden="true"></i>
		    		<input type="date" name="dateReturning" class="form-control" id="dateReturning" required="">
		    	</div>
				<div class="form-group">
		    		<label for="totalDayRequested">Total Day requested</label>
		    		<small id='totalDayRequestedSmall' class="warning"></small>
		    		<small id='totalDayWeekEndSmall' class="warning"></small>
		    		<small id='totalDayHolidaySmall' class="warning"></small>
		    		<input type="number" name="totalDayRequested" class="form-control" id="totalDayRequested" readonly="">
		    	</div>
		    	<div class="form-group">
		    		<label for="totalDayRemaining">Day remaining after this request (this year)</label>
		    		<span id="dayRemaining_warning" class="hidden">
		    			<small> 
		    				<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
		    				If you remain with less than 0 days the request will not be accepted.
	    				</small>
		    		</span>
		    		<input type="number" name="totalDayRemaining" class="form-control" id="totalDayRemaining" readonly="">
		    	</div>
		    </div>    
		    <div class="col-md-3">
		    	<div class="form-group" id="partecipantsDiv">
					<label for="manager">Manager</label>
					<select class="js-example-basic-single form-control" name='manager'>
						@foreach($users as $user => $data)
							{{-- If the looped user id not the personal manager and is not the current user show the names on the select-option --}}
							@if($data['id'] != $manager->id && $data['id'] != Auth::user()->id && $data['level'] > Auth::user()->level )
								<option value="{{$data['id']}}">
									{{$data['name']}} {{$data['surname']}} 
									@if($data['on_holiday'] == 1)
										<span class="btn btn-info">ON HOLIDAY</span>
									@endif	
								</option>
							@endif
					  	@endforeach

					  	{{-- If the manager is not in holiday show him as selected option --}}
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
				<div class="form-group" id="partecipantsDiv">
					<label for="manager">Book on behalf of</label>
					<select class="js-example-basic-single form-control" name='behalf' onChange="activeBehalf()" id='behalfSelect' >
						<option value="0">Myself</option>
						@foreach($users as $userCompany)
							@if($userCompany['id'] != Auth::user()->id && $userCompany['id'] != $manager->id && $userCompany['level'] <= Auth::user()->level )
								<option value="{{$userCompany['id']}}">
									{{$userCompany['name']}} {{$userCompany['surname']}} 
								</option>
							@endif	
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
			$(".js-example-basic-single").select2();
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
		var dayRemaining_warning = document.getElementById('dayRemaining_warning');
		var totalDayRequested = document.getElementById('totalDayRequested');
		var totalDayRemaining = document.getElementById('totalDayRemaining');
		var halfDayAM = document.getElementById("halfDayAM");
		var halfDayPM = document.getElementById("halfDayPM");
		var maxDate = 2117 + "-" + 12 + "-" + 31;
		
		document.getElementById("totalDayRequested").addEventListener("change", setTotalDayRemaining);
		
		dateStart.addEventListener("change", function(){
			let dateStartYear = dateStart.value.substr(0,4);
			let currentYear = new Date().getFullYear().toString();
			
			if(dateStartYear < currentYear ){
				PreviousYearSmall = document.querySelector('#PreviousYearSmall');
				PreviousYearSmall.innerHTML = "<i class='fa fa-exclamation-triangle' aria-hidden='true'></i> You have selected a year before the current one";
			}else{
				PreviousYearSmall.innerHTML = "";
			}
		});

		dateEnd.addEventListener("change", function(){
			var day = new Date(dateEnd.value);
			var dd = day.getFullYear() + '-' + ("0" + (day.getMonth() + 1)).slice(-2) + '-' + ("0" +  day.getDate() ).slice(-2);
			
			checkWeekday(dd, day);
			setTotalDayRequested();
		});
		window.addEventListener("load", function(){
			var day = new Date(dateEnd.value);
			var dd = day.getFullYear() + '-' + ("0" + (day.getMonth() + 1)).slice(-2) + '-' + ("0" +  day.getDate() ).slice(-2);
			
			checkWeekday(dd, day);
			setTotalDayRequested();

		});
		
		function setTomorrow(){
			var day = new Date();
			day.setDate(day.getDate() + 1);
			var dd = day.getFullYear() + '-' + ("0" + (day.getMonth() + 1)).slice(-2) + '-' + ("0" +  day.getDate() ).slice(-2);
			
			dateStart.value = dd;
			// alertDatePreviousYear();
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
			
			checkWeekday( dd, day);
			setTotalDayRequested();
		}

		function setTwoWeeks(){
			var day = new Date(dateStart.value);
			
			day.setDate(day.getDate() + 14);
			var dd = day.getFullYear() + '-' + ("0" + (day.getMonth() + 1)).slice(-2) + '-' + ("0" +  day.getDate() ).slice(-2);
			dateEnd.value = dd;
			
			checkWeekday(dd, day);
			setTotalDayRequested();
		}

		function checkWeekday(dd, day){

			var dayOfWeek = day.getDay();
			if(dayOfWeek != 0 && dayOfWeek != 6){
				var dayAfter = new Date(dd);
				dayAfter.setDate(dayAfter.getDate() + 1);
				var dayAfterFormatted = dayAfter.getFullYear() + '-' + ("0" + (dayAfter.getMonth() + 1)).slice(-2) + '-' + ("0" +  dayAfter.getDate() ).slice(-2);
				dateReturning.value = dr = dayAfterFormatted;	
			}else{
				while(day.getDay() == 0 || day.getDay() == 6){
					day.setDate(day.getDate() + 1);

					var dr = day.getFullYear() + '-' + ("0" + (day.getMonth() + 1)).slice(-2) + '-' + ("0" +  day.getDate() ).slice(-2);
					
					dateReturning.value = dr;	
				}	
			}
		}
		
		function checkBankHoliday() {
			var dateFrom = dateStart.value;
			var dateTo = dateEnd.value;
			var BankHolidayAmount = 0;
			// THIS VARIABLE BELOW HAS TO BE RENEWED EVERY YEAR
			dateCheck = ["2018-01-01", "2018-03-30", "2018-04-02", "2018-05-07", "2018-05-28", "2018-08-27", "2018-12-25", "2018-12-26",];
			dateCheckLenght = dateCheck.length;
		
			for (i = 0; i < dateCheckLenght; i++) {
				if(dateCheck[i] >= dateFrom && dateCheck[i] <= dateTo){
					// console.log(dateCheck[i] + ' I am in the middle');
					BankHolidayAmount++;
				}
			}
			if(BankHolidayAmount > 0){
				totalDayHolidaySmall = document.querySelector('#totalDayHolidaySmall');
				totalDayHolidaySmall.innerHTML = "<i class='fa fa-exclamation-triangle' aria-hidden='true'></i> " + BankHolidayAmount + " Bank Holiday between the dates, it has been automatically removed from the day requested amount";
			}else{
				totalDayHolidaySmall.innerHTML = "";
			}
			return BankHolidayAmount;
		}
		
		function setTotalDayRequested(){
			var dateS = new Date(dateStart.value);
			var dateE = new Date(dateEnd.value);
			var timeDiff = Math.abs(dateE.getTime() - dateS.getTime());
			var WeekDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
			
			// dateS.setDate(dateS.getDate() + 7);
			// var dd = dateS.getFullYear() + '-' + ("0" + (dateS.getMonth() + 1)).slice(-2) + '-' + ("0" +  dateS.getDate() ).slice(-2);
			
			// dateEnd.value = dd;
			
			//get the total amount of bank Holiday between the two dates and subtract them to the total day requested
			var weeks = Math.floor(WeekDays / 7);
			diffDays = WeekDays - (weeks * 2);
			
			// Handle special cases
		    var startDay = dateS.getDay();
		    var endDay = dateE.getDay();
	     	
	     	// Remove weekend not previously removed.   
		    if (startDay - endDay > 0)         
		    	diffDays = diffDays - 2;      
		    // Remove start day if span starts on Sunday but ends before Saturday
		    if (startDay == 0 && endDay != 6)
		        diffDays = diffDays - 1  
		    // Remove end day if span ends on Saturday but starts after Sunday
		    if (startDay != 0 &&  endDay == 6)
		        diffDays = diffDays - 1  
			
			var BankHolidayAmount = checkBankHoliday();
			
			totalDayRequested.value = (diffDays + 1)  - BankHolidayAmount;
			
			if(WeekDays - diffDays > 0 ){
				totalDayWeekEndSmall = document.querySelector('#totalDayWeekEndSmall');
				totalDayWeekEndSmall.innerHTML = "<i class='fa fa-exclamation-triangle' aria-hidden='true'></i> " + (WeekDays - diffDays) + " Weekend days have been automatically removed.";
			}else{
				totalDayWeekEndSmall.innerHTML = "";
			}
			// console.log(timeDiff);
			if( timeDiff === 0 ){
				totalDayRequested.value = 1;
			}
			
			if(timeDiff === 0 && halfDayAM.checked){
				totalDayRequested.value = 0.5;
				totalDayRequestedSmall = document.querySelector('#totalDayRequestedSmall');
				totalDayRequestedSmall.innerHTML = "<i class='fa fa-exclamation-triangle' aria-hidden='true'></i> When booking only half a day this field shows 0.5";	
			}else{
				totalDayRequestedSmall.innerHTML = "";
			}
		
			if(timeDiff === 0 && halfDayPM.checked){
				totalDayRequested.value = 0.5;
				totalDayRequestedSmall = document.querySelector('#totalDayRequestedSmall');
				totalDayRequestedSmall.innerHTML = "<i class='fa fa-exclamation-triangle' aria-hidden='true'></i> When booking only half a day this field shows 0.5";	
			}else{
				totalDayRequestedSmall.innerHTML = "";
			}
		
			setTotalDayRemaining()
		}

		function setTotalDayRemaining(){
			var totalDayRemainingNum = {{ $holiday_available }} - totalDayRequested.value ;
			if(totalDayRemainingNum >= 0){
				totalDayRemaining.value = totalDayRemainingNum;	
				dayRemaining_warning.className -= " isActive";
			    dayRemaining_warning.className = " danger hidden isHidden ";
				dateEnd.className = ' form-control';
			}else{
				totalDayRemaining.value = 0;
				dayRemaining_warning.className -= " hidden";
			    dayRemaining_warning.className = " danger isActive";
				dateEnd.className = ' form-control warning';
			}
		}

		function activeBehalf(){
			var behalfSelect = document.querySelector('#behalfSelect');
			var confirmationBehalf = confirm("You are booking the holiday on behalf of someont else, Are you sure?");
			if (confirmationBehalf !== true) {
			    behalfSelect.value = null;
			}
		}
	</script>
	<script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        var holiday_taken = {{ $holiday_taken }};
        var holiday_available = {{ $holiday_available }};
        function drawChart() {
            var options = {
            	pieHole: 0.9,
                pieSliceText: 'value',
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
               	// colors:['#eee','#55a','#287dd1','#29d251','#d1bd28','#d32a2a','#d1288c'],
               	colors:['#00ABE6','#004B80','#eee','#29d251','#d1bd28','#d32a2a','#d1288c'],
               	pieSliceTextStyle: {
                	color: '#00ABE6',
                },

                legend:{
               		position: 'bottom', 
               		textStyle: 
               			{color: '#00ABE6', 
               			fontSize: 12
               		}
               	},
            };
            
            var data = google.visualization.arrayToDataTable([
                ['Holiday', 'unit'],
               	['Days Taken: {{ $holiday_taken }}',  holiday_taken],
                ['Days Available: {{ $holiday_available }}', holiday_available],
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
                pieSliceText: 'value',
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
               	colors:['#00ABE6','#004B80','#eee','#29d251','#d1bd28','#d32a2a','#d1288c'],
               	pieSliceTextStyle: {
                	color: '#00ABE6',
                },

                legend:{
               		position: 'bottom', 
               		textStyle: 
               			{color: '#00ABE6', 
               			fontSize: 12
               		}
               	},
            };
            
            var data = google.visualization.arrayToDataTable([
                ['Holiday', 'unit'],
                ["Total holidays {{ date('Y')}}: {{ $holiday_total }}",  holiday_total],
                ["Outstanding days {{ date('Y')-1}}: {{ $holiday_outstanding }}", holiday_outstanding],
            ]);
            
            var chart2 = new google.visualization.PieChart(document.getElementById('HolidayOutstandingPie'));
            chart2.draw(data, options);
        }
    </script>
@endsection