<?php
session_start();
$conn=mysqli_connect('localhost','root','','project');

if(!isset( $_SESSION['student']) ||  $_SESSION['student'] == ""){
   header("Location: login.php");
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
            text-align: center;
        }

        .button {
            text-decoration: none;
            background-color: #007acc;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #005d8a;
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
    </style>
</head>
<body>
    <div class="header">
        <h1>Your Details</h1>
    </div>
    <div class="navbar">
        <a href="stdashb.php">Home</a>
        <a href="studprofi.php">Student Profile</a>
        <a href="dispstudfeed.php">Feedback History</a>
        <a href="logout.php">Logout</a>
    </div>
    <div class="content">
        <h2 style="font-size: 24px;">Welcome, <?php echo $row['fname']; ?></h2>
        <div style="border: 1px solid #ccc; border-radius: 8px; padding: 20px; margin: 20px auto; max-width: 400px;">
            <h3 style="font-size: 20px; margin-bottom: 10px;">Your Profile Information:</h3>
            <p style="font-size: 16px;"><strong>Student ID:</strong> <?php echo $row['student_id']; ?></p>
            <p style="font-size: 16px;"><strong>Username:</strong> <?php echo $row['username']; ?></p>
            <p style="font-size: 16px;"><strong>Email:</strong> <?php echo $row['email']; ?></p>
            <p style="font-size: 16px;"><strong>Contact Number:</strong> <?php echo $row['contact_number']; ?></p>
        </div>
    </div>
    <div class="footer">
        <p>2023 Student Feedback System</p>
    </div>
</body>
</html>
