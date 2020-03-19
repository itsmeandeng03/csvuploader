<!DOCTYPE html>
<html lang = "en">
<head>
	<meta charset = "UTF-8">
	<meta name = "viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv = "X-UA-Compatible" content =" ie=edge">
	<title> CVS File Upload </title>

	<!-- BOOTSTRAP CSS -->
	<link rel = "stylesheet" href = "<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
	<!-- FONT AWESOME -->
	<link rel = "stylesheet" href = "<?php echo base_url(); ?>assets/fontawesome/css/all.css">
	<!-- STYLE -->
	<link rel = "stylesheet" href = "<?php echo base_url(); ?>assets/styles/navbar.css">
	<link rel = "stylesheet" href = "<?php echo base_url(); ?>assets/styles/manageusers.css">
	<link rel = "stylesheet" href = "<?php echo base_url(); ?>assets/styles/csvupload.css">
	<!-- DATATABLES -->
	<link rel = "stylesheet" href = "<?php echo base_url(); ?>assets/DataTables/datatables.min.css">
	
</head>
<body style = "font-family: 'Lucida Sans Unicode', 'Lucida Grande', sans-serif;">
	<?php $name = $this->uri->segment(3) ?> 
	<?php $pname = urldecode($name)?>

	<nav id = "adminnavbar" class = "navbar navbar-default">
		<div class = "container-fluid">
			<div class = "navbar-header">
				<a class = "navbar-brand" href = "<?php echo base_url(); ?>CSVFileUpload/GPINOYView"> CSV Upload </a>
			</div>

			<ul class = "nav navbar-nav">
				<!-- <li><a href = "<?php echo base_url(); ?>CSVFileUpload/UploadFile" class = "navbarmenu"><i class = "fa fa-file-upload"></i> Upload File </a></li> -->
				<li class = "dropdown">
					<a href = "#" class = "dropdown-toggle navbarmenu" data-toggle = "dropdown"><i class = "fa fa-file-upload"></i>
						CSV Upload
						<span class = "caret"></span>
					</a>

					<ul class = "dropdown-menu">
						<li><a href = "<?php echo base_url(); ?>CSVFIleUpload/GPINOYView"> GPINOY </a></li>
						<li><a href = "<?php echo base_url(); ?>CSVFileUpload/GSATView"> GSAT </a></li>
					</ul>
				</li>
				<li><a href = "<?php echo base_url(); ?>Users" class = "navbarmenu"><i class = "fa fa-users-cog"></i> Manage Users </a></li>
			</ul>

			<ul class = "nav navbar-nav navbar-right">
				<li class = "dropdown">
					<a href = "#" class = "dropdown-toggle navbarmenu" data-toggle = "dropdown"><i class = "fa fa-user"></i>  
						<?php
							if($this->session->userdata('admin'))
							{
								echo $this->session->userdata('admin');
							}
							elseif($this->session->userdata('user'))
							{
								echo $this->session->userdata('user');
							}
						?>
						<span class = "caret"></span>
					</a>
				
					<ul class = "dropdown-menu">
						<li><a href = "<?php echo base_url(); ?>Login/LogoutUser"><i class = "fa fa-sign-out-alt"></i> Logout </a></li>
					</ul>
				</li>
			</ul>
		</div>
	</nav>

	<!-- JQUERY -->
	<script src = "<?php echo base_url(); ?>assets/jquery/jquery.js"></script>
	<!-- BOOTSTRAP JS -->
	<script src = "<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
	<!-- DATATABLES -->
	<script src = "<?php echo base_url(); ?>assets/DataTables/datatables.min.js"></script>
</body>
</html>
