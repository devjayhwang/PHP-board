
<?php
//db 연결
  include 'connect.php';

//id,pw가 post로 안넘어오면 exit
  if(!isset($_POST['id']) ||  !isset($_POST['pw'])) exit;

  $id= $_POST['id'];
  $pw= $_POST['pw'];

//id,pw가 공백이면 exit
if ( ($id=='') || ($pw=='') ) {
      echo (" <script>
            alert('아이디 또는 패스워드를 입력해 주세요.');
            history.back();
            </script>");
            exit;
}

//id가 있는지 검사
  $sql= "SELECT * FROM user WHERE id='$id'";
  $result= mysqli_query($conn, $sql);

  $num_match= mysqli_num_rows($result);

  if(!$num_match) {
        echo (" <script>
        alert('등록되지 않은 아이디입니다.');
        history.back();
        </script> ");
      } else {
            $row= mysqli_fetch_array($result);
            $db_pass= $row['pw'];


            if(!password_verify($pw, $db_pass)) {
                  echo (" <script>
                  alert('비밀번호가 틀립니다.');
                  history.back();
                  </script> ");
                  exit; 
            } else {
                  session_start();
                  $_SESSION['userid'] = $row['id'];
                  $_SESSION['username'] = $row['name'];
                  echo (" <script>
                  location.href = 'index.php';
                  </script> ");
            }
      }
      
?>
