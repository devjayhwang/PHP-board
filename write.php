<?php
  include 'connect.php';
  include 'config.php';
  include 'login_checking.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <script src="http://code.jquery.com/jquery-latest.js"></script>
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/xeicon@2.3.3/xeicon.min.css">
  <link rel="stylesheet" href="css/styles.css" />
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP Board Project</title>
    <script>
    $(document).ready(function() {
      $('.wrap').on( 'keyup', 'textarea', function (e){
        $(this).css('height', 'auto' );
        $(this).height( this.scrollHeight );
      });
      $('.wrap').find( 'textarea' ).keyup();
    });
  </script>
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
<!-- 네비게이션메뉴 끝-->
<!-- 글쓰기 -->
        <div id="write_area">
          <div class="write_content">
            <form class="write_form" action="write_ok.php" method="POST">        
                <div id="in_title">
                   <input class="in_title" type="text" name="title" placeholder="제목을 입력하세요." maxlength="100" required/>
                </div>
                <div id="in_content" class="wrap">
                   <textarea class="in_content autosize" name="content" required></textarea>
                </div>
                <div class="write_button">
                    <input class="btn" type="submit" value="등록" />
                </div>
            </form>
          </div>
        </div>
<!-- 글쓰기 끝-->

</body>
</html>