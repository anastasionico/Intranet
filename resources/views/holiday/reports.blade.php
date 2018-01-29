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
		<table class="table table-striped" >
    		<tr>
    			<th>Name</th>
    			<th>Surname</th>
    			<th>Holiday Outstanding {{ date('Y')-1 }} </th>
    			<th>Total Holiday {{ date('Y')}}</th>
    			<th>Holiday Taken</th>
    			
    			<th>Holiday Available</th>
    		</tr>
    			@foreach($usersDepartment as $userDepartment )
    				@php
    					$holiday_available = ($userDepartment->holiday_total + $userDepartment->holiday_outstanding) - $userDepartment->holiday_taken;
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
    				<tr>
				
	    				<td>{{$userDepartment->name}}

	    				</td>
	    				<td style="text-align: left;">
	    					{{$userDepartment->surname}}
	    					@if($userDepartment->on_holiday == 1)
	    						<span class="btn btn-warning">
					      			Currently in Holiday
					      		</span>
	    					@endif
	    				</td>
	    				<td>{{$userDepartment->holiday_outstanding}} </td>
	    				<td>{{$userDepartment->holiday_total}}</td>
	    				<td>{{$userDepartment->holiday_taken}}</td>
	    				<td style="color:{{ $styleColor }}">
	    					{{$holiday_available }}
    					</td>
    				</tr>
				@endforeach
    	</table>
    </div>
    
  </div>    
  
@endsection

