<?php 
session_start();
include("connection.php");
if(isset($_POST['login'])){
    $username = $_POST['username'];
    $pass = $_POST['pass'];
    $users= mysqli_query($connect,"SELECT * FROM user WHERE username='$username' AND password='$pass'") or
    die("failed to query".mysql_error());
    $user = mysqli_fetch_assoc($users);

    if(mysqli_num_rows($users) > 0 ){
        echo header("location: userlisttomessage.php?id=".$user['id']);
    }else{
        echo "Account not found";
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
            
                <form class="loginform"action="" method="post">
                  <h3>LOGIN</h3>
                   <div class="form-group">
                     <label for="">Username</label>
                     <input type="text" placeholder="Enter Username"name="username" id="" required>
                   </div>
                   <div class="form-group">
                     <label for="">Password</label>
                     <input type="password"placeholder="Enter Password" name="pass" id=""required>
                   </div>
                   
                     
                     <button type="submit" name="login">SIGN-IN</button><br>
                     <a style="position:absolute;margin-top:6%;text-align: center;width:90%;"href="signup.php">Register?</a>
                
                </form>
           
       </div>
</body>
</html>