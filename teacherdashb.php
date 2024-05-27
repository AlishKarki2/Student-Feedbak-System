<?php
session_start();
$conn=mysqli_connect('localhost','root','','project');

if(!isset( $_SESSION['teacher']) ||  $_SESSION['teacher'] == ""){
   header("Location: login.php");
}

$username = $_SESSION['teacher'];
$sql1 = "SELECT * FROM teacher WHERE username='$username'";
$result1 = mysqli_query($conn, $sql1);
$row = mysqli_fetch_assoc($result1);
$teacher_id=$row['teacher_id'];
$fname=$row['fname'];

$sql = "SELECT * FROM feedback WHERE status = 'Under Review' AND teacher_id='$teacher_id' ORDER BY  feedback_id ASC";
$result = mysqli_query($conn, $sql);
$data = [];

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        array_unshift($data, $row);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Feedback History</title>
	<style>
	body {
		margin: 0;
		padding: 0;
		font-family: Arial, sans-serif;
	}

	.header {
		background-color: #007acc;
		color: #fff;
		padding: 20px;
		text-align: center;
	}

	.navbar {
		background-color: #e6e6e6;
		overflow: hidden;
	}

	.navbar a {
		float: left;
		display: block;
		color: #333;
		text-align: center;
		padding: 14px 16px;
		text-decoration: none;
		font-size: 17px;
	}

	.navbar a:hover {
		background-color: #ddd;
		color: #333;
	}

	.content {
		padding: 20px;
	}

	.button {
		text-decoration: none;
		background-color: #007acc;
		color: #fff;
		border: none;
		padding: 10px 20px;
		cursor: pointer;
	}

	.footer {
		background-color: #007acc;
		color: #fff;
		padding: 10px;
		text-align: center;
		position: fixed;
		bottom: 0;
		width: 100%;
	}

	.manage {
		margin-top: 20px;
		margin-bottom: 20px;
		text-align: center;
	}

	table {
		margin-left: auto;
		margin-right: auto;
		border-collapse: collapse;
		width: 90%;
		border-radius: 5px;
	}

	th, td {
		padding: 8px;
		text-align: center;
		border: 1px solid #ddd;
	}

	th {
		background-color: #007acc;
		color: #fff;
	}

	tr:hover {
		background-color: #f5f5f5;
	}

	.button-update {
		background-color: #007acc;
		color: #fff;
		border: none;
		padding: 8px 16px;
		border-radius: 4px;
		cursor: pointer;
	}
</style>

</head>

<body>
	<div class="header">
		<h1>Welcome <?php echo $fname; ?>!</h1>
	</div>
	<div class="navbar">
		<a href="teacherdashb.php">Home</a>
		<a href="dispteachfeedback.php">Feedback History</a>
		<a href="logout.php">Logout</a>
	</div>


	<div class="manage">
		<center>
			<h3>Here are the feedbacks that requires review.</h3>
			<table>
				<thead>
					<tr>
						<th>Feedback ID</th>
						<th>Teacher</th>	
						<th>Topic</th>
						<th>Feedback</th>
						<th>Feedback Type</th>
						<th>Status</th>
						<th>Manage</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($data as $d){ ?>
						<tr>
							<td><?php echo $d['feedback_id']; ?></td>
							<td><?php echo $d['teacher_id']; ?></td>
							<td><?php echo $d['topic']; ?></td>
							<td><?php echo $d['feedback']; ?></td>
							<td><?php echo $d['feedback_type']; ?></td>
							<td><?php echo $d['status']; ?></td>
							<td>
								<a href="updatefeed.php?id=<?php echo $d['feedback_id']?>">
									<button class="button-update">Update</button>
								</a>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</center>
	</div>

	<div class="footer">
		<p>Student Feedback System</p>
	</div>
</body>
</html>
