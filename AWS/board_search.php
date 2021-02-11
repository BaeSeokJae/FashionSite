<?php
$connect = mysqli_connect('13.209.88.207:3306', 'root', '1234', 'seokjae') or die ("connect fail");
$connect->set_charset("UTF-8");
$category = $_GET['category'];
$search_con = $_GET['search_con'];

$replacement = '<strong class="'.$search_con.'" style="color: #3CA9CD">'.$search_con.'</strong>';

/* 페이징 시작 */
//페이지 get 변수가 있다면 받아오고, 없다면 1페이지를 보여준다.
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}

$onePage = 10; // 한 페이지에 보여줄 게시글의 수.
$start = ($page - 1) * $onePage;

$query = "SELECT SQL_CALC_FOUND_ROWS * FROM board WHERE $category LIKE '%$search_con%' AND status = 'Y' ";

//게시글 목록을 가져오는 쿼리
//$query = "SELECT SQL_CALC_FOUND_ROWS * FROM `board` WHERE `status` = 'Y' ";
$query .= " ORDER BY number DESC ";
$query .= " LIMIT {$start}, {$onePage} ";
//        $sql = 'select count(*) as cnt from board order by number desc';
$result1 = $connect->query($query);
//        $row = $result->fetch_assoc();

$tmp_result = $connect->query("SELECT FOUND_ROWS() AS `cnt`");
$tmp_row = $tmp_result->fetch_array();
$total_count = (int)$tmp_row['cnt'];
$total_page = ceil($total_count / $onePage);

$oneSection = 10; //한번에 보여줄 총 페이지 개수(1 ~ 10, 11 ~ 20 ...)
$currentSection = ceil($page / $oneSection); //현재 섹션
$allSection = ceil($total_page / $oneSection); //전체 섹션의 수
$firstPage = ($currentSection * $oneSection) - ($oneSection - 1); //현재 섹션의 처음 페이지

if ($currentSection == $allSection) {
    $lastPage = $total_page; //현재 섹션이 마지막 섹션이라면 $total_page가 마지막 페이지가 된다.
} else {
    $lastPage = $currentSection * $oneSection; //현재 섹션의 마지막 페이지
}
$prevPage = (($currentSection - 1) * $oneSection); //이전 페이지, 11~20일 때 이전을 누르면 10 페이지로 이동.
$nextPage = (($currentSection + 1) * $oneSection) - ($oneSection - 1); //다음 페이지, 11~20일 때 다음을 누르면 21 페이지로 이동.
$paging = '<ul>'; // 페이징을 저장할 변수

//첫 페이지가 아니라면 처음 버튼을 생성
if ($page != 1) {
    $paging .= '<li class="page page_start"><a href="./board_search.php?category=' . $category . '&search_con=' . $search_con . '&page=1"><img src="image/page_pprev.png"/></a></li>';
}

//첫 섹션이 아니라면 이전 버튼을 생성
if ($currentSection != 1) {
    $paging .= '<li class="page page_prev"><a href="./board_search.php?category=' . $category . '&search_con=' . $search_con . '&page=' . $prevPage . '"><img src="image/page_prev.png"></a></li>';
}

for ($i = $firstPage; $i <= $lastPage; $i++) {
    if ($i == $page) {
        $paging .= '<li class="page current">' . $i . '</li>';
    } else {
        $paging .= '<li class="page"><a href="./board_search.php?category=' . $category . '&search_con=' . $search_con . '&page=' . $i . '">' . $i . '</a></li>';
    }
}

//마지막 섹션이 아니라면 다음 버튼을 생성
if ($currentSection != $allSection) {
    $paging .= '<li class="page page_next"><a href="./board_search.php?category=' . $category . '&search_con=' . $search_con . '&page=' . $nextPage . '"><img src="image/page_next.png"></a></li>';
}

//마지막 페이지가 아니라면 끝 버튼을 생성
if ($page != $total_page) {
    $paging .= '<li class="page page_end"><a href="./board_search.php?category=' . $category . '&search_con=' . $search_con . '&page=' . $total_page . '"><img src="image/page_nnext.png"/></a></li>';
}

$paging .= '</ul>';

/* 페이징 끝 */
//        $currentLimit = ($onePage * $page) - $onePage; //몇 번째의 글부터 가져오는지
//        $sqlLimit = ' limit ' . $currentLimit . ', ' . $onePage; //limit sql 구문
//        $sql = 'select * from board order by number desc' . $sqlLimit; //원하는 개수만큼 가져온다. (0번째부터 20번째까지
//        $result = $connect->query($sql);

$list = array();
$i = 0;

while ($row = $result1->fetch_array()) {
    $row['nums'] = $total_count - $start - $i;    // 글번호 매기기
    $datetime = explode(' ', $row['date']);
    $date = $datetime[0];
    $time = $datetime[1];
    if ($date == Date('Y-m-d'))
        $row['date'] = $date;
    else
        $row['date'] = $date;
    $list[] = $row;
    $i++;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--

	Design by TEMPLATED
	http://templated.co
	Released for free under the Creative Commons Attribution License

	Name       : Eponymous
	Version    : 1.0
	Released   : 20130222

-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <script src="https://code.jquery.com/jquery-1.11.2.js"></script>
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <meta http-equiv="content-type" content="text/html" charset=UTF-8"/>
    <title>Seokjae</title>
    <link href="https://fonts.googleapis.com/css?family=Arvo" rel="stylesheet" type="text/css"/>
    <link href="style.css?ver=1" rel="stylesheet" type="text/css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/paginationjs/2.1.4/pagination.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paginationjs/2.1.4/pagination.css"/>
</head>
<body>
<div id="bg">
    <div id="outer">
        <div id="login">
            <?php
            session_start();
            if (isset($_SESSION['userid'])) {
                echo $_SESSION['userid']; ?>님 안녕하세요
                <button onclick="location.href='./logout.php'">로그아웃</button>
                <br/>
                <?php
            } else { ?>
                <button onclick="location.href='./login.php'">로그인</button>
                <br/>
            <?php }
            if (isset($_SESSION['userid'])) {
            } else { ?>
                <a href="http://seokjae.cf/join.php">회원가입</a>
            <?php }
            //            ?>
            <!--            <a href="#">아이디 / 비밀번호 찾기</a>-->
        </div>
        <div id="header">
            <div id="logo">
                <h1>
                    <a href="http://seokjae.cf">Seokjae</a>
                </h1>
            </div>
            <div id="nav">
                <ul>
                    <li>
                        <a href="http://seokjae.cf/notice.php">공지사항</a>
                    </li>
                    <li class="active">
                        <a href="http://seokjae.cf/board.php">게시판</a>
                    </li>
                    <li>
                        <a href="http://seokjae.cf/daily_board.php">데일리룩</a>
                    </li>
                    <li class="last">
                        <a href="http://seokjae.cf/news.php">패션소식</a>
                    </li>
                </ul>
                <br class="clear"/>
            </div>
        </div>
        <div id="main">
            <div id="contentlist">
                <style>
                    table {
                        border-top: 1px solid #444444;
                        border-collapse: collapse;
                    }

                    tr {
                        border-bottom: 1px solid #444444;
                        padding: 10px;
                    }

                    td {
                        border-bottom: 1px solid #efefef;
                        padding: 10px;
                    }

                    table .even {
                        background: #efefef;
                    }

                    .text {
                        text-align: center;
                        padding-top: 20px;
                        color: #000000
                    }

                    .text:hover {
                        text-decoration: underline;
                    }

                    a:link {
                        color: #57A0EE;
                        text-decoration: none;
                    }

                    a:hover {
                        text-decoration: underline;
                    }

                    .td strong {
                        color: #3CA9CD;
                    }

                    .text button {
                        width: 50px;

                        background-color: #3CA9CD;

                        border: none;

                        color: #fff;

                        padding: 5px 0;

                        text-align: center;

                        text-decoration: none;

                        display: inline-block;

                        font-size: 13px;

                        cursor: pointer;
                    }

                    .list button {
                        width: 50px;

                        background-color: #3CA9CD;

                        border: none;

                        color: #fff;

                        padding: 5px 0;

                        text-align: center;

                        text-decoration: none;

                        display: inline-block;

                        font-size: 13px;

                        cursor: pointer;
                    }

                    #search_box2 button {
                        width: 50px;

                        background-color: #3CA9CD;

                        border: none;

                        color: #fff;

                        padding: 5px 0;

                        text-align: center;

                        text-decoration: none;

                        display: inline-block;

                        font-size: 13px;

                        cursor: pointer;
                    }
                </style>
                <h2 align=center>게시판</h2>
                <h4>게시판에서 '<?php echo $search_con; ?>'로 검색한 결과입니다.</h4>
                <table align=center>
                    <thead align="center">
                    <tr>
                        <td width="50" align="center">번호</td>
                        <td width="450" align="center">제목</td>
                        <td width="80" align="center">작성자</td>
                        <td width="180" align="center">날짜</td>
                        <td width="70" align="center">조회수</td>
                        <td width="70" align="center">추천수</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if ($result1->num_rows == 0) : ?>
                        <tr>
                            <td colspan="5" class="text-center">등록된 글이 없습니다.</td>
                        </tr>
                    <?php else : ?>
                        <?php foreach ($list as $row) : ?>
                            <tr>
                                <td class="no" align="center"><?= $row['nums'] ?></td>
                                <?php if ($row['board_reply_count'] == 0) { ?>
                                    <td class="title" align="center">
                                        <?php if ($category == 'title') { ?>
                                        <a href="board_view.php?number=<?php echo $row['number'] ?>">
                                            <?php $str = preg_replace('/' . $search_con . '/', $replacement, $row["title"]);
                                            print $str ?>
                                        </a>
                                        <?php } else { ?>
                                            <a href="board_view.php?number=<?php echo $row['number'] ?>">
                                                <?php echo $row['title']?>
                                            </a>
                                        <?php } ?>
                                    </td>
                                <?php } else { ?>
                                    <td class="title" align="center">
                                        <a href="board_view.php?number=<?php echo $row['number']; ?>">
                                            <?php if ($category == 'title') { ?>
                                            <?php $str = preg_replace('/' . $search_con . '/', $replacement, $row["title"]);
                                            print $str ?></a>
                                        <strong class="reply">
                                            ( <?php echo $row['board_reply_count']; ?> )
                                        </strong>
                                        <?php } else { ?>
                                            <a href="board_view.php?number=<?php echo $row['number'] ?>">
                                                <?php echo $row['title']?>
                                            </a>
                                            <strong class="reply">
                                                ( <?php echo $row['board_reply_count']; ?> )
                                            </strong>
                                        <?php } ?>
                                    </td>
                                <?php } ?>
                                <td class="author" align="center"><?php echo $row['id'] ?></td>
                                <td class="date" align="center"><?php echo $row['date'] ?></td>
                                <td class="hit" align="center"><?php echo $row['hit'] ?></td>
                                <td class="like_count" align="center"><?php echo $row['content_like'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </tbody>
                </table>
                <div class="list" style="text-align: right">
                    <button style="cursor: hand" onClick="location.href='board.php'">목록으로</button>
                </div>
                <div class=text align="right">
                    <button style="cursor: hand" onClick="location.href='board_write.php'">글쓰기</button>
                </div>
                <br>
                <div class="paging">
                    <style>
                        .paging {
                            text-align: center;
                        }

                        .paging li {
                            display: inline-block;
                            width: 40px;
                            height: 10px;
                            /*margin: 0 5px;*/
                            /*padding: 0 5px;*/
                            border: 1px solid #666;
                            background: #eee;
                            line-height: 21px;
                        }

                        .paging li.current,
                        .paging li:hover {
                            background: #666;
                        }

                        .paging li.current,
                        .paging li:hover a {
                            color: #ddd;
                        }
                    </style>
                    <?php if ($result1->num_rows == 0) { ?>
                    <?php } else { ?>
                        <?php echo $paging ?>
                    <?php } ?>
                </div>
                <div id="search_box2">
                    <form action="board_search.php" method="get">
                        <select name="category " style="width: 100px; font-size: 15px">
                            <option value="title">제목</option>
                            <option value="content">내용</option>
                            <option value="id">글쓴이</option>
                        </select>
<!--                        --><?php //} else if ($category == 'content') {?>
<!--                        <select name="category" style="width: 100px; font-size: 15px">-->
<!--                            <option value="content">내용</option>-->
<!--                            <option value="title">제목</option>-->
<!--                            <option value="id">글쓴이</option>-->
<!--                        </select>-->
<!--                        --><?php //} else if ($category == 'id') {?>
<!--                        <select name="category" style="width: 100px; font-size: 15px">-->
<!--                            <option value="id">글쓴이</option>-->
<!--                            <option value="title">제목</option>-->
<!--                            <option value="content">내용</option>-->
<!--                        </select>-->
<!--                        --><?php //} ?>
                        <input type="text" name="search_con" size="50" required="required" style="height: 17px"/><button style="width: 50px; font-size: 15px; margin-left: 5px">검색</button>
                    </form>
                </div>
            </div>
        </div>
        <div id="copyright">
            &copy; Seokjae. All rights reserved. | Design by <a href="http://templated.co" rel="nofollow">TEMPLATED</a>
        </div>
    </div>
</body>
</html>