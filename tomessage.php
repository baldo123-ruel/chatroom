<?php 
session_start();
include("connection.php");
if(isset($_GET['touser'])){
  $_SESSION['touser'] = $_GET['touser'];
}
if(isset($_POST['send'])){
  $msg = $_POST['msg'];
  $fromuser = $_SESSION['userid'];
  $touser = $_SESSION['touser'];
  $img =$_SESSION['img'];
  $sql = "INSERT INTO `messages`(`fromuser`, `touser`, `message`, `img`) 
  VALUES ('$fromuser','$touser','$msg','$img')";
  if($connect->query($sql)){
     header("location:tomessage.php?id=".$_SESSION['touser']);

  }else{
       echo "error";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message</title>
</head>
<body>
      <div class="container">
        
      <div class="msg_me">
                 
                <?php 
                  if(isset($_GET['touser'])){
                    $usernotinclude= mysqli_query($connect,"SELECT * FROM user WHERE id='".$_GET['touser']."'") or
                        die("failed to query".mysql_error());
                        $row = mysqli_fetch_assoc($usernotinclude);       
                        $_SESSION['touser'] = $_GET['touser'];
                       echo '<input hidden type="text" value='.$_GET["touser"].'>';
                 }else{
                   $usernotinclude= mysqli_query($connect,"SELECT * FROM user ") or
                   die("failed to query".mysql_error());
                   $row = mysqli_fetch_assoc($usernotinclude);
                   $_SESSION['touser'] = $row['id'];
                 echo '<input hidden type="text" value='.$_SESSION["touser"].'>';
                 }
                 ?>
                 <div class="msg_head">
                   
                   <a href="userlisttomessage.php"><i class="material-icons-outlined">arrow_back</i></a>
                   <img class="user_img"src="./profile/<?php echo $row['img'];?>" alt="">
                   <h3 class="myname"><?php echo $row['username'];?></h3>
                   
                 </div>
               
                  <div class="chat-page">
                     <div class="msg_box">
                          <div class="chats">
                                <div class="msg_page">
                                    
                                  
                                     
                                        
                                  
                                      
                                 
                                  
                            <?php 
                               if(isset($_GET['touser'])){
                                $msg= mysqli_query($connect,"SELECT * FROM messages WHERE (fromuser ='".$_SESSION['userid']."' AND 
                                touser= '".$_GET['touser']."') OR (fromuser = '".$_GET['touser']."' AND touser= '".$_SESSION['userid']."')")
                                or die("failed to query".mysql_error());
                               
                              }else{
                                $msg= mysqli_query($connect,"SELECT * FROM messages WHERE (fromuser ='".$_SESSION['userid']."' AND 
                                touser= '".$_SESSION['touser']."') OR (fromuser = '".$_SESSION['touser']."' AND touser= '".$_SESSION['userid']."')")
                                or die("failed to query".mysql_error());
                                
                              }
                            ?>  
                          <?php if(mysqli_num_rows($msg) == 0){?>
                            
                              <div class="nomessage">
                              
                                   <p>No message available</p>
                              </div> 
                          <?php }else{?>    
                           <?php while($mess =mysqli_fetch_assoc($msg)){
                              if($mess['fromuser'] == $_SESSION['userid']){?>
                               
                                 <div class="outgoing_chats">
                                     <div class="outgoing_chats_msg">
                                         <p><?php echo $mess['message'];?></p>
                                          <span class="time"><?php echo $mess['time'];?></span>
                                         

                                      </div>
                                      <div class="outgoing_chats_img">
                                        <img src="./profile/<?php echo $mess['img'];?>" alt="">
                                      </div>
                                  </div>
                            <?php }else{?>      
                             <div class="received_chats">
                                     <div class="receive_chats_img">
                                        <img src="./profile/<?php echo $mess['img'];?>" alt="">
                                     </div>
                                       <div class="recieved_msg">
                                      <div class="received_msg_inbox">
                                       
                                      <p><?php echo $mess['message'];?></p>
                                        <span class="time"><?php echo $mess['time'];?></span>
                                      </div>
                                      </div>
                                      </div>
                                     
                            <?php }?>
                            <?php }?>
                            <?php }?>
                            
                                          
                        </div>
                        </div>
                     </div>
                  </div>
                <div class="msg_bottom">
                  <form class="myform" action="send.php"method="POST">
                       
                      <input type="text" name="msg" id="message"placeholder="Type a message">
                      <button type="submit"name="send"><i class="material-icons-outlined">send</i></button>
                 </form>
                 
                </div>
      </div>
     
</body>

<script type="text/javascript">

         $(document).ready(function(){
            $("#send").on("click",function(){
              $.ajax({
                  url:"send.php",
                  method:"POST",
                  data:{
                    fromuser: $("#fromuser").val(),
                    touser: $("#touser").val(),
                    message:$("#message").val()
                  },
                  dataType:"text",
                  success:function(data){
                    $("#message").val("");
                  }
              });
            });
        });
      </script>
</html>