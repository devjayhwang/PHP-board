

<?php

  include 'connect.php';


  $id=$_POST['id'];
  $pw=$_POST['pw'];
  $user=$_POST['user'];
  $pwconfirm=$_POST['pwconfirm'];


if ( ($id=='') || ($pw=='') || ($user=='') || ($pwconfirm=='') ) {
      echo (" <script>
            alert('빈칸을 입력해주세요.');
            history.back();
            </script>");
            exit;
}

  $check="SELECT * FROM user WHERE id='$id'";
  $result=mysqli_query($conn, $check);

  if(mysqli_num_rows($result)==1){
   echo (" <script>
     alert('이미 가입된 아이디입니다.');
     history.back();
     </script> ");
     exit(); } 

  $check_user="SELECT * FROM user WHERE name='$user'";
  $result2=mysqli_query($conn, $check_user);

  if(mysqli_num_rows($result2)==1){
   echo (" <script>
     alert('중복된 닉네임입니다.');
     history.back();
     </script> ");
     exit(); } 

  if($pw !== $pwconfirm) {
    echo (" <script>
     alert('비밀번호가 일치하지 않습니다.');
     history.back();
     </script> ");
     exit(); }
  
  $pw= password_hash($_POST['pw'], PASSWORD_DEFAULT);//입력받은 패스워드를 해쉬값으로 암호화
  $sql= "INSERT INTO user (id, pw, name) VALUES ('$id', '$pw', '$user')";

  $signup= mysqli_query($conn, $sql);
  
  if($signup){
    echo (" <script>
        alert('가입이 완료되었습니다.');
        location.replace('login.php');
        </script> ");
     } else {
      echo "가입에 실패했습니다.";
  }
  
  mysqli_close($conn);
?>
