<?php
  include 'connect.php';
  include 'config.php';

   $name = $_POST['username'];

   $sql3 = "DELETE FROM reply WHERE name='$name' ";
   $sql_result3= mysqli_query($conn, $sql3);

   $sql = "DELETE FROM board WHERE name='$name' ";
   $sql_result= mysqli_query($conn, $sql);

   $sql2 = "DELETE FROM user WHERE name='$name' ";
   $sql_result2= mysqli_query($conn, $sql2);


   
   $result=session_destroy();
   
   if($result){
            echo "
            <script>
                alert('회원 탈퇴되었습니다.');
                location.href = 'index.php';
            </script>";
        }
?>
    