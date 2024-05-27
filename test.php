<!DOCTYPE html>
<html>
<head>
	<title>Student Details</title>
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
			margin-bottom: 10px;
			margin-right: 50px;
			margin-top: 10px;
			float: right;
			text-decoration: none;
			background-color: #007acc;
			color: #fff;
			border: none;
			padding: 10px 20px;
			cursor: pointer;
			border-radius: 5px;
			transition: background-color 0.3s;
		}

		.button:hover {
			background-color: #005a8e;
		}

		.footer {
			background-color: #007acc;
			color: #fff;
			padding: 10px;
			text-align: center;
			position: absolute;
			bottom: 0;
			width: 99%;
		}

		.manage {
			margin-top: 20px;
			margin-bottom: 20px;
		}

		table {
			width: 100%;
			border-collapse: collapse;
		}

		th, td {
			padding: 10px;
			text-align: left;
			border-bottom: 1px solid #ddd;
		}

		th {
			background-color: #f2f2f2;
		}

		tr:hover {
			background-color: #f5f5f5;
		}
	</style>
</head>
<body>
	<div class="header">
		<h1>Student Details</h1>
	</div>
	<div class="navbar">
		<a href="admindash.php">Home</a>
		<a href="dispteach.php">Show Teachers</a>
		<a href="dispstud.php">Show Students</a>
		<a href="dispfeedback.php">Feedback History</a>
		<a href="logout.php">Logout</a>
	</div>

	<div class="manage">
		<a href="studreg.php"><button class="button">Add Student</button></a>
	</div>
	<center>
		<table id="table">
			<thead>
				<tr>
					<th>Student Id</th>
					<th>Fullname</th>
					<th>Username</th>				
					<th>Email</th>
					<th>Contact Number</th>
					<th>Manage</th>
				</tr>
			</thead>
			<?php foreach($data as $d){ ?>
				<tbody>
					<tr>
						<td><?php echo $d['student_id']; ?></td>
						<td><?php echo $d['fname']; ?></td>
						<td><?php echo $d['username']; ?></td>
						<td><?php echo $d['email']; ?></td>
						<td><?php echo $d['contact_number']; ?></td>
						<td>
							<a href="upatestu.php?id=<?php echo $d['student_id']?>"><button class="button" style="background-color:skyblue; border-color: skyblue;">Update</button></a>
							<a href="?delete_id=<?php echo $d['student_id']; ?>" onclick="return confirm('Are you sure you want to delete?')">
								<button class="button" style="background-color:#C41E3A; border-color: #C41E3A; color: white;">Delete</button>
							</a>
						</td>
					</tr>
				</tbody>
			<?php } ?>
		</table>
	</center>
	<div class="footer">
		<p>2023 Student Feedback System</p>
	</div>
</body>
</html>
