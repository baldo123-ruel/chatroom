
<?php
session_start();
include("connection.php");
if(isset($_POST['send'])){
     $msg = $_POST['msg'];
     $fromuser = $_SESSION['userid'];
     $touser = $_SESSION['touser'];
     $img =$_SESSION['img'];
     $sql = "INSERT INTO `messages`(`fromuser`, `touser`, `message`, `img`) 
     VALUES ('$fromuser','$touser','$msg','$img')";
     if($connect->query($sql)){
        header("location:userlisttomessage.php");

     }else{
          echo "error";
     }
}

?>