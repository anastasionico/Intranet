@extends('layouts/master')

@section('heroDiv')
	<div class="row">
    <div class="col-xs-12 col-md-12">
      <h1 class="page-header">Calendar</h1>
      <a href="/calendar/create" class="btn btn-primary">
          Create new event
      </a>
      <i id="bubbleCalendarIndex" class="fa fa-info-circle informationBubble" aria-hidden="true"></i>
    </div>
  </div>


    
	{{--
	<div class="row placeholders">
        <div class="col-xs-6 col-sm-3 placeholder">
          	<img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
          	<h4>Label</h4>
          	<span class="text-muted">Something else</span>
        </div>
        <div class="col-xs-6 col-sm-3 placeholder">
          	<img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
          	<h4>Label</h4>
          	<span class="text-muted">Something else</span>
        </div>
        <div class="col-xs-6 col-sm-3 placeholder">
          	<img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
          	<h4>Label</h4>
          	<span class="text-muted">Something else</span>
        </div>
        <div class="col-xs-6 col-sm-3 placeholder">
          	<img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
          	<h4>Label</h4>
          	<span class="text-muted">Something else</span>
    	</div>
  	</div>
  	--}}
@endsection

@section('sectionTable')
  <div class="table-responsive p-2">
    <div>
      Legend: 
      <span class="success">Meeting</span>
      <span class="info">Leisure</span>
      <span class="danger">Conference</span>
      <span class="warning">Appointment</span>
      <span class="purple">Holiday</span>
    </div>  
    
    {!! $calendar->calendar() !!}
    {!! $calendar->script() !!} 
  </div>    
  
@endsection

