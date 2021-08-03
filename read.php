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

<?php

   $bno = $_GET['idx'];
   $sql = "SELECT * FROM board WHERE idx='$bno'";
   $sql_result= mysqli_query($conn, $sql);
   $board = mysqli_fetch_array($sql_result);
   /* 조회수 올리기 */
   $hit = $board['hit'] + 1;
   $fet = "UPDATE board SET hit='$hit' WHERE idx='$bno'";
   $fet_result= mysqli_query($conn, $fet);
   /*조회수 올리기 끝 */     
?>
<!-- 글 불러오기 -->
    <div id="board_read">

      <div class="board_content">
        <div id="read_title">
          <?php echo $board['title']; ?>
        </div>
	    	<div class="read_user">
          <div class="read_user_column">
		    	 <span class="board_writer"><?php echo $board['name']; ?></span>
           <span class="board_time"><?php echo $board['date']; ?></span>
           <span class="board_hit">조회 <?php echo $hit; ?></span>
          </div>
	    	</div>
	    	<div id="read_content">
		    	<?php echo addslashes(nl2br("$board[content]")); ?>
	    	</div>
      </div>
	<!-- 목록, 수정, 삭제 -->
	      <div id="board_ser">

            <div class="returnlist_btn">
              <button class="btn" onclick="history.back(-1)">목록</button>
            </div>
<?php
  if ($username==$board['name']){
?>      
            <div class="updateDelete_btn">
              <button class="btn update_btn" onclick="location.href= 'update.php?idx=<?php echo $board['idx']; ?>'">수정</button>
              <form action="delete.php" method="POST">
                <input type="hidden" name="idx" value="<?php echo $board['idx'];?>" />
                <button class="btn delete_btn" onclick="return confirm('삭제하시겠습니까?')">삭제</button>
              </form>
            </div>
<?php } ?>
	      </div>
    </div><!--글불러오기끝-->

    


<!-- 댓글불러오기 -->
<div class="reply_view">
<?php
  $sql2 ="SELECT * FROM reply WHERE con_num='$bno' ORDER BY idx ";
  $sql2_result= mysqli_query($conn, $sql2);
    while($reply= mysqli_fetch_array($sql2_result)){
?>
          <div class="dat_view">
            <div class="dat_component">
              <div class="dat_component_column">

                <div>
                  <div>
                  <span class="dat_username"><?php echo $reply['name']; ?></span>
                  <span class="dat_time"><?php echo $reply['date']; ?></span>
                  </div>
                  <p class="dat_content"><?php echo nl2br("$reply[content]"); ?></p>
                </div>
              </div>
              <div class="dat_component_column">
<?php 
    if ($username==$reply['name']){ 
?>          
                <!--댓글수정-->
                <div class="dat_edit_btn">
                  <button id="rep_edit_btn" data-toggle="modal" data-target="#modalBox<?php echo $reply['idx'];?>">수정</button>
                </div>
                <!--댓글삭제-->
                <div class="dat_del_btn">
                  <form action="reply_delete.php" method="POST">
                    <input type="hidden" name="rno" value="<?php echo $reply['idx'];?>" />
                    <button class="dat_del_btn" onclick="return confirm('삭제하시겠습니까?')">삭제</button>
                  </form>
                </div>
  
<?php } ?>
              </div>
            </div>
          </div><!--dat_view 끝-->
<!--  수정버튼클릭시 댓글수정 모달창 펼치기 -->
<!-- Modal -->

  <div id="modalBox<?php echo $reply['idx'];?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog" role="document">
    <div class="modal-content">

    <form method="POST" action="reply_modify.php">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">댓글수정</h4>
      </div>
      <div class="modal-body">
        <input type="hidden" name="rno" class="rno" value="<?php echo $reply['idx']; ?>" />
        <input type="hidden" name="b_no" class="b_no" value="<?php echo $bno; ?>">
        <textarea name="rep_content" class="rep_modal_con" placeholder="댓글을 작성해주세요." required><?php echo $reply['content'];?></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" >취소</button>
        <input type="submit" class="btn modal_edit_btn" value="수정"></input>
      </div>
    </form>

    </div>
  </div>
</div>
           
<?php  }?>             


<!-- 댓글달기 폼-->
<div class="dat_ins">
  <input type="hidden" name="bno" class="bno" value=" <?php echo $bno;?>" />
  <input type="hidden" name="dat_user" id="dat_user" class="dat_user" value="<?php echo $username;?>" /> 
  <div class="dat_ins_textbtn wrap">
    <div class="box_textarea">
      <textarea name="content" class="rep_con" placeholder="댓글을 작성해주세요." ></textarea>
    </div>
    <div class="rep_btn">
      <button class="btn" id="rep_btn">댓글등록</button>
    </div>
  </div>
</div><!--댓글달기폼끝-->

</div><!--댓글불러오기끝-->


	<!-- jQuery CDN -->
  <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="js/reply.js"></script>
</body>
</html>