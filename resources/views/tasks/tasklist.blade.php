<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<title>To do List</title>
	{{-- bootstrap css --}}
	 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">

	 {{-- boostrap script dependencies --}}
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
	 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
</head>
<body>

	<div class="container">
		<div class="col-lg-8 offset-lg-2">
			<form action="/newtask" method="POST">
				
				{{ csrf_field() }}

				<div class="form-group">
					<label for="newtask">New Task:</label>
					<input type="text" name="newtask" id="newtask" class="form-control">
					<button type="submit" class="btn btn-primary"><i class="fa fa-btn fa-plus"></i>Add Task</button>
				</div>
			</form>
			
			@if(Session::has("success_message"))
				<div class="alert">
					{{Session::get("success_message")}}
				</div>
			@endif

			<table class="table table-striped">
				<thead>
					<th>Task</th>
					<th>Created on</th>
					<th>Actions</th>
				</thead>
				<tbody>
					@foreach($tasks as $task)
						<tr>
							<td>{{ $task->name }}</td>	
							<td>{{ $task->created_at->diffForHumans() }}</td>
							<td>
								<button type="button" class= "btn btn-danger" data-toggle="modal" onclick="openDeleteModal({{ $task->id }}, '{{ $task->name }}')">Delete</button>

								<button type="button" class="btn btn-primary" data-toggle="modal" onclick="openEditModal({{ $task->id }}, '{{ $task->name }}')">Edit</button>
							</td>	
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>


	<div id="deleteModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Confirm Delete</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<p id="taskName"></p>
				</div>
				<div class="modal-footer">
					<form id="deleteForm" method="POST">

						{{ csrf_field() }}
						{{ method_field("DELETE") }}

						<button type="submit" class="btn btn-primary"><i class="fa fa-btn fa-trash"></i>Proceed</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					</form>
				</div>
			</div>
		</div>
	</div>


	<div id="editModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Edit Item</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<span id="taskToReplace"></span>
				</div>
				<div class="modal-footer">
					<form id="editForm" method="POST">
						{{ csrf_field() }}
						{{ method_field("PATCH") }}

						<input type="text" name="editedTask">
						<button type="submit" class="btn btn-primary"><i class="fa fa-btn fa-edit"></i>Confirm</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	

	<script>
		function openEditModal(id, name) {
			$("#taskToReplace").html("Do you want to edit task <strong>" + name +"</strong>?")
			$("#editForm").attr("action", "/task/"+id);
			$("#editModal").modal("show");
		}

		function openDeleteModal(id, name){
			$("#taskName").html("Are you sure you want to delete" + name + "?");
			$("#deleteForm").attr("action", "/task/"+id);
			$("#deleteModal").modal("show");
		}
	</script>



</body>
</html>