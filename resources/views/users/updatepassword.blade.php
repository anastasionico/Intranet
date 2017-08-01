@extends('layouts/master')

@section('heroDiv')
	@foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))
          <br><br>
          <div class="alert alert-{{ $msg }}">
            {{ Session::get('alert-' . $msg) }} 
            <i class="fa fa-check" aria-hidden="true"></i>
          </div>  
        @endif
      @endforeach
@endsection

@section('sectionTable')
	<div class="table-responsive p-2">

		<h1 class="sub-header">Update password</h1>
		<div class="col-md-9">
			@include('layouts/errors')
			<form action="/users/updatepassword" method="post">
		    	{{ csrf_field() }}
				<div class="form-group">
		    		<label for="oldPassword">Type your currently password *</label>
		    		<input type="password" name="oldPassword" class="form-control" value="" required>
		    	</div>
		    	<div class="form-group">
		    		<label for="password">Insert a new password *</label>
		    		<input type="range" value="0" min="0" max="100" id="Passwordstrength" style="display: inline-block;width: 150px;" disabled>
		    		<span id="PasswordstrengthText"></span>
		    		<input type="password" name="password" class="form-control" value="" required onkeyup="scorePassword(this)">
		    	</div>
		    	<div class="form-group">
		    		<label for="password_confirmation">confirm the new password *</label>
		    		<input type="password" name="password_confirmation" class="form-control" value="" required>
		    	</div>

		    	<div class="form-group">
		    		<input type="submit" value="submit" class="btn btn-default">
		    	</div>
		    </form>
	    </div>
	</div>    
	<script type="text/javascript">
		function scorePassword(selectObject) {
			var pass = selectObject.value;  
		    var Passwordstrength = document.getElementById('Passwordstrength');
		    var PasswordstrengthText = document.getElementById('PasswordstrengthText');
		    var score = 0;

		    if (!pass)
		        return score;

		    // award every unique letter until 5 repetitions
		    var letters = new Object();
		    for (var i=0; i<pass.length; i++) {
		        letters[pass[i]] = (letters[pass[i]] || 0) + 1;
		        score += 5.0 / letters[pass[i]];
		    }

		    // bonus points for mixing it up
		    var variations = {
		        digits: /\d/.test(pass),
		        lower: /[a-z]/.test(pass),
		        upper: /[A-Z]/.test(pass),
		        nonWords: /\W/.test(pass),
		    }

		    variationCount = 0;
		    for (var check in variations) {
		        variationCount += (variations[check] == true) ? 1 : 0;
		    }
		    score += (variationCount - 1) * 10;
			score = parseInt(score);

			Passwordstrength.value = score;    
			if (score <= 50 ) {
				PasswordstrengthText.className = 'danger';
			    PasswordstrengthText.innerHTML= 'Weak Password';
			} else if (score > 50 && score < 90) {
			    PasswordstrengthText.className = 'warning';
			    PasswordstrengthText.innerHTML= 'Acceptable Password';
			} else if (score >= 90) {
				PasswordstrengthText.className = 'success';
			    PasswordstrengthText.innerHTML= 'Strong Password';
			}
			
		}
	</script>
@endsection