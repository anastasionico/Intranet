@extends('layouts/master')

@section('heroDiv')
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
	<div class="table-responsive  col-sm-6 col-md-6">
		
		<h2 class="sub-header">Site Details</h2>
	    <table class="table table-striped">
	        <tr>
	          	<td>Id</td>
	          	<td>{{ $site->id }}</td>
	        </tr>
	        <tr>
	          	<td>Image</td>
	          	<td>{{ $site->img }}</td>
	        </tr>
	        <tr>
	          	<td>Name</td>
	          	<td>{{ $site->name }}</td>
	        </tr>
	        <tr>
	          	<td>Address</td>
	          	<td>{{ $site->address }}</td>
	        </tr>
	        <tr>
	          	<td>Phone</td>
	          	<td>{{ $site->phone }}</td>
	        </tr>
	        <tr>
	          	<td>Company</td>
	          	<td>
	          		<a href="/company/{{ $site->company->id }}">
	          			{{ $site->company->name }}
	          		</a> 
	          	</td>
	        </tr>
	        <tr>
	          	<td>Cost Center First</td>
	          	<td>{{ $site->cost_center_first }}</td>
	        </tr>
	        <tr>
	          	<td>Manufacturer</td>
	          	<td>{{ $site->manufacturer }}</td>
	        </tr>
	        <tr>
	          	<td>Latitude</td>
	          	<td>{{ $site->lat }}</td>
	        </tr>
	        <tr>
	          	<td>Longitude</td>
          		<td>{{ $site->lng }}</td>
	        </tr>
	    </table>
	    <a href="/sites/edit/{{ $site->id }}" class="btn btn-primary">
    		Edit
    	</a>
    	<a href="/sites/delete/{{ $site->id }}" class="btn btn-danger">
    		Delete
    	</a>
	</div>   
@endsection

@section('aside')
	<div class="col-sm-6 col-md-6">
	 	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2470.6008315835347!2d-0.21809768420335915!3d51.740335979674114!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48763ce99afe2a15%3A0xc061303d28d3d5a4!2sS+%26+B+Commercials!5e0!3m2!1sen!2suk!4v1497706974486" 
	 	frameborder="0" style="border:0; width: 100%; height: 400px" allowfullscreen></iframe>
	 	{{-- <div id="map"></div>
	 	<!-- google map api start -->
     	<script>
            function initMap() {
              var uluru = {lat: -25.363, lng: 131.044};
              var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 4,
                center: uluru
              });
              var marker = new google.maps.Marker({
                position: uluru,
                map: map
              });
            }
      	</script> --}}
	</div>
@endsection
