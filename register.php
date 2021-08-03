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


         <ul class="dropdown">
            <li id="nav_menu">
                <i class="xi-user xi-2x"></i>
              <ul class="submenu">
                 <li><a href="login.php">로그인</a></li>
                 <li><a href="register.php">회원가입</a></li>
               </ul>
            </li>  
          </ul>

          </nav>
      </div>

  <div class="container">
      <div calss="register_title">
        <div class="create-account__title">회원가입</div>
      </div>
      <div class="register_area">
       <form action="register_ok.php" method="POST" id="register-form">
         <div class="regiinput_group">
           <input type="text" name="id" id="id" placeholder="아이디" />
         </div>
         <div class="regiinput_group">
           <input type="text" name="user" id="name" placeholder="닉네임(8글자이내)"/>
         </div>
         <div class="regiinput_group">
           <input type="password" name="pw" id="pw" placeholder="비밀번호"/>
         </div>
         <div class="regiinput_group">
           <input type="password" name="pwconfirm" id="pwconfirm" placeholder="비밀번호 확인"/>
         </div>  
         <div class="registerSubmit login_form button ">
          <input type="submit" value="회원가입" />
        </div>
       </form>
     </div>
  </div>

  </div>

  </body>
</html>
