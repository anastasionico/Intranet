@extends('layouts/master')

@section('heroDiv')
	<div class="row">
    <div class="col-xs-12 col-md-12">
    	<h1 class="page-header p-2">Welcome {{ Auth::user()->name }}</h1>
      <i id="bubbleAdminIndex" class="fa fa-info-circle informationBubble" aria-hidden="true"></i>        
    	<div class="row adminPage">
        <div class="col-sm-6">
            <div class="panel-default panel panelHolidayOutstanding">
              <div class="panel-heading">
                <a href="/holiday">Total amount of vacation days {{ date('Y')}} </a>
              </div>
              <div class="panel-body">
                <div id="HolidayOutstandingPie" style="width: 100%; height: auto;display: inline-block;padding: 0"></div>
    			    </div>
    		   </div>
        </div>
        <div class="col-sm-6">
          <div class="panel-default panel panelHolidayTotal">
            <div class="panel-heading">
              <a href="/holiday">Holiday Summary {{ date('Y')}}</a>
            </div>
    				<div class="panel-body">
       				<div id="HolidayTotalPie" style="width: 100%; height: auto;display: inline-block;padding: 0"></div>
    	  		</div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="panel-default panel panelTask">
            <div class="panel-heading">
              <a href="/tasks">Tasks Summary</a>
            </div>
            <div class="panel-body">
              <div id="TaskPie" style="width: 100%; height: auto;display: inline-block;padding: 0"></div>
    			  </div>
          </div>
        </div>
        <div class="col-sm-6">
            <div class="panel-default panel">
              <div class="panel-heading">
                <a href="/tasks">Task Completed per Day</a>
              </div>
              <div class="panel-body">
                <div id="TaskPieByTime" style="width: 100%; height: auto"></div>
    			    </div>
    		   </div>
        </div>
      </div>
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
               		position: 'right', 
               		textStyle: 
               			{color: '#335', 
               			fontSize: 16,
           			},
               	},
            };
            
            var data = google.visualization.arrayToDataTable([
                ['Holiday', 'unit'],
                ['Days Taken',  holiday_taken],
                ['Days Available', holiday_available],
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
               		position: 'right', 
               		textStyle: 
               			{color: '#335', 
               			fontSize: 16,
           			},
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
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        var task_total = {{ $tasksUser }};
        var task_remaining = {{ $tasksUser }} - {{ $tasksUserDone }} ;
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
               		position: 'right', 
               		textStyle: 
               			{color: '#335', 
               			fontSize: 16,
           			},
               	},
            };
            
            var data = google.visualization.arrayToDataTable([
                ['Holiday', 'unit'],
                ['Task Amount',  task_total],
                ["Task Remaining", task_remaining],
            ]);
            
            var chart3 = new google.visualization.PieChart(document.getElementById('TaskPie'));
            chart3.draw(data, options);
        }
    </script>
    <script type="text/javascript">
    	google.charts.load('current', {'packages':['annotationchart']});
      	google.charts.setOnLoadCallback(drawChart);

      	function drawChart() {
        	var data = new google.visualization.DataTable();
        	data.addColumn('date', 'Date');
        	data.addColumn('number', 'Task Completed');
          data.addRows([	
        		<?php
		     		  $i = 0;
		     		  foreach ($taskDate as $value) {
		     			  $tempo = DateTime::createFromFormat("Y-m-d", $value);
			 	    ?>
		     			  	[new Date({{ $tempo->format("Y") }}, {{ $tempo->format("m") }}, {{ $tempo->format("d") }}), {{$taskCount[$i]}}],
		        <?php	
                $i++;
	     	      };
            ?>
		      ]);
	      	var chart4 = new google.visualization.AnnotationChart(document.getElementById('TaskPieByTime'));

	        var options = {
            // colors:["#eee",'#55a','#287dd1','#29d251','#d1bd28','#d32a2a','#d1288c'],
	          displayAnnotations: true,
            displayZoomButtons: false,
	        };

	        chart4.draw(data, options);
      	}





    </script>
    
@endsection