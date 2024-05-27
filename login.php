<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname="project";

$conn = mysqli_connect($servername, $username, $password,$dbname);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
if (isset($_GET['message']) && $_GET['message'] === 'success') {
    echo "New record created successfully";
}

if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    if(empty($username) || empty($password)){
        echo "Don't leave any empty field!!";
    } else {
      
        $hashed_password = md5($password);
        $sql1 = "SELECT * FROM Student WHERE username='$username' and password='$hashed_password'";
        $sql2 = "SELECT * FROM teacher WHERE username='$username' and password='$hashed_password'";
        $sql3 = "SELECT * FROM ADMIN WHERE username='$username' and password='$password'";
        $result1 = mysqli_query($conn, $sql1);
        $result2 = mysqli_query($conn, $sql2);
        $result3 = mysqli_query($conn, $sql3);

        if(mysqli_num_rows($result1) > 0){
            $_SESSION['student'] = $username;
            $_SESSION['usertype'] = 'student';
            header("Location: stdashb.php");
            exit();

        } elseif(mysqli_num_rows($result2) > 0){
            $_SESSION['teacher'] = $username;
            $_SESSION['usertype'] = 'teacher';
            header("Location: teacherdashb.php"); 
            exit();

        } elseif(mysqli_num_rows($result3) > 0){
            $_SESSION['admin'] = $username;
            $_SESSION['usertype'] = 'admin';
            header("Location: admindash.php"); 
            exit();

        } else {
            echo "Invalid username or password!";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head id="Head"><title>
     Login
</title><style>
    body{
    margin: 0;
     padding: 0;
     background-size: cover;
     font-family: sans-serif;
     background:#535250;
 }
 
 #content{
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
 
 .login-header{
     width: 100%;
     height: 38px;
     margin-bottom: 10px;
     border-bottom: 1px solid #037cb1;
 }
 .label{
    margin-left: 41px;
    margin-top: 5px;

 }
 
 
 .login-input-box-code input{
     
     width: 150px;
     height: 32px;
     margin-left: 12px;
     border: 1px solid #dcdcdc;
     border-radius: 4px;
     padding-left: 42px;
 }
 
 .login-input-box-code input:hover{
     border: 1px solid #037cb1;
     outline:0;
 
 }
 
 .login-input-box-code input:focus{
     border: 1px solid #037cb1;
     outline:0;
 }

  
 .login-input-box{
     margin-top: 8px;
     width: 100%;
     margin-left: auto;
     margin-right: auto;
     display: inline-block;
 
 }
 
 .login-input-box input{
     width: 350px;
     height: 32px;
     margin-left: 18px;
     border: 1px solid #dcdcdc;
     border-radius: 4px;
     padding-left: 22px;
 }
 
 .login-input-box input:hover{
     border: 1px solid #037cb1;
     outline:0;
     box-shadow:inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(102,175,233,.6);
 
 }
 
 .login-input-box input:focus{
     border: 1px solid #037cb1;
     outline:0;
     box-shadow:inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(102,175,233,.6);
 
 }
 
 
 
 .login-button-box{
     margin-top: 25px;
     background-color: #037cb1;
     color: #ffffff;
     font-size: 16px;
     width: 200px;
     height: 40px;
     margin-left: 15px;
     border: 2px solid #099ee0;
     border-radius: 6px;
     cursor:pointer;
   
 }
 
 .logon-box{
     margin-top: 20px;
     text-align: center;
 }
 
 .logon-box a{
     margin: 30px;
     color: #4a4744;
     font-size: 13px;
     text-decoration: none;
 }
.button-container {
    justify-content: space-between;
}

.register-button-box {
    background-color: #037cb1;
    color: #ffffff;
    margin-left: 10px;
    font-size: 16px;
    margin-top: 25px;
    width: 180px;
    height: 35px;
    border: 2px solid #099ee0;
    border-radius: 6px;
    cursor: pointer;
}

</style>
</head>


<body>
    <div id="content">
        <div class="login-header">
            <h2><center>Login</center></h2>
        </div>
        <form name="login" method="post" action="">
            <div class="label"><label>Username</label></div>
            <div class="login-input-box">
                <input name="username" type="text" name="username" placeholder="Enter your username" />
            </div>
            <div class="label"><label>Password</label></div>
            <div class="login-input-box">
                <input name="password" type="password" name="password" placeholder="Enter your password" />
            </div>
            <div class="button-container">
                <input type="submit" name="submit" value="Log in" class="login-button-box" style="height:34px;" />
                <a href="registerr.php"><input type="button" value="Register" class="register-button-box"></a>
            </div>
        </form>
    </div>
</body>
</html>
