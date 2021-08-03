<?php
  session_start();
  unset($_SESSION['userid']);
  unset($_SESSION['username']);
  
  $result=session_destroy();

  if($result){
      header('location: index.php');
  }
?>      
