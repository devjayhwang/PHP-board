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

  <div>
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
              </a>
              <ul class="submenu">
                 <li><a href="login.php">로그인</a></li>
                 <li><a href="register.php">회원가입</a></li>
               </ul>
            </li>  
          </ul>     
          </nav>
      </div>

    <div class="container">
      <div class="login_register">
      <form action="login_ok.php" method="POST" >
         <div class="login_form text">
          <input name="id" type="text" placeholder="아이디" />
          <input name="pw" type="password" placeholder="비밀번호" />
         </div>
         <div class="login_form button">
          <input type="submit" value="로그인" />
          <input type="button" onclick="location.href='register.php'" value="회원가입" />
         </div>
      </form>
      </div>
    </div>

  </div>
</body>
</html>
