<ul class="list-group">
	@foreach($errors->all() as $error)
		<li class="list-group-item">{{ $error }}</li>
	@endforeach
</ul>