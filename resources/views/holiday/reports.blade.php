@extends('layouts/master')

@section('heroDiv')
  <style type="text/css">
   
   
    
  </style>
	<div class="row">
    
        <div class="col-xs-12 col-md-12">
          <h1 class="page-header">
            Reports
          </h1>

        </div>  
        <div class="table-responsive p-2">
       	    <table class="table table-striped">
                <thead>
            		<tr>
                        <th></th>
            			<th>Name</th>
            			<th>Surname</th>
            			<th>Holiday Outstanding {{ date('Y')-1 }} </th>
            			<th>Total Holiday {{ date('Y')}}</th>
            			<th>Holiday Taken</th>
            			<th>Holiday Available</th>
            		</tr>
                </thead>
        			@foreach($holidaysPerUser as $holidayPerUser )
        				@php
        					$holiday_available = ($holidayPerUser->holiday_total + $holidayPerUser->holiday_outstanding) - $holidayPerUser->holiday_taken;
        					switch ($holiday_available) {
        						case $holiday_available < 5:
        							$styleColor= '#d32a2a';
        							break;
        						case $holiday_available < 10:
        							$styleColor= '#d1bd28';
        							break;
    							case $holiday_available >= 10:
        							$styleColor= '#29d251';
        							break;
        					}
        				@endphp
        				<tr onclick='showRows({{$holidayPerUser->id}})' style="cursor: pointer;">
    				        <td>
                                <i class="fa fa-toggle-off user-{{$holidayPerUser->id}}"></i>            
                            </td>
                            <td>
                                <span >
                                    {{$holidayPerUser->name}}
                                    
                                </span>
                            </td>
    	    				<td style="text-align: left;">
    	    					{{$holidayPerUser->surname}}
    	    					@if($holidayPerUser->on_holiday == 1)
    	    						<span class="btn btn-warning">
    					      			Currently in Holiday
    					      		</span>
    	    					@endif
    	    				</td>
    	    				<td>{{$holidayPerUser->holiday_outstanding}} </td>
    	    				<td>{{$holidayPerUser->holiday_total}}</td>
    	    				<td>{{$holidayPerUser->holiday_taken}}</td>
    	    				<td style="color:{{ $styleColor }}">
    	    					{{$holiday_available }}
        					</td>
                        </tr>
                        <tr class="hidden user-{{$holidayPerUser->id}}"  style="background:#292945">
                            <th>ID</th>
                            <th>Requested</th>
                            <th>Start</th>
                            <th>End</th>
                            <th>Returning Day</th>
                            <th>Total Day Requested</th>
                            <th>Approved</th>
                        </tr>
                        @foreach($holidayPerUser->holiday as $singleHolidayPerUser )
                            <tr class="hidden user-{{$holidayPerUser->id}}" style="background:#292945; cursor: pointer;" onclick='showHoliday({{$singleHolidayPerUser->id}})'>
                                <td>{{$singleHolidayPerUser->id}}</td>
                                <td>{{ $singleHolidayPerUser->created_at->diffForHumans() }}</td>
                                <td>{{$singleHolidayPerUser->start->toFormattedDateString()}}</td>
                                <td style="text-align: left">{{$singleHolidayPerUser->end->toFormattedDateString()}}</td>
                                <td>{{$singleHolidayPerUser->returning_day->toFormattedDateString()}}</td>
                                <td>{{$singleHolidayPerUser->total_day_requested}}</td>
                                <td>
                                    @if( $singleHolidayPerUser->approved == 0)
                                        <span class="btn btn-warning btn-sm">
                                            Pending
                                        </span>
                                    @elseif($singleHolidayPerUser->approved == 1)
                                        <span class="btn btn-success  btn-sm">
                                            Approved
                                        </span> 
                                    @else
                                        <span class="btn btn-danger btn-sm">
                                            Denied
                                        </span>     
                                    @endif
                                </td>
                            </tr>    
                        @endforeach
                    @endforeach
        	</table>
        </div>
        
    </div>    
  <script type="text/javascript">
    function showRows(id) {
        let text = ".hidden .user-"+id;

        let rows = document.querySelectorAll("tr.user-"+id);
        let toggle = document.querySelector(".fa.user-"+id);
        Array.from(rows).forEach(function(row){
            if( row.classList.contains('hidden')){
                toggle.className = "fa fa-toggle-on user-"+id;
                row.classList.remove('hidden');
            }else{
                toggle.className = "fa fa-toggle-off user-"+id;
                row.classList.add('hidden');
            }
        });
    }
    function showHoliday(id){
        window.location.href = '/holiday/'+id;
        end();
    }


</script>
@endsection


