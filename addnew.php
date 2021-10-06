<?php
session_start();
include("connection.php");
if(isset($_GET['id'])){
    $_SESSION['id'] = $_GET['id'];
     
    $users= mysqli_query($connect,"SELECT * FROM user WHERE id='".$_GET['id']."'") or
    die("failed to query".mysql_error());
    $user = mysqli_fetch_assoc($users);
    $_SESSION['img'] = $user['img'];
    $_SESSION['username'] = $user['username'];
    
     $img =$_SESSION['img'];
     $sql = "INSERT INTO `chatroom`(`id`, `username`,`img`) 
     VALUES ('".$_SESSION['id']."','".$_SESSION['username']."','".$_SESSION['img']."')";
     if($connect->query($sql)){
          header("location:test.php");

     }else{
          echo "error";
     }
}
?>