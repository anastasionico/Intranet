@extends('layouts/master')

@section('heroDiv')
@endsection

@section('sectionTable')
	<div class="table-responsive p-2">
		<h1 class="sub-header">Insert Event</h1>
		<br><br><br>
		@include('layouts/errors')
		<div class="col-md-6">
		<form action="/calendar/store" method="post" enctype="multipart/form-data">
	    	{{ csrf_field() }}
	    	<div class="form-group">
	    		<label for="title">Title</label>
	    		<input type="text" name="title" class="form-control"  required>
	    	</div>
	    	<div class="form-group">
	    		<label for="allDay">Full Day *</label>
	    		<input type="checkbox" name="allDay">
	    	</div>
	    	<div class="form-group">
	    		<label for="dateStart">Inicial date</label>
	    		<input type="datetime-local" name="dateStart">
	    	</div>
	    	<div class="form-group">
	    		<label for="dateEnd">Inicial date</label>
	    		<input type="datetime-local" name="dateEnd">
	    	</div>
	    	<div class="form-group">
	    		<input type="submit" value="submit" class="btn btn-default">
	    	</div>
	    </form>
	</div>    
@endsection