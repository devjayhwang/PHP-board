<?php
  include 'connect.php';

   $bno = $_POST['idx'];
   $sql = "DELETE FROM board WHERE idx='$bno' ";
   $sql_result= mysqli_query($conn, $sql);

?>

<script>
    alert("글이 삭제되었습니다.");
</script>
<meta http-equiv="refresh" content="0 url=/PHP-board/index.php">