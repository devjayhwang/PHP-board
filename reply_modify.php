<?php
  include 'connect.php';
  include 'config.php';


$rno= $_POST['rno'];
$sql= "SELECT * FROM reply WHERE idx='$rno' ";
$result= mysqli_query($conn, $sql);
$reply= mysqli_fetch_array($result);

$bno= $_POST['b_no'];

$rep_con= $_POST['rep_content'];
$sql2= "UPDATE reply SET content='$rep_con' WHERE idx='$rno' ";
$sql2_result= mysqli_query($conn, $sql2);
?>

<script >
  alert("수정되었습니다.");
  history.back();
</script>