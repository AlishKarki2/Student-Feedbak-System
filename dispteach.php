<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'project');

if (!isset($_SESSION['admin']) || $_SESSION['admin'] == "") {
    header("Location: login.php");
}

if (isset($_GET['delete_id'])) {
    $deleteId = $_GET['delete_id'];

    $deleteSql = "DELETE FROM teacher WHERE teacher_id = $deleteId";
    if (mysqli_query($conn, $deleteSql)) {
        header("Location: dispteach.php");
        exit();
    } else {
        echo "Error deleting Teacher: " . mysqli_error($conn);
    }
}

$sql = "SELECT * FROM teacher order by teacher_id desc";
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
    <title>Teacher Details</title>
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
			margin-bottom: 3px;
			margin-right: 20px;
			margin-top: 3px;
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
        position: fixed; /* Changed to fixed */
        bottom: 0;
        width: 100%;
    	}


		.manage {
			margin-top: 20px;
			margin-bottom: 20px;
			text-align: center;
		}

		table {
			margin-left: 100px;
			border-collapse: collapse;
			width: 85%;
			border-radius: 5px; /* Added border-radius property */
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

		.manage-buttons {
			text-align: left;
			margin-bottom: 3px;
		}

		.add-teacher-button {
			margin-left: 100px;
			margin-bottom: 10px;
			text-decoration: none;
			background-color: #4CAF50;
			color: #fff;
			border: none;
			padding: 10px 20px;
			cursor: pointer;
			border-radius: 5px;
			transition: background-color 0.3s;
		}

		.add-teacher-button:hover {
			background-color: #45a049;
		}

		.update-button {
			background-color: #4CAF50;
		}

		.delete-button {
			background-color: #C41E3A;
		}
    </style>
</head>

<body>
    <div class="header">
        <h1>Teacher Details</h1>
    </div>
    <div class="navbar">
        <a href="admindash.php">Home</a>
		<a href="dispteach.php">Show Teachers</a>
		<a href="dispstud.php">Show Students</a>
		<a href="reviewedfeedback.php">Reviewed Feedbacks</a>
		<a href="pendingfeedbacks.php">Pending Feedbacks</a>
		<a href="dispfeedback.php">Feedback History</a>
		<a href="logout.php">Logout</a>
    </div>

    <div class="manage">
        <div class="manage-buttons">
            <a href="teacherreg.php"><button class="button add-teacher-button">Add Teacher</button></a>
        </div>
        <table >
            <thead>
                <tr>
                    <th>Teacher Id</th>
                    <th>Username</th>
                    <th>Contact Number</th>
                    <th>Fullname</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Manage</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $d) { ?>
                    <tr>
                        <td><?php echo $d['teacher_id']; ?></td>
                        <td><?php echo $d['username']; ?></td>
                        <td><?php echo $d['contact_number']; ?></td>
                        <td><?php echo $d['fname']; ?></td>
                        <td><?php echo $d['email']; ?></td>
                        <td><?php echo $d['subject']; ?></td>
                        <td>
                            <a href="updateteacherr.php?id=<?php echo $d['teacher_id'] ?>"><button class="button update-button">Update</button></a>
                            <a href="?delete_id=<?php echo $d['teacher_id']; ?>" onclick="return confirm('Are you sure you want to delete?')">
                                <button class="button delete-button">Delete</button>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <div class="footer">
        <p>2023 Student Feedback System</p>
    </div>
</body>

</html>
