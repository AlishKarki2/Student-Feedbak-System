<?php
    session_start();
$conn=mysqli_connect('localhost','root','','project');

if(!isset( $_SESSION['admin']) ||  $_SESSION['admin'] == ""){
   header("Location: login.php");
}
$id=$_GET['id'];

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
    

    $username = $_SESSION['admin'];
    $sql = "SELECT * FROM feedback WHERE feedback_id='$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

if (isset($_POST['submit'])) {

    $fid = $_POST['fid'];
    $remarks=$_POST['remarks'];

    $sql3 = "UPDATE feedback SET status = 'Feedback rejected', remarks ='$remarks' WHERE feedback_id = '$id'";

    if (mysqli_query($conn, $sql3)) {
        header("Location: dispfeedback.php");
    } else {
        echo "Error: " . $sql3 . "<br>" . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head id="Head">
    <title>Login</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-size: cover;
            font-family: sans-serif;
            background: #535250;
        }

        #content {
            background-color: rgba(255, 255, 255, 0.95);
            width: 420px;
            height: 280px;
            border: 1px solid #000000;
            border-radius: 6px;
            padding: 10px;
            margin-top: 15%;
            margin-left: auto;
            margin-right: auto;
            display: block;
        }

        .login-header {
            width: 100%;
            height: 38px;
            margin-bottom: 10px;
            border-bottom: 1px solid #037cb1;
        }

        .label {
            margin-left: 41px;
            margin-top: 5px;
        }

        .login-input-box input,
        .login-input-box textarea {
            width: 350px;
            margin-left: 18px;
            border: 1px solid #dcdcdc;
            border-radius: 4px;
            padding-left: 22px;
        }

        .login-input-box input:hover,
        .login-input-box textarea:hover {
            border: 1px solid #037cb1;
            outline: 0;
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 8px rgba(102, 175, 233, .6);
        }

        .login-input-box input:focus,
        .login-input-box textarea:focus {
            border: 1px solid #037cb1;
            outline: 0;
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 8px rgba(102, 175, 233, .6);
        }

        .login-input-box textarea {
            height: 70px; 
        }
        .login-input-box input {
            height: 30px; 
        }

        .login-button-box {
            margin-top: 25px;
            background-color: #037cb1;
            color: #ffffff;
            font-size: 16px;
            width: 200px;
            height: 40px;
            margin-left: 115px;
            border: 2px solid #099ee0;
            border-radius: 6px;
            cursor: pointer;
        }

        .logon-box {
            margin-top: 20px;
            text-align: center;
        }

        .logon-box a {
            margin: 30px;
            color: #4a4744;
            font-size: 13px;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div style="transform: translateX(100)">
    </div>
    <div id="content">
        <div class="login-header">
            <h2><center>Remarks</center></h2>
        </div>
        <form name="login" method="post" action="">
            <div class="label"><label>Feedback ID</label></div>
        <div class="login-input-box">
            <input name="fid" type="number" value="<?php echo $row['feedback_id']; ?>" readonly/>
        </div>
            <div class="label"><label>Remarks</label></div>
            <div class="login-input-box">
                <textarea name="remarks" placeholder="Remarks"></textarea>
            </div>
            <div>
                <input type="submit" name="submit" value="submit" class="login-button-box" style="height: 34px;" />
            </div>
        </form>
    </div>
</body>
</html>
