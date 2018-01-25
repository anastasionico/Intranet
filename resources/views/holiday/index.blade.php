@extends('layouts/master')

@section('heroDiv')
	<div class="row">
    
    <div class="col-xs-12 col-md-12">
      <h1 class="page-header">
        Holiday
        @if(isset($department))
          {{$department->name}} Department
        @endif
      </h1>
      
     
      
      @permission(('holiday create'))
        <a href="/holiday/create" class="btn btn-primary">
            Book a Holiday
        </a>
      @endpermission
      <div class="form-group" style="margin-top:2em;width: 300px;">
          <select  onchange="location = this.value;" class="form-control">
            <option value="" selected>Choose whole department's plan</option>
            @foreach($departments as $department)
              <option value="/holiday/dept/{{ $department->id}}"> {{ ucfirst($department->name) }}</option>
            @endforeach
          </select>  
      </div>
      <i id="bubbleHolidayIndex" class="fa fa-info-circle informationBubble" aria-hidden="true"></i>
      <br>
      @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))
          <br><br>
          <div class="alert alert-{{ $msg }}">
            {{ Session::get('alert-' . $msg) }} 
            <i class="fa fa-check" aria-hidden="true"></i>
          </div>  
        @endif
      @endforeach
    
      @if(Session::has('alert-store-success'))
        <p class="btn btn-success">
          {{ Session::get('alert-store-success') }} 
          <i class="fa fa-check" aria-hidden="true"></i>
        </p>  
      @endif

    </div>
  
  </div>


    
	
	{{-- <div class="row placeholders">
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
  	</div> --}}
  	
@endsection

@section('sectionTable')
  <div class="table-responsive p-2">
    <div>
      Legend: 
      
      @foreach($holidayList as $holiday)  
        <br>
        @if($holiday->start->format('m') === date('m') || $holiday->end->format('m') === date('m'))
          <a href="/holiday/{{ $holiday->id }}" style="color:{{ $holiday->options['backgroundColor'] }}">
          
            {{ $holiday->title }} {{-- ( from: {{$holiday->start->format('d-M-y')}} to: {{$holiday->end->format('d-M-y')}} ) --}}
            @if( $holiday->options['approved'] == 0)
              <span class="btn btn-xs" style="background-color:{{ $holiday->options['backgroundColor'] }}; color:#fff; ">
                Need Approval
              </span>
            @endif
            @if( $holiday->options['approved'] == 2)
              <span class="btn btn-xs" style="background-color:{{ $holiday->options['backgroundColor'] }}; color:#aaa;opacity: 0.5 ">
                Denied
              </span>
            @endif
            @if( $holiday->options['halfDay'] == 0.5)
              <span class="btn btn-xs" style="background-color:{{ $holiday->options['backgroundColor'] }}; color:#fff;" >
              Half Day
              </span>
            @endif
            
          </a>
        @endif
        
      @endforeach

    </div>  
    <br>
    {!! $calendar->calendar() !!}
    {!! $calendar->script() !!} 
  </div>    
  
@endsection

