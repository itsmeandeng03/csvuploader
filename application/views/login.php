<!DOCTYPE html>
<html lang = "en">
<head>
	<meta charset = "UTF-8">
	<meta name = "viewport" content = "width=device-width, initial-scale=1.0">
	<meta http-equiv = "X-UA-Compatible" content = "ie=edge">
	<title> CSV Upload | Login </title>

	<!-- BOOTSTRAP CSS -->
	<link rel = "stylesheet" href = "assets/bootstrap/css/bootstrap.min.css">
	<!-- FONT AWESOME -->
	<link rel = "stylesheet" href = "assets/fontawesome/css/all.css">
	<!-- STYLES -->
	<link rel = "stylesheet" href = "assets/styles/login.css">
</head>
<body style = "font-family: 'Lucida Sans Unicode', 'Lucida Grande', sans-serif;">
	<div class = "head">
		<center>
			<h1> CVS Upload </h1>
		</center>
	</div>

	<?php if($this->session->flashdata('ErrorLogin')): ?>
		<div class = "alert alert-danger alert-dismissible">
			<a href = "#" class = "close" data-dismiss = "alert" aria-label = "close"> &times; </a>
			<strong> Error! </strong> <?php echo $this->session->flashdata('ErrorLogin'); ?>
		</div>
	<?php endif; ?>

	<center>
		<div class = "container-fluid">
			<div class = "jumbotron">
				<h3> Login Here </h3><br>

				<form action = "Login/LoginUser" method = "POST">
					<input type = "text" name = "username" id = "username" class = "form-control" placeholder = "Username"><br>
					<input type = "password" name = "password" id = "password" class = "form-control" placeholder = "Password"><br><br>

					<button type = "submit" class = "btn btn-default"><i class = "fa fa-sign-in-alt"></i> Login </button>
				</form>
			</div>
		</div>
	</center>

	<!-- JQUERY -->
	<script src = "assets/jquery/jquery.js"></script>
	<!-- BOOTSTRAP JS -->
	<script src = "assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
