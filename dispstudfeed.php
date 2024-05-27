<?php
session_start();
$conn=mysqli_connect('localhost','root','','project');

if(!isset( $_SESSION['student']) ||  $_SESSION['student'] == ""){
   header("Location: login.php");
}


$username = $_SESSION['student'];
$sql1 = "SELECT * FROM student WHERE username='$username'";
$result1 = mysqli_query($conn, $sql1);
$row = mysqli_fetch_assoc($result1);
$studid=$row['student_id'];

$sql="SELECT * FROM feedback WHERE student_id='$studid' order by feedback_id asc";
$result=mysqli_query($conn,$sql);
$data=[];
if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        array_unshift($data,$row);

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
    </style>
</head>
<body>
    <div class="header">
        <h1>Feedback History</h1>
    </div>
    <div class="navbar">
        <a href="stdashb.php">Home</a>
        <a href="studprofi.php">Student Profile</a>
        <a href="dispstudfeed.php">Feedback History</a>
        <a href="logout.php">Logout</a>
    </div>

    <div class="content">
        <center><h3>Here are the feedbacks you sent.</h3></center>
        <div class="manage">
            <center>
                <table border="1" style="width:95%" id="table">
                    <thead>
                        <tr>
                            <th style="width:7%">Feedback ID</th>
                            <th style="width:7%">Student ID</th>
                            <th style="width:7%">Teacher</th>
                            <th style="width:10%">Topic</th>
                            <th style="width:30%">Feedback</th>
                            <th style="width:15%">Status</th>
                            <th style="width:15%">Remarks</th>
                        </tr>
                    </thead>
                    <?php 
                    foreach($data as $d){
                    ?>
                    <tbody>
                        <tr>
                            <td style="padding-left: 45px;"><?php echo $d['feedback_id']; ?></td>
                            <td style="padding-left: 5px;"><?php echo $d['student_id']; ?></td>
                            <td style="padding-left: 4px;"><?php echo $d['teacher_id']; ?></td>
                            <td style="padding-left: 20px;"><?php echo $d['topic']; ?></td>
                            <td style="padding-left: 30px;"><?php echo $d['feedback']; ?></td>
                            <td style="padding-left: 30px;"><?php echo $d['status']; ?></td>
                            <td style="padding-left: 30px;"><?php echo $d['remarks']; ?></td>
                        </tr>
                    </tbody>
                    <?php } ?>
                </table>
            </center>
        </div>
    </div>

    <div class="footer">
        <p>Student Feedback System</p>
    </div>
</body>
</html>
