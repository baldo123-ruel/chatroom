<?php 
session_start();
include("connection.php");

if(isset($_GET['id'])){
     $_SESSION['userid'] = $_GET['id'];
}
$users= mysqli_query($connect,"SELECT * FROM user WHERE id ='".$_SESSION['userid']."'") or
    die("failed to query".mysql_error());
    $user = mysqli_fetch_assoc($users);
    $_SESSION['img'] = $user['img'];





$usernotinclude= mysqli_query($connect,"SELECT * FROM user WHERE id !='".$_SESSION['userid']."'") or
    die("failed to query".mysql_error());
    $row = mysqli_fetch_assoc($usernotinclude);

$msg= mysqli_query($connect,"SELECT * FROM messages WHERE fromuser ='".$_SESSION['userid']."'")
    or die("failed to query".mysql_error());
    $mess= mysqli_fetch_assoc($msg);


   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
</head>
<body>
       <div class="container">
    
           <div class="usermsglist">
                 <div class="list-head">
                      <img class="user_img" src="./profile/<?php echo $user['img'];?>" alt="">
                      <h3 class="myname">Chats</h3>
                      <input type="text"  id="fromuser" value="<?php echo $user['id'];?>"hidden />
                      <a href="#logout" class="span"><i class="material-icons-outlined">settings</i></a>
                 </div>
                 <div class="logout" id="logout">
                 <a href="#"class="close">&times;</a>
                 <div class="content">
                      <img src="./profile/<?php echo $user['img'];?>" alt=""class="profile">
                      <h3 class="name"><?php echo $user['username'];?></h3><br>
                      <a href="logout.php"class="btn_log">Logout</a>
                 </div>
                 </div>
                
               <?php if(mysqli_num_rows($usernotinclude) == 0){?>
              
                    <div class="msg_list">
                           <div class="nomessage">
                                 <h4>No Message</h4>
                           </div>
                    </div>
               <?php }else{?>
                   
             
                    
            
               
             <?php do{
                 
                  
                  ?>
                  
               
               <a href="tomessage.php?touser=<?php echo $row['id'];?>">
                 <div class="msg_list">
                      <div class="userimg">
                          <img class="userimg_radius"src="./profile/<?php echo $row['img'];?>" alt="">
                      </div>
                      <div class="user_info">
                           <h3 class="n"><?php echo $row['username']; 
                            ?></h3>
                           <?php if($mess['fromuser'] == $_SESSION['userid'] ){?>

                              <p class="msg_pop"><?php $mess['message'];?></p>
                           <?php }else{?>
                              <p class="msg_pop"><?php $mess['message'];?></p>
                          <?php }?>
                         
                      </div>
                 </div>
                 </a>
            
                 
                 <?php }while($row = mysqli_fetch_assoc($usernotinclude))?>
            <?php }?>     
                  
                  
                
                 </div>
                
             <div class="dev">
                 <h3>Developer: Baldo,Ruel Factor BSIT-3F</h3>
            </div>
            </div>
            
            
       </div>
</body>
</html>
