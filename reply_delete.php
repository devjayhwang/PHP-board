<?php
  include 'connect.php';
  include 'config.php';


  $rno= $_POST['rno'];
  $sql= "DELETE FROM reply WHERE idx='$rno' ";
  $result= mysqli_query($conn, $sql);

?>


   <script>
          alert("댓글이 삭제되었습니다.");
          history.back();
     </script>

