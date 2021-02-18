<table  class="table table-striped table-bordered" style="width: 800px;">

	<thead class="thead-light">
		<tr>
			<th scope="col">Name</th>
			<th scope="col" style="width: 150px;">Date</th>
			<th scope="col">Priority</th>
			<th scope="col">Description</th>
			<th scope="col">Action</th>
		</tr>
	</thead>
	<tbody id="tasksTable">
		<?php foreach($tasks as $task): ?>
			<tr id="<?= $task['id']; ?>">
				<td><?= $task['name']; ?></td>
				<td><?= $task['date']; ?></td>
				<td><?= $task['priority']; ?></td>
				<td><?= $task['description']; ?></td>
				<td><button id="<?= $task['id']; ?>" onclick="deleteTask(this.id)" class="btn btn-danger" data-toggle="modal">Delete</button></td>
			</tr>
		<?php endforeach; ?>
	</tbody>

</table>
<div>	
	<input class="form-control search" id="searchTask" type="text" placeholder="Search task">
	<!-- Button trigger modal -->
	<button style="right;" type="button" class="buttonAdd btn btn-primary" data-toggle="modal" data-target="#addTask">
		Add Task
	</button>
	
</div>


<!-- Modal Add-->
<div class="modal fade" id="addTask" tabindex="-1" role="dialog" aria-labelledby="Add Task" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="taskModalLabel">Add Task</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div>
				<form name ="taskInput" action="<?php echo base_url()?>index.php/tasks/add" method="post">
					<div class="form-group">
						<label for="name">Name</label>
						<input type="text" class="form-control" name="name" id="name" placeholder="task name">
					</div>
					<div class="form-group">
						<label for="priority">Priority</label>
						<select class="form-control" name="priority" id="priority">
							<option>1</option>
							<option>2</option>
							<option>3</option>
							<option>4</option>
							<option>5</option>
						</select>
					</div>
					<div class="form-group">
						<label for="description">Description</label>
						<textarea class="form-control" name="description" id="description" rows="3"></textarea>
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

	<!-- Modal Delete-->
	<div class="modal fade" id="deleteTask" tabindex="-1" role="dialog" aria-labelledby="Delete Task" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="taskModalLabel">Are you sure you want to delete this task?</h5>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
					<button type="button" onclick="confirmDeleteTask()" class="btn btn-danger">Yes</button>
				</div>
			</div>
		</div>
	</div>

<script type="text/javascript">

	$('#addTask').on('shown.bs.modal', function () {
		$('#myInput').trigger('focus')
	})

	function deleteTask(taskId)
	{
		$("#deleteTask").modal();
		$("#deleteTask").attr("name", taskId);
	}

	function confirmDeleteTask()
	{
		const taskId=$("#deleteTask").attr("name");

		$.ajax({
                data: {id: taskId},
                url: '<?php echo base_url()?>index.php/tasks/delete',
                type: 'post',
                success: function (response) {
                    if (response) {

                    document.getElementById(response).remove();

                    $("#deleteTask").modal('hide');

                    } else {
                      
                    }
                }
            });
	}

	function createTable(data){
		const tbody=$("#tasksTable");
		tbody.empty();

		for (var i = data.length - 1; i >= 0; i--) {
			tbody.append('<tr id="'+data[i]['id']+'"><td>'+data[i]['name']+'</td><td>'+data[i]['date']+'</td><td>'+data[i]['priority']+'</td><td>'+data[i]['description']+'</td><td><button id="'+data[i]['id']+'" onclick="deleteTask(this.id)" class="btn btn-danger" data-toggle="modal">Delete</button></td></tr>');
		}
		
	}

	var input = document.querySelector('#searchTask');

	input.addEventListener('change', function()
	{
		$.ajax({
                data: {name: input.value},
                dataType: 'json',
                url: '<?php echo base_url()?>index.php/tasks/search',
                type: 'post',
                success: function (response) {
                    if (response) {
                  	createTable(response);
                   	
                    } else {
                     
                    }
                }
            });
		
	});

</script>