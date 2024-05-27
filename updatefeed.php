<?php
    session_start();
$conn=mysqli_connect('localhost','root','','project');

if(!isset( $_SESSION['teacher']) ||  $_SESSION['teacher'] == ""){
   header("Location: login.php");
}
$id=$_GET['id'];

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
    

    $username = $_SESSION['teacher'];
    $sql = "SELECT * FROM feedback WHERE feedback_id='$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

if (isset($_POST['submit'])) {

    $fid = $_POST['fid'];
    $sid = $_POST['sid'];
    $topic = $_POST['topic'];
    $tid = $_POST['tid'];
    $feedback = $_POST['feedback'];
    $feedback_type = $_POST['feedback_type'];
    $status=$_POST['status'];

    $sql3 = "UPDATE feedback SET status ='$status' WHERE feedback_id = '$id'";

    if (mysqli_query($conn, $sql3)) {
        header("Location: teacherdashb.php");
    } else {
        echo "Error: " . $sql3 . "<br>" . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html>
<head id="Head"><title>
     Feedback Form
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
     height: 550;
     border: 1px solid #000000;
     border-radius: 6px;
     padding: 10px;
     margin-top: 3%;
     margin-left: auto;
     margin-right: auto;
     display: block;
 }
 
 .feedback-header{
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
 .category{
    margin-left: 41px;
    margin-top: 8px;
    margin-bottom: 5px;
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

 .login-input-box input[name="Feedback"] {
    width: 350px;
    height: 150px;
    margin-left: 18px;
    border: 1px solid #dcdcdc;
    border-radius: 4px;
    padding: 10px;
}

label, textarea {
    display: block;
    margin-top: 10px;
    font-size: 18px;
}

textarea {
    width: 90%;
    margin-left: 18px;
    height: 100%;
    border: 1px solid #dcdcdc;
    border-radius: 4px;
    box-sizing: border-box;
    padding: 12px 20px;
    font-size: 16px;
    resize: none;
}


select {
  width: 150px;
  height: 32px;
  margin-left: 16px;
  border: 1px solid #dcdcdc;
  border-radius: 4px;
  padding-left: 42px;
}

option {
  padding: 9px;
}


</style>
</head>

<body>
    
    <div style="transform:translateX(100)">  
    </div>
    <div id="content">             
    <div class="feedback-header">
        <h2><center>Feedback Form</center></h2>
    </div>
    <form name="login" method="post" action="" >
        <div class="label"><label>Feedback ID</label></div>
        <div class="login-input-box">
            <input name="fid" type="number" value="<?php echo $row['feedback_id']; ?>" readonly/>
        </div>
        <div class="label"><label>Enter Topic Please</label></div>
        <div class="login-input-box">
            <input name="topic" type="text" id="StdName" value="<?php echo $row['topic']; ?>" readonly />
        </div>
        <div class="label"><label>Teacher ID</label></div>
        <div class="login-input-box">
            <input name="tid" type="number" value="<?php echo $row['teacher_id']; ?>" readonly/>
        </div>

        <div class="label"><label>Feedback</label></div>
        <div class="login-input-box">
            <textarea name="feedback" rows="5" cols="50" readonly><?php echo $row['feedback']; ?></textarea>
        </div>
        <div class="label"><label>Feedback Type</label></div>
        <div class="login-input-box">
            <input name="feedback_type" type="text" value="<?php echo $row['feedback_type']; ?>" readonly/>
        </div>

        <div class="label"><label>Status</label></div>
            <input type="radio" name="status" value="Pending" checked> Pending
            <input type="radio" name="status" value="Under Review"> Under Review
            <input type="radio" name="status" value="Reviewed"> Reviewed


        <div >                          
            <input type="submit" name="submit" value="submit" id="submit" class="login-button-box" style="height:34px;" />
        </div>
    </form>
   
</div>
</body>
</html>
