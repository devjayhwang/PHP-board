
<?php
  include 'connect.php';
  include 'config.php';

  $bno = $_GET['idx'];
  $date= date('Y-m-d');
  $titleS= $_POST['title'];
  $title= addslashes($titleS);
  $contS= $_POST['content'];
  $cont= addslashes($contS);
  $sql = "UPDATE board SET date='$date', title='$title', content='$cont' WHERE idx='$bno' ";
  $sql_result= mysqli_query($conn, $sql);
?>

<script>
    alert("수정되었습니다.");
    history.go(-2);
  </script>
