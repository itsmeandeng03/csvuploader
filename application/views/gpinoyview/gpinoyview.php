<!DOCTYPE html>
<html lang = "en">
<head>
	<meta charset="UTF-8">
	<meta name = "viewport" content = "width=device-width, initial-scale=1.0">
	<title></title>
</head>
<body>
	<?php if($this->session->flashdata('ImportSuccess')): ?>
		<div class = "alert alert-success alert-dismissiable">
			<button class = "close" data-dismiss = "alert" aria-label = "close"> &times; </button>
			<strong> <?php echo $this->session->flashdata('ImportSuccess'); ?> </strong>
		</div>
	<?php endif; ?>

	<div class = "container-fluid">
		<center>
			<h2> GPINOY CSV UPLOAD </h2>
		</center>

		<form enctype = "multipart/form-data" action = "<?php echo base_url(); ?>CSVFileUpload/GPINOYImport" method = "POST">
			<div class = "col-md-6">
				<label id = "csvlabel" for = "csvfile"> Import CSV File Here: </label><br>
				<input type = "file" name = "csvfile" id = "csvfile" class = "form-control" required accept = ".csv">
			</div>

			<div class = "col-md-6">
				<label id = "dealerlabel" for = "dealerlabel"> Select Dealer: </label><br>

				<select name = "dealer" id = "dealer" class = "form-control">
					<option value = "null" disabled selected> --- Select Dealer --- </option>

					<?php 
						$gpinoyserv = $this->load->database('gpinoyserv', TRUE);

						$query = $gpinoyserv->query('SELECT * FROM gsatdigital.dealers');
					
						foreach($query->result() as $row) {
					?>

					<option value = "<?php echo $row->id; ?>"> <?php echo $row->lastname; ?> </option>

					<?php } ?>
				</select>
				<br>
			</div>

			<button id = "submitcsv" type = "submit" class = "btn btn-info"> Submit </button>
		</form>
	</div>

	<br><br>

	<div class = "container-fluid">
		<div class = "table-responsive">
			<table id = "csvtable" class = "table table-striped table-bordered">
				<thead>
					<tr>
						<td> Security Code </td>
						<td> Dealer Name </td>
						<td> Card Number </td>
					</tr>
				</thead>
				<tbody>
					<?php
						$gpinoyserv = $this->load->database('gpinoyserv', TRUE);

						$query = $gpinoyserv->query('SELECT * FROM gsatdigital.cards');

						foreach($query->result() as $csvrow) {

							$sqlquery = $gpinoyserv->query("SELECT * FROM gsatdigital.dealers WHERE id = '$csvrow->dealer_id'");

							foreach($sqlquery->result() as $row) {
					?>

					<tr>
						<td> <?php echo $csvrow->securitycode; ?> </td>
						<td> <?php echo $row->lastname; ?> </td>
						<td> <?php echo $csvrow->cardnum; ?> </td>
					</tr>

							<?php } ?>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>

	<script>
		$(document).ready(function() {
			$('#csvtable').DataTable();
		});
	</script>

	<!-- <script>
		$(document).ready(function() {
			load_data();

			function load_data()
			{
				$.ajax({
					url: "<?php echo base_url();?>CSVUploadFile/LoadData",
					method: "POST",
					success: function(data)
					{
						$('#csvtable').html(data);
					}
				})
			}

			$('#importcsv').on('submit', function(event) {
				event.preventDefault();

				$.ajax({
					url: "<?php echo base_url(); ?>CSVUploadFile/ImportCSV",
					method: "POST",
					data: new FormData(this),
					contentType: false,
					cache: false,
					processData: false,
					beforeSend: function() {
						$('#submitcsv').html('Importing....');
					},
					success: function(data)
					{
						$('#importcsv')[0].reset();
						$('#submitcsv').attr('disabled', false);
						$('#submitcsv').html('Import Done');
						load_data();
					}
				})
			});
		});
	</script> -->
</body>
</html>
