<?php

session_destroy();
include("connection.php");
header('location:login.php?logout=true');
exit;


?>
