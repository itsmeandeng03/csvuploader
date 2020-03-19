<!DOCTYPE html>
<html lang = "en">
<head>
	<meta charset = "UTF-8">
	<meta name = "viewport" content = "width=device-width, initial-scale=1.0">
	<title> </title>
</head>
<body>
	<?php if ($this->session->flashdata('FieldError')): ?>
		<div class = "alert alert-danger alert-dismissible">
			<a id = "closealert" href = "#" class = "close" data-dismiss = "alert" aria-label = "close"> &times; </a>
			<strong> Error! </strong> <?php echo $this->session->flashdata('FieldError'); ?>
		</div>
	<?php endif; ?>

	<?php if ($this->session->flashdata('AddSuccess')): ?>
		<div class = "alert alert-success alert-dismissible">
			<a id = "closealert" href = "#" class = "close" data-dismiss = "alert" aria-label = "close"> &times; </a>
			<strong> Success! </strong> <?php echo $this->session->flashdata('AddSuccess'); ?>
		</div>
	<?php endif; ?>

	<div class = "container-fluid">
		<button id = "addnewuser" class = "btn btn-default" data-toggle = "modal" data-target = "#newusermodal"><i class = "fa fa-user-plus"></i> New User </button>
	</div><br>

	<div class = "container-fluid">
		<div class = "table-responsive">
			<table id = "userstable" class = "table table-striped table-bordered">
				<thead>
					<tr>
						<td> User Fullname </td>
						<td> Username </td>
						<td> User Role </td>
						<td> Action </td>
					</tr>
				</thead>
				<tbody>
					<?php
						$query = $this->db->query("SELECT * FROM login.login");

						foreach($query->result() as $row) {
					?>

					<tr>
						<td> <?php echo $row->fullname; ?> </td>
						<td> <?php echo $row->username; ?> </td>
						<td> <?php echo $row->userrole; ?>  </td>
						<td>
							<a href = "#" id = "removeuser" class = "btn btn-default" data-toggle = "modal" data-target = "#removeusermodal<?php echo $row->loginid; ?>"><i class = "fa fa-user-times"></i></a>
						</td>
					</tr>

					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>

	<div id = "newusermodal" class = "modal fade" role = "dialog">
		<div class = "modal-dialog">
			<div class = "modal-content">
				<div class = "modal-header">
					<button type = "button" class = "close" data-dismiss = "modal"> &times; </button>
					<h4 class = "modal-title"> New User </h4>
				</div>

				<div class = "modal-body">
					<form action = "Users/AddNewUser" method = "POST">
						<input type = "text" name = "fullname" class = "form-control" placeholder = "User's Full Name"><br>
						<input type = "text" name = "username" class = "form-control" placeholder = "Username"><br>
						<input type = "password" name = "password" class = "form-control" placeholder = "Password"><br>
						<input type = "password" name = "confirmpassword" class = "form-control" placeholder = "Confirm Password"><br>
						<select name = "userrole" id = "userrole" class = "form-control">
							<option> --- User Role --- </option>
							<option value = "Administrator"> Administrator </option>
							<option value = "User"> Normal User </option>
						</select>
				</div>

				<div class = "modal-footer">
						<button id = "submituser" type = "submit" class = "btn btn-default"><i class = "fa fa-check"></i> Submit </button>
						<button id = "closemodal" class = "btn btn-default" data-dismiss = "modal"><i class = "fa fa-times"></i> Close </button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<?php
		$sql = $this->db->query('SELECT * FROM login.login');

		foreach($sql->result() as $row) {
	?>

	<div id = "removeusermodal<?php echo $row->loginid; ?>" class = "modal fade" role = "dialog">
		<div class = "modal-dialog">
			<div class = "modal-content">
				<div class = "modal-header">
					<button type = "button" class = "close" data-dismiss = "modal"> &times; </button>
					<h4 class = "modal-title"> Remove <?php echo $row->fullname; ?> </h4>
				</div>

				<div class = "modal-body">
					<center>
						<p> Are you sure you want to remove <?php echo $row->fullname; ?>? </p>
					</center>
				</div>

				<div class = "modal-footer">
					<a id = "submituser" href = "Users/RemoveUser/<?php echo $row->loginid; ?>" class = "btn btn-default"> Yes </a>
					<button id = "closemodal" type = "button" class = "btn btn-default" data-dismiss = "modal"> No </button>
				</div>
			</div>
		</div>
	</div>

	<?php } ?>

	<script>
		$(document).ready(function() {
			$('#userstable').DataTable();
		});
	</script>
</body>
</html>
