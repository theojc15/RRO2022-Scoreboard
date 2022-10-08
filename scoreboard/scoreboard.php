<?php
	session_start();
	if (!isset($_SESSION['name'])) {
		header("location:../index.php");
	}
	$connection = new mysqli('localhost','root','','rro2022');
	if ($connection -> connect_errno) {
		echo "Failed to connect to MySQL: " . $connection -> connect_error;
		exit();
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>SCOREBOARD</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css?v=<?php echo time(); ?>">
	<link rel="stylesheet" type="text/css" href="css/main.css?v=<?php echo time(); ?>">
<!--===============================================================================================-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
	<a class="navbar-brand" href="scoreboard.php">RRO2022</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarNav">
		<ul class="navbar-nav">
		<?php if ($_SESSION['name'] == 'admin') { ?>
		<li class="nav-item">
			<a class="nav-link" href="../INPUT/input.php">Input Score</a>
		</li>
		<?php } ?>
		<li class="nav-item active">
			<a class="nav-link" href="scoreboard.php">Scoreboard</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="../final/final.php">Final</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="../logout.php">Logout</a>
		</li>
		</ul>
	</div>
	</nav>
	<div class="limiter">
		<div class="container-table100">
			<div class="wrap-table100">
				<div class="table100">
					<table>
						<thead>
							<tr class="table100-head">
								<th class="column1">Rank</th>
								<th class="column3">Team</th>
								<th class="column2">Take Point 1</th>
								<th class="column2">Time</th>
								<th class="column2">Take Point 2</th>
								<th class="column2">Time</th>
								<th class="column2">Total Point</th>
								<th class="column6">Total Time</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$n = 1;
								$tampil = mysqli_query($connection, "SELECT * FROM scoreboard INNER JOIN peserta on scoreboard.kode = peserta.kode ORDER BY totaltag DESC, totaltime ASC");
								while($data = mysqli_fetch_array($tampil)) {
							?>
							<tr>
								<td class="column1"><?=$n++?></td>
								<td class="column3"><?=$data['nama']?></td>
								<td class="column2"><?=$data['tag1']?></td>
								<td class="column2"><?=$data['time1']?></td>
								<td class="column2"><?=$data['tag2']?></td>
								<td class="column2"><?=$data['time2']?></td>
								<td class="column2"><?=$data['totaltag']?></td>
								<td class="column6"><?=$data['totaltime']?></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>


	

<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>