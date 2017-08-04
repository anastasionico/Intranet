@extends('layouts/master')

@section('heroDiv')
@endsection

@section('sectionTable')
	<div class="table-responsive p-2">

		<h1 class="sub-header">Create Permission</h1>
		<div class="col-md-9">
			@include('layouts/errors')
			<form action="/permissions/store" method="post">
		    	{{ csrf_field() }}
				<div class="form-group">
		    		<label for="name">Name *</label>
					<input type="text" name="name" class="form-control" required placeholder="eg: user" id="namePermission" value="">
		    		<small>at least 4 characters</small>
		    	</div>
		    	<div class="form-group">
		    		<label class="checkbox-inline"><input type="checkbox" name="create" onclick="checkboxCreate()" id="createCheckbox" disabled='true'>Create</label>
					<label class="checkbox-inline"><input type="checkbox" name="read" onclick="checkboxRead()" id="readCheckbox" disabled='true'>Read</label>
					<label class="checkbox-inline"><input type="checkbox" name="update" onclick="checkboxUpdate()" id="updateCheckbox" disabled='true'>Update</label>
					<label class="checkbox-inline"><input type="checkbox" name="delete" onclick="checkboxDelete()" id="deleteCheckbox" disabled='true'>Delete</label>
		    	</div>
		    	<div class="form-group">
		    		<label for="description">Description *</label>
		    		<input type="text" name="description" class="form-control" required>
		    	</div>
		    	<div class="form-group">
		    		<input type="submit" value="submit" class="btn btn-default">
		    	</div>
		    </form>
	    </div>
	    <div class="col-md-3">
	    	<small id="permission-text">
	    		Here are the permissions that will be created 
	    	</small>
	    	<ul id="myList" class="list-group">
	    	</ul>
	    </div>
	</div>    
	<script type="text/javascript">
		var createCheckbox = document.getElementById('createCheckbox'),
			readCheckbox = document.getElementById('readCheckbox'),
			updateCheckbox = document.getElementById('updateCheckbox'),
			deleteCheckbox = document.getElementById('deleteCheckbox'),
			namePermission = document.getElementById('namePermission');

		namePermission.addEventListener('keyup',function(){
			if(namePermission.value.length > 3 ){
				createCheckbox.disabled = false;
				readCheckbox.disabled = false;
				updateCheckbox.disabled = false;
				deleteCheckbox.disabled = false;
			}else{
				createCheckbox.disabled = true;
				readCheckbox.disabled = true;
				updateCheckbox.disabled = true;
				deleteCheckbox.disabled = true;
			}
		});

		function checkboxCreate() {
			var namePermission = document.getElementById('namePermission');
		    var createCheckbox = document.getElementById('createCheckbox');
		    var sidetable = document.getElementById('myList');
		    var idName = namePermission.value + '-create'; 

		    if( createCheckbox.checked == true){
	    	 	var li = document.createElement("li");
	    	 	
				li.appendChild(document.createTextNode(idName));
				li.id = idName;
				li.className = "list-group-item";
				sidetable.appendChild(li);
			}else{
				var elem = document.getElementById(idName);
				elem.parentNode.removeChild(elem);
		    }
		}

		function checkboxRead() {
			var namePermission = document.getElementById('namePermission');
		    var readCheckbox = document.getElementById('readCheckbox');
		    var sidetable = document.getElementById('myList');
		    var idName = namePermission.value + '-read'; 

		    if( readCheckbox.checked == true){
	    	 	var li = document.createElement("li");
	    	 	
				li.appendChild(document.createTextNode(idName));
				li.id = idName;
				li.className = "list-group-item";
				sidetable.appendChild(li);
			}else{
				var elem = document.getElementById(idName);
				elem.parentNode.removeChild(elem);
		    }
		}

		function checkboxUpdate() {
			var namePermission = document.getElementById('namePermission');
		    var updateCheckbox = document.getElementById('updateCheckbox');
		    var sidetable = document.getElementById('myList');
		    var idName = namePermission.value + '-update'; 

		    if( updateCheckbox.checked == true){
	    	 	var li = document.createElement("li");
	    	 	
				li.appendChild(document.createTextNode(idName));
				li.id = idName;
				li.className = "list-group-item";
				sidetable.appendChild(li);
			}else{
				var elem = document.getElementById(idName);
				elem.parentNode.removeChild(elem);
		    }
		}

		function checkboxDelete() {
			var namePermission = document.getElementById('namePermission');
		    var deleteCheckbox = document.getElementById('deleteCheckbox');
		    var sidetable = document.getElementById('myList');
		    var idName = namePermission.value + '-delete'; 

		    if( deleteCheckbox.checked == true){
	    	 	var li = document.createElement("li");
	    	 	
				li.appendChild(document.createTextNode(idName));
				li.id = idName;
				li.className = "list-group-item";
				sidetable.appendChild(li);
			}else{
				var elem = document.getElementById(idName);
				elem.parentNode.removeChild(elem);
		    }
		}
	</script>
@endsection