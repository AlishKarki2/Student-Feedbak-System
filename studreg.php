<?php

session_start();
$conn=mysqli_connect('localhost','root','','project');

if(!isset( $_SESSION['admin']) ||  $_SESSION['admin'] == ""){
   header("Location: login.php");
}

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
    $sql = "SELECT MAX(student_id) AS max_id FROM Student";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $val = $row['max_id'] + 1;

if (isset($_POST['submit'])) {


    $student_id = $_POST['id'];

    $fname = $_POST['fname'];
    if (empty($fname) || !preg_match("/^[a-zA-Z ]{1,30}$/", $fname)) {
        echo "Error: Only letters and spaces allowed in full name";
        exit();
    }

    $username = $_POST['username'];
     if (empty($username) || strlen($username) > 30) {
        echo "Error: Invalid username entered";
        exit();
    }

    $email = $_POST['email'];
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL) || !strpos($email, '@') || !strpos($email, '.com')) {
        echo "Error: Invalid email entered";
        exit();
    }


    $contact_number = $_POST['contact'];
    if (empty($contact_number) || strlen($contact_number) != 10 || substr($contact_number, 0, 2) !== '98' || !ctype_digit($contact_number)) {
    echo "Error: Please input a valid contact number (10 digits starting with '98')";
        exit();
    }
    
    $password = $_POST['password'];
     if (empty($password) || strlen($password) > 30) {
        echo "Error: Invalid password entered";
        exit();
    }
    $hash=md5($password);

    $sql1 = "INSERT INTO Student (student_id, fname, username, email, contact_number, password)
            VALUES ('$student_id', '$fname', '$username', '$email', '$contact_number', '$hash')";

    if (mysqli_query($conn, $sql1)) {
        header("Location: dispstud.php");
    } else {
        echo "Error: " . $sql1 . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);

?>



<!DOCTYPE html>
<html>
<head id="Head"><title>
	 Register Student
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
     height: 525px;
     border: 1px solid #000000;
     border-radius: 6px;
     padding: 10px;
     margin-top: 15px;
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
     margin-left: 115px;
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

</style>
</head>

<body>

    
    <div style="transform:translateX(100)">  
    </div>
    <div id="content">             
    <div class="login-header">
        <h2><center>Register</center></h2>
    </div>
    <form name="login" method="post" action="" >
        <div class="label"><label>Student ID</label></div>
        <div class="login-input-box">
            <input name="id" type="text" name="id" value="<?php echo $val; ?>" readonly /></div>
        <div class="label"><label>Full Name</label></div>
        <div class="login-input-box">
            <input name="fname" type="text" placeholder="Enter your Full Name" name="fname"/></div>
        <div class="label"><label>Username</label></div>
        <div class="login-input-box">
            <input name="username" type="text" placeholder="Enter your username" name="username"/>
        </div>
        <div class="label"><label>Email</label></div>
        <div class="login-input-box">
            <input name="email" type="text" placeholder="Enter your Email" name="email"/>
        </div>
        <div class="label"><label>Password</label></div>
        <div class="login-input-box">
            <input name="password" type="password" placeholder="Enter your password" name="password"/>
        </div>
        <div class="label"><label>Contact Number</label></div>
        <div class="login-input-box">
            <input name="contact" type="text" placeholder="Enter your Contact Number" name="contact"/>
        </div>
        <div >                          
            <button type="submit" name="submit" value="Register" class="login-button-box" style="height:34px;" />Register</button>
        </div>
    </form>
   
</div>

</body>
</html>
