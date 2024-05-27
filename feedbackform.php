<?php
    session_start();
$conn=mysqli_connect('localhost','root','','project');

if(!isset( $_SESSION['student']) ||  $_SESSION['student'] == ""){
   header("Location: login.php");
}

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
    $sql = "SELECT MAX(feedback_id) AS max_id FROM feedback";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $val = $row['max_id'] + 1;

    $username = $_SESSION['student'];
    $sql1 = "SELECT student_id,fname, username, email, contact_number FROM student WHERE username='$username'";
    $result1 = mysqli_query($conn, $sql1);
    $row = mysqli_fetch_assoc($result1);

    $sq2 = "SELECT teacher_id, fname FROM teacher";
    $result2 = mysqli_query($conn, $sq2);

if (isset($_POST['submit'])) {

    $fid = $_POST['fid'];
    $sid = $_POST['sid'];
    $topic = $_POST['topic'];
    $tid = $_POST['tid'];
    $feedback = $_POST['feedback'];

    $sql3 = "INSERT INTO feedback (feedback_id, topic, feedback, admin_id, student_id, teacher_id, status)
            VALUES ('$fid', '$topic', '$feedback', 1, '$sid', '$tid', 'pending')";

    if (mysqli_query($conn, $sql3)) {
        // data inserted successfully
        header("location: stdashb.php");
        //echo "Feedback Submitted successfully";
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
            <input name="fid" type="number" value="<?php echo $val; ?>" readonly/>
        </div>
        <div class="label"><label>Student ID</label></div>
        <div class="login-input-box">
            <input name="sid" type="number" value="<?php echo $row['student_id'];?>" readonly/>
        </div>
        <div class="label"><label>Enter Topic Please</label></div>
        <div class="login-input-box">
            <input name="topic" type="text" id="StdName" placeholder="Enter Full Name" required />
        </div>
        <div class="category"><label for="options">Select a Teacher:</label><br></div>
            <?php echo "<select name='tid' required>";
            echo "<option value=''>Select a teacher</option>";
            while ($row = mysqli_fetch_assoc($result2)) {
                echo "<option value='" . $row['teacher_id'] . "'>" . $row['fname'] . "</option>";
            }?>
            </select>

        <div class="label"><label>Feedback</label></div>
        <div class="login-input-box">
            <textarea id="feedback" name="feedback" rows="5" cols="50" placeholder="Enter your feedback here." required></textarea>
        </div>

        <div >                          
            <input type="submit" name="submit" value="submit" id="submit" class="login-button-box" style="height:34px;" />
        </div>
    </form>
   
</div>
</body>
</html>
