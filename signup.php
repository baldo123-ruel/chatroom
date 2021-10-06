<?php 
session_start();
include("connection.php");
if(isset($_POST['addnew'])){

  $file = $_FILES['file'];
  $user = $_POST['username'];
  

  $pass = $_POST['pass'];
 


  $filename = $_FILES['file']['name'];
  $fileTmpName = $_FILES['file']['tmp_name'];
  $filesize = $_FILES['file']['size'];
  $fileerror = $_FILES['file']['error'];
  $filetype = $_FILES['file']['type'];

  $fileExt = explode('.', $filename);
  $fileActualExt = strtolower(end($fileExt));

  $allowed = array('jpg','jpeg','png','pdf','jfif');

  if(in_array($fileActualExt,$allowed)){
      if($fileerror === 0){
          if($filesize < 1000000){
               $fileNameNew = uniqid('', true).".".$fileActualExt;
               $file_dir= 'profile/'.$fileNameNew;
               move_uploaded_file($fileTmpName,$file_dir);
               $sql = "INSERT INTO `user`(`username`, `password`, `img`) 
               VALUES ('$user','$pass','$fileNameNew')";
               if($connect->query($sql)){
                  header("location:index.php");

              }else{
              echo "error";
               }
               
              
             
          }else{
              echo "Your file is to big ";
          }

      }else{
          echo "There was an error ";
      }
  }else{
      echo "Error upload";
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    
</head>
<body class="loginbody">
       <div class="container">
            
                <form class="loginform"action="" method="post"enctype="multipart/form-data">
                  <h3>REGISTER</h3>
                  <div class="form-group">
                    <label for="">Upload Profile</label>
                    <input type="file" name="file" id="file" required>
                  </div>
                   <div class="form-group">
                     <label for="">Username</label>
                     <input type="text" placeholder="Enter Username"name="username" id="username" required>
                   </div>
                   <div class="form-group">
                     <label for="">Password</label>
                     <input type="password"placeholder="Enter Password" name="pass" id="password"required>
                   </div>
                   
                     
                     <button onclick="myfuntion()"type="submit"name="addnew" >SIGN-UP</button><br>
                     <a style="position:absolute;margin-top:6%;text-align: center;width:90%;"href="index.php">Already have account?</a>
                
                </form>
                
           
       </div>
       
</body>

</html>