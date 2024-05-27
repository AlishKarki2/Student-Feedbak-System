
<?php
	session_start();
$conn=mysqli_connect('localhost','root','','project');

if(!isset( $_SESSION['student']) ||  $_SESSION['student'] == ""){
   header("Location: login.php");
}
if (isset($_GET['message']) && $_GET['message'] === 'success') {
    echo "Feedback submitted successfully";
}
$username = $_SESSION['student'];
$sql = "SELECT student_id,fname, username, email, contact_number FROM student WHERE username='$username'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Student Dashboard</title>
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
	position: absolute;
	bottom: 0;
	width: 99%;
}
</style>
</head>
<body>
	<div class="header">
		<h1>Student Dashboard</h1>
	</div>
	<div class="navbar">
		<a href="stdash.php">Home</a>
		<a href="studprofi.php">Student Profile</a>
		<a href="dispstudfeed.php">Feedback History</a>
		<a href="logout.php">Logout</a>
	</div>
	<div class="content">
		<h2>Welcome <?php echo $row['fname']; ?></h2>
		<p>Your feedback is important to us. Please provide your feedback.</p>
		<a href="feedbackform.php"><button class="button">Provide Feedback</button></a>
	</div>
	<div class="footer">
		<p> 2023 Student Feedback System</p>
	</div>
</body>
</html>
