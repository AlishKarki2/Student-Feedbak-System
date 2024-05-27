<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'project');

if (!isset($_SESSION['admin']) || $_SESSION['admin'] == "") {
    header("Location: login.php");
}

// Calculate teacher rankings based on positive feedback percentage
$sql = "SELECT teacher_id, 
               COUNT(*) AS total_feedback_count,
               SUM(CASE WHEN status = 'Reviewed' THEN 1 ELSE 0 END) AS reviewed_feedback_count,
               (SUM(CASE WHEN status = 'Reviewed' THEN 1 ELSE 0 END) / COUNT(*)) * 100 AS positive_feedback_percentage
        FROM feedback
        WHERE status != 'Feedback rejected'  /* Exclude rejected feedback */
        GROUP BY teacher_id
        HAVING total_feedback_count > 0
        ORDER BY positive_feedback_percentage DESC";


$result = mysqli_query($conn, $sql);
$data = [];

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($data, $row);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        /* Your CSS styles here */

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
        <h1>Admin Dashboard</h1>
    </div>
    <div class="navbar">
        <!-- Add your navigation links here -->
        <a href="admindash.php">Home</a>
        <a href="dispteach.php">Show Teachers</a>
        <a href="dispstud.php">Show Students</a>
        <a href="reviewedfeedback.php">Reviewed Feedbacks</a>
        <a href="pendingfeedbacks.php">Pending Feedbacks</a>
        <a href="dispfeedback.php">Feedback History</a>
        <a href="logout.php">Logout</a>
    </div>

    <div class="manage">
        <h3>Teacher Rankings Based on Positive Feedback Percentage</h3>
        <table>
            <thead>
                <tr>
                    <th>Teacher ID</th>
                    <th>Total Feedback Count</th>
                    <th>Reviewed Feedback Count</th>
                    <th>Positive Feedback Percentage</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $d) { ?>
                    <tr>
                        <td><?php echo $d['teacher_id']; ?></td>
                        <td><?php echo $d['total_feedback_count']; ?></td>
                        <td><?php echo $d['reviewed_feedback_count']; ?></td>
                        <td><?php echo $d['positive_feedback_percentage']; ?>%</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <div class="footer">
        <p>Student Feedback System</p>
    </div>
</body>
</html>
