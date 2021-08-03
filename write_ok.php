
<?php
  include 'connect.php';
  include 'config.php';

  $name= $username;
  $date= date('Y-m-d');
  $titleS= $_POST['title'];
  $title= addslashes($titleS);
  $contS= $_POST['content'];
  $cont= addslashes($contS);



  $sql= "INSERT INTO board (name, title, content, date, hit)
     VALUES ('$name', '$title', '$cont', '$date', 0)";

  $result= mysqli_query($conn, $sql);


  
  if($result){
     echo ("  <script>
     alert('글이 등록되었습니다.');
     location.href = 'index.php';
     </script> ");
  }
  else{
      echo (" <script>
      alert('글 등록 실패!');
      history.back();
      </script> ");
  }
  
  mysqli_close($conn);
?>
