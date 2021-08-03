<?php
  include 'connect.php';
  include 'config.php';
  
//현재페이지 번호를 확인
    if (isset($_GET['page'])){
         $page= $_GET['page'];
  } else {
         $page= 1;
  }
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

      
<!--메인화면 이미지-->
      <div class="main_img">
        <img src="img/thibault-penin-AWOl7qqsffM-unsplash (1).jpg" class="main_imgFile"/>
      </div>

<!-- 게시판글리스트 틀 -->
    <div class="">      
      <table class="list_table">
        <thead>
         <tr>
            <th width="70">번호</th>
            <th width="500">제목</th>
            <th width="120">글쓴이</th>
            <th width="100">작성일</th>
            <th width="100">조회</th>
         </tr>
        </thead> 
<?php

  $sql = "SELECT * FROM board";
  $board_result= mysqli_query($conn, $sql);
  $total_record = mysqli_num_rows($board_result); //게시판 총 레코드 수
  $list = 10; //한페이지에 보여줄 개수
  $block_cnt = 5; // 블록당 보여줄 페이지 개수

  $block_num = ceil( $page / $block_cnt ); //현재 페이지 블록 구하기
  $block_start = (($block_num - 1) * $block_cnt) + 1; //블록의 시작번호 ex)1,6,11...
  $block_end = $block_start + $block_cnt - 1; //블록의 마지막번호 ex)5,10,15...

  $total_page = ceil($total_record / $list); //페이징한 페이지 수 구하기

          if($block_end > $total_page){
               $block_end = $total_page;
          }

  $total_block = ceil($total_page / $block_cnt);
  $page_start = ($page - 1) * $list;

  /* 게시글 정보 가져오기 */
  $sql2 ="SELECT * FROM board ORDER BY idx DESC LIMIT $page_start, $list";
  $result= mysqli_query($conn, $sql2);
         while($board= mysqli_fetch_array($result)){               
                 $titleS= $board["title"];
                 $title= addslashes($titleS);
                 /* 글자수가 20이 넘으면 ...처리해주기 */
                 if(strlen($title)>20) {
                    $title=str_replace($board["title"],mb_substr($board["title"],0,20,"utf-8")."...",$board["title"]);  
                 } 
  /* 댓글수 카운트 */
  $repc_num= $board['idx'];
  $sql3= "SELECT * FROM reply WHERE con_num='$repc_num' ";
  $slq3_result= mysqli_query($conn, $sql3);
  $rep_count= mysqli_num_rows($slq3_result);

?>
<!-- 게시글 가져오기 -->
        <tbody>
          <tr>
            <td  width="70"><?php echo $board['idx']; ?></td>
            <td  width="500">
             <a href ="read.php?idx=<?php echo $board["idx"];?>"><?php echo $title; ?></a>
<?php //댓글개수가 0개 이상일때만 표시되도록
    if($rep_count>0){ ?>
      <span class="rep_count">
<?php      echo $rep_count; ?>
      </span>
<?php    } else {}
?>
            </td>
            <td width="120"><?php echo $board['name']; ?></td>
            <td width="100"><?php echo $board['date']; ?></td>
            <td width="100"><?php echo $board['hit']; ?></td>
          </tr>
        </tbody><!-- 게시글 가져오기끝-->
        <?php  } ?>
      </table>
    </div><!-- 게시판글리스트 끝 -->

<!-- 글쓰기버튼,페이징,내글보기,검색 블럭-->
    <div class="pagingbox">
       
      <!-- 글쓰기버튼 -->
      <div class="write_btn">
        <input class="btn" type="button" onclick="location.href='write.php'" value="글쓰기" />
      </div>

      <!-- 페이징처리 -->
      <div class="inner_paging_num">
        <ul class="inner_paging_num pagingBox_ul">

            <li class="paging_numbox"><a href='?page=1'><<</a></li>
 <?php 
    if ($page <= 1){
    } else {
      $pre = $page - 1; ?>
            <li class="paging_numbox"><a href='?page=<?php echo $pre;?>'><</a></li>
<?php  }
    for($i=$block_start; $i<=$block_end; $i++){
      if($page == $i){ ?>
            <li class="paging_numbox cur_pageNum"><a href='?page=<?php echo $i; ?>'><?php echo $i;?></a></li>
<?php } else { ?>
            <li class="paging_numbox"><a href='?page=<?php echo $i;?>'><?php echo $i; ?> </a></li>
<?php }
    }
    if($page >= $total_page){
    } else {
          $next = $page + 1; ?>
          <li class="paging_numbox"><a href='?page=<?php echo $next; ?>'>></a></li>
<?php    } ?>
      <li class="paging_numbox paging_boxr"><a href='?page=<?php echo $total_page; ?>'>>></a></li>

        </ul>
      </div>
    </div>

      <!-- 검색 -->
      <div id="search_box">
       <form action="search_result.php" method="GET" >
         <select name="category">
          <option value="title">제목</option>
          <option value="name">글쓴이</option>
          <option value="content">내용</option>
         </select>
         <input type="text" name="search" size="40" required="required">
         <button class="btn search_btn">검색</button>
       </form>
      </div> 

    </div>



  
</body>
</html>