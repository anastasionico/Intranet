@extends('layouts/master')

@section('heroDiv')

	<div class="row">
    <div class="col-xs-12 col-md-12">
    	<h1 class="page-header p-2">Hi {{ ucfirst(Auth::user()->name) }}</h1>
      <i id="bubbleAdminIndex" class="fa fa-info-circle informationBubble" aria-hidden="true"></i>        
    	<div class="row adminPage">
        <div class="col-sm-6">
            <div class="panel-default panel panelHolidayOutstanding" id="panelHolidayOutstanding">
              <div class="panel-heading">
                <a href="/holiday">
                  Total amount of holiday days {{ date('Y')}} 
                  <a href="#" data-toggle="tooltip" title="This chart shows how many holidays you are eligible for this year">
                    <i class="fa fa-question-circle" aria-hidden="true"></i>
                  </a>
                </a>
              </div>
              <div class="panel-body">
                <div class="loader"></div>
                <div id="HolidayOutstandingPie" style="width: 100%; height: auto;display: inline-block;padding: 0"></div>
    			    </div>
    		   </div>
        </div>
        <div class="col-sm-6">
          <div class="panel-default panel panelHolidayTotal">
            <div class="panel-heading">
              <a href="/holiday">Holiday Summary {{ date('Y')}}
                <a href="#" data-toggle="tooltip" title="This chart shows the status of your holidays this year">
                  <i class="fa fa-question-circle" aria-hidden="true"></i>
                </a>
              </a>
            </div>
    				<div class="panel-body">
              <div class="loader"></div>
       				<div id="HolidayTotalPie" style="width: 100%; height: auto;display: inline-block;padding: 0"></div>
    	  		</div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="panel-default panel panelTask">
            <div class="panel-heading">
              <a href="/tasks">Tasks Summary</a>
              <a href="#" data-toggle="tooltip" title="This chart shows the status of your tasks">
                <i class="fa fa-question-circle" aria-hidden="true"></i>
              </a>
            </div>
            <div class="panel-body">
              <div class="loader"></div>
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
                <div class="loader"></div>
                <div id="TaskPieByTime" style="width: 100%; height: auto"></div>
    			    </div>
    		   </div>
        </div>
        <div class="col-sm-12">
          <div class="panel-default panel">
            <div class="panel-heading">
              <a href="/tasks">Department Organization Chart</a>
            </div>
            <div class="panel-body">
              <div class="loader"></div>
              <div id="OrgChart"></div>
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
  <script>
    window.addEventListener('load',function(){
      var loaders = document.getElementsByClassName('loader');
      for (var i=0;i<loaders.length;i+=1){
        loaders[i].style.display = 'none';
      }
    });
  </script>    	   
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
                ["Total holidays {{ date('Y')}}: {{ $holiday_total }}",  holiday_total],
                ["Outstanding days {{ date('Y')-1}}: {{ $holiday_outstanding }}", holiday_outstanding],
            ]);
            
            var chart2 = new google.visualization.PieChart(document.getElementById('HolidayOutstandingPie'));
            chart2.draw(data, options);
        }
  </script>
  <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        var task_completed = {{ $tasksUserDone }};
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
                ['Task Completed: {{ $tasksUserDone }}',  task_completed],
                ["Task Remaining: {{ $tasksUser - $tasksUserDone }}", task_remaining],
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
              if(isset($taskDate)){
                foreach ($taskDate as $value) {
                  $tempo = DateTime::createFromFormat("Y-m-d", $value);   
            ?>
		     			  	 [new Date({{ $tempo->format("Y") }}, {{ $tempo->format("m") }}, {{ $tempo->format("d") }}), {{$taskCount[$i]}}],
		        <?php	
                  $i++;
	     	       };
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
  <script type="text/javascript">
    google.charts.load('current', {packages:["orgchart"]});
    google.charts.setOnLoadCallback(drawChart);
    
    function drawChart() {
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Name');
      data.addColumn('string', 'Manager');
      
      // [{v:'Mike', f:'Mike<div style="color:red; font-style:italic">President</div>'},'', 'The President'],



      data.addRows([
        <?php
          foreach ($OrgChart as $OrgChartValue) {
            
            // if(isset($OrgChartValue['manager'])){

              $OrgChartValue['manager']= ($OrgChartValue['manager'] == $OrgChartValue['fullname'])? '' : $OrgChartValue['manager'] ;
          ?>
              [ {v:"<?= $OrgChartValue['fullname'] ?>", f:"<?= $OrgChartValue['fullname'] ." ".$OrgChartValue['title'] ?>" }, "<?= $OrgChartValue['manager'] ?>" ],
          <?php

          }
        ?>
      ]);

      // Create the chart.
      var chart5 = new google.visualization.OrgChart(document.getElementById('OrgChart'));
      // Draw the chart, setting the allowHtml option to true for the tooltips.
      chart5.draw(data, {allowHtml:true});
    }
  </script>
  
@endsection