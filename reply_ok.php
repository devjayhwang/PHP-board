<?php
  include 'connect.php';
  include 'config.php';

  $bno= $_POST['bno'];
  $user= $_POST['dat_user'];
  $cont= $_POST['rep_con'];
  $date= date('Y-m-d H:i:s');
  $sql="INSERT reply SET 
                  con_num= '$bno',
                  name= '$user',
                  content= '$cont',
                  date= '$date',
                  id= '$userid'    
                   ";
  $result= mysqli_query($conn, $sql); 

?>