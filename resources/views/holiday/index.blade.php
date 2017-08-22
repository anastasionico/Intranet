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
        <p style="color:{{ $holiday->options['backgroundColor'] }}">
          {{ $holiday->title }} ( from: {{$holiday->start->format('d-M-y')}} to: {{$holiday->end->format('d-M-y')}} )
          @if( $holiday->options['approved'] == 0 && $holiday->options['approved_by'] == Auth::user()->id)
            <a href="/holiday/{{ $holiday->id }}" class="btn btn-xs" style="background-color:{{ $holiday->options['backgroundColor'] }}; color:#fff; ">
              Need Approval
            </a>
          @endif
        </p>
      @endforeach
    </div>  
    
    {!! $calendar->calendar() !!}
    {!! $calendar->script() !!} 
  </div>    
  
@endsection

