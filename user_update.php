
<?php
  include 'connect.php';
  include 'config.php';

  $id=$_POST['id'];
  $pw=$_POST['pw'];
  $name=$_POST['name'];
  $pwconfirm=$_POST['pwconfirm'];

  if ( ($pw=='') || ($name=='') || ($pwconfirm=='') ) {
      echo (" <script>
            alert('빈칸을 입력해주세요.');
            history.back();
            </script>");
            exit;
}

  if($pw !== $pwconfirm) {
    echo (" <script>
     alert('비밀번호가 일치하지 않습니다.');
     history.back();
     </script> ");
     exit;
}

  $pw= password_hash($_POST['pw'], PASSWORD_DEFAULT);//입력받은 패스워드를 해쉬값으로 암호화
  $sql = "UPDATE user SET pw='$pw', name='$name' WHERE id='$id' ";
  $result= mysqli_query($conn, $sql);

    if($result){
    echo (" <script>
        alert('회원정보가 수정되었습니다.');
        location.replace('login.php');
        </script> ");
     } else {
      echo "회원정보 수정이 실패했습니다.";
  }
  
?>
