<?php
  include 'connect.php';
  include 'config.php';
  include 'login_checking.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/xeicon@2.3.3/xeicon.min.css">
  <link rel="stylesheet" href="css/styles.css" />
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP Board Project</title>
</head>
<body>

<!-- 네비게이션메뉴 -->
      <div class="navbar"> 
          <nav role="navigation">

          <ul class="mainhomebt">
            <li id="nav_menu">
              <a href="index.php">
                <i class="xi-home xi-2x"></i>
              </a>
            </li>
          </ul>

<?php
    if (!$userid) {
?>
         <ul class="dropdown">
            <li id="nav_menu">
                <i class="xi-user xi-2x"></i>
              <ul class="submenu">
                 <li><a href="login.php">로그인</a></li>
                 <li><a href="register.php">회원가입</a></li>
               </ul>
            </li>  
          </ul>
<?php
    } else {
             $logged = $username."(".$userid.")";
?>
          <ul class="dropdown">
            <li id="nav_menu">
              <div class="nav_userinfo">
                <div class="index_username">
                  <b><?=$logged ?></b>
                </div>
                <div>
                  <i class="xi-user xi-2x"></i>
                </div>
               </div>
               <ul class="submenu">
                 <li><a href="mypages.php">정보수정</a></li>
                 <li><a href="logout_ok.php">로그아웃</a></li>
               </ul>
            </li> 
          </ul>
<?php
    }
?>
          </nav>
      </div>
<?php

   $sql = "SELECT * FROM user WHERE id='$userid'";
   $sql_result= mysqli_query($conn, $sql);
   $user = mysqli_fetch_array($sql_result);

?>

  <div class="container">

      <div calss="register_title">
        <div class="create-account__title">회원정보</div>
      </div>

      <div class="register_area">
       <form action="user_update.php" method="POST" id="register-form">

         <div class="regiinput_group">
           <input type="text" name="id" id="id" class="updateId" readonly value="<?php echo $user['id']; ?>" />
         </div>
         <div class="regiinput_group">
           <input type="text" name="name" id="name" placeholder="닉네임(8글자이내)" value="<?php echo $user['name'];?>"/>
         </div>
         <div class="regiinput_group">
           <input type="password" name="pw" id="pw" placeholder="새 비밀번호" />
         </div>
         <div class="regiinput_group">
           <input type="password" name="pwconfirm" id="pwconfirm" placeholder="새 비밀번호 확인" />
         </div>  
         <div class="registerSubmit login_form button ">
          <input type="submit" value="수정" />
        </div>

       </form>
      </div>

      <div class="user_del find_idpw">
        <form action="user_delete.php" method="POST">
          <input type="hidden" name="username" value="<?php echo $user['name'];?>" />
          <button class="user_del_btn" onclick="return confirm('회원 탈퇴 시 회원정보와 저장된 데이터가 모두 삭제됩니다.\n정말 탈퇴하시겠습니까?')">회원탈퇴</button>
        </form>
      </div>

  </div>

  </body>
</html>
