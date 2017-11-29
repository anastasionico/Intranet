
@extends('layouts/master')

@section('heroDiv')
	<div class="row">
    <div class="col-xs-12 col-md-12">
      <h1 class="page-header">
        @if(Request::segment(2) == 'department' )
          {{ ucfirst($department->name) }}'s Calendar
        @else
          {{ ucfirst($user->name) }} {{ ucfirst($user->surname) }}'s Calendar
        @endif
      </h1>
      
      @permission(('calendar create'))
        <a href="/calendar/create" class="btn btn-primary">
            Create new event
        </a>
      @endpermission

      <div class="form-group" style="margin-top:2em;width: 300px;">
          <select  onchange="location = this.value;" class="form-control">
            <option value="" selected>Choose other user's calendar</option>
            @foreach($users as $user)
              <option value="/calendar/show/{{ $user->id}}"> {{ ucfirst($user->name) }} {{ ucfirst($user->surname) }}</option>
            @endforeach
          </select>  
      </div>
      <div class="form-group" style="margin-top:2em;width: 300px;">
          <select  onchange="location = this.value;" class="form-control">
            <option value="" selected>Choose whole department's calendar</option>
            @foreach($departments as $department)
              <option value="/calendar/department/{{ $department->id}}"> {{ ucfirst($department->name) }}</option>
            @endforeach
          </select>  
      </div>
      
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
      <span class="purple">Training</span>
    </div>  
    
    {!! $calendar->calendar() !!}
    {!! $calendar->script() !!} 
  </div>    
  
  <script type="text/javascript">
    function deleteEvent(id) {
      var confirmation = confirm("Do you want to delete this event?");
      if (confirmation === true) {
        window.location.replace("/calendar/delete/" + id);
      } 
    }
  </script>
@endsection

