<?php
session_start();
$id=$_GET['delete_id'];
$conn=mysql_connect('localhost','root','','project');
$sql="DELETE from teacher where teacher_id=$id";
mysqli_query($conn,$sql);
header('location:dispteach.php');
?>