@extends('layouts/master')

@section('heroDiv')
	<div class="col-xs-12 col-md-12">
      	<h1 class="page-header">Holiday Request
      		@if( $holiday->approved == 0)
	      		<span class="btn btn-warning">
	      			Pending
	      		</span>
	      	@elseif($holiday->approved == 1)
	      		<span class="btn btn-success">
	      			Approved
	      		</span>	
	      	@else
	      		<span class="btn btn-danger">
	      			denied
	      		</span>		
	      	@endif
		</h1>
		<i id="bubbleHolidayRequest" class="fa fa-info-circle informationBubble" aria-hidden="true"></i>
    </div>
	
@endsection

@section('sectionTable')
	<?php 
		$holiday_total = $user->holiday_total;
		$holiday_taken = $user->holiday_taken; 
		$holiday_available = $holiday_total - $holiday_taken;
		$holiday_outstanding = $user->holiday_outstanding; //previous year
	?>
	<div class="table-responsive  col-sm-12 col-md-5">
		<table class="table table-striped">
	        <tr>
	          	<td>Name</td>
	          	<td>{{ $user->name }}</td>
	        </tr>
	        <tr>
	          	<td>Surname</td>
	          	<td>{{ $user->surname }}</td>
	        </tr>
	        <tr>
	          	<td>Email</td>
	          	<td>{{ $user->email }}</td>
	        </tr>
	        <tr>
	          	<td>Username</td>
	          	<td>{{ $user->username }}</td>
	        </tr>
	        <tr>
	        	<td>Birthday</td>
	          	<td>
	          		@if($user->birthdate !== null)
	          			{{ $user->birthdate->toFormattedDateString() }}
	          		@else
	          			{{ 'ND'}}
	          		@endif	
	        	</td>
	        </tr>
	        <tr>
	          	<td>Department</td>
	          	<td>{{ $department->name }}</td>
	        </tr>
	        <tr>
	          	<td>Job Title</td>
	          	<td>{{ $user->job_title }}</td>
	        </tr>
	        <tr>
	          	<td>Personal Manager</td>
	          	<td>{{ $manager->name }} {{ $manager->surname }}</td>
	        </tr>
	    </table>
	</div>    
	<div class="table-responsive  col-sm-12 col-md-5">
		 <table class="table table-striped">
		 	<?php

		 	?>
	       	<tr>
	          	<td>Request ID</td>
	          	<td>{{ $holiday->id }}</td>
	        </tr>
	        <tr>
	          	<td>Requested</td>
	          	<td>{{ $holiday->created_at->diffForHumans() }}</td>
	        </tr>
	        <tr>
	          	<td>Start</td>
	          	<td>{{ $holiday->start->toFormattedDateString() }}</td>
	        </tr>
	        <tr>
	          	<td>End</td>
	          	<td>{{ $holiday->end->toFormattedDateString() }}</td>
	        </tr>
	        <tr>
	          	<td>Returning</td>
	          	<td>{{ $holiday->returning_day->toFormattedDateString() }}</td>
	        </tr>
	        <tr>
	          	<td>Total Days Requested</td>
	          	<td>{{ $totalDayRequested->d }}</td>
	        </tr>
	        <tr>
	          	<td>Holiday Total Days (per year)</td>
	          	<td>{{ $user->holiday_total }}</td>
	        </tr>
	        <tr>
	          	<td>Holiday Outstanding (previous year)</td>
	          	<td>{{ $user->holiday_outstanding }}</td>
	        </tr>
	        <tr>
	          	<td>Holiday Taken (current year)</td>
	          	<td>{{ $user->holiday_taken }}</td>
	        </tr>
	        <tr>
	          	<td>Holiday Currently Available</td>
	          	<td>{{ ($user->holiday_total + $user->holiday_outstanding) - $user->holiday_taken }}</td>
	        </tr>
	      	<tr>
	          	<td>Total Days Remaining </td>
	          	<td>{{ $totalDayRemaining }}</td>
	        </tr>
	    </table>
	</div>
	<div class="col-sm-12 col-md-2">
		<div id="HolidayOutstandingPie" style="width: 100%; height: auto;display: inline-block;padding: 0"></div>
		<div id="HolidayTotalPie" style="width: 100%; height: auto;display: inline-block;padding: 0"></div>
	</div>
	
	@if($holiday->approved == 0 && Auth::user()->id == $holiday->approved_by)
		<div class="col-sm-12 col-md-12 float-right">
			<div class="col-sm-12 col-md-5">
				<label for="manager">Delegate</label>
				<form action="/holiday/delegate" method="post" class="form-inline">
					<input type="hidden" name="holiday_id" value="{{ $holiday->id}}">
					{{ csrf_field() }}
					<div class="form-group" id="partecipantsDiv">
						<select class="js-example-basic-single form-control" name='manager'>
							@foreach($users as $user => $data)
								@if($data['id'] != $manager->id && $data['id'] != Auth::user()->id && $data['id']!= $holiday->user_id)
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
					<div class="form-group">
			    		<input type="submit" value="submit" class="btn btn-default">
			    	</div>		
				</form>
			</div>
			@permission(('holiday update'))
		        <div class="text-right form-group col-sm-12 col-md-5" id="partecipantsDiv">
					<label for="manager">Response</label><br>
					<a href="/holiday/accept/{{ $holiday->id }}" class="btn btn-success">
						Accept
					</a>
					<a href="/holiday/deny/{{ $holiday->id }}" class="btn btn-danger">
						Decline
					</a>
				</div>
	      	@endpermission
			
			
		</div>
	@endif
	<script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        var holiday_taken = {{ $holiday_taken }};
        var holiday_available = {{ $holiday_available }};
        
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
               		position: 'none', 
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
               		position: 'none', 
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