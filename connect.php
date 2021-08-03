<?php 
header("Content-Type:text/html; charset=UTF-8");
 $conn = mysqli_connect("localhost", "root", "*Hjungwoo2819", "BBS_project1");
 mysqli_set_charset($conn, 'utf-8');
 if(mysqli_connect_errno($conn)){
     echo "연결실패" .mysqli_connect_error();
 }
?>