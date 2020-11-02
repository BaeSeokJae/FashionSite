<?php
$connect = mysqli_connect('54.180.145.206:3306', 'baeseokjae', 'qotjrwo95!', 'seokjae') or die ("connect fail");
$category = $_GET['category'];
$search_con = $_GET['search'];
$replacement = '<strong class="' . $search_con . '" style="color: #3CA9CD">' . $search_con . '</strong>';
/* 페이징 시작 */
//페이지 get 변수가 있다면 받아오고, 없다면 1페이지를 보여준다.
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}

$onePage = 9; // 한 페이지에 보여줄 게시글의 수.
$start = ($page - 1) * $onePage;
//게시글 목록을 가져오는 쿼리
$query = "SELECT SQL_CALC_FOUND_ROWS * FROM `daily_board` WHERE $category LIKE '%$search_con%' AND`status` = 'Y' AND (number = board_num)";
$query .= " ORDER BY number DESC ";
$query .= " LIMIT {$start}, {$onePage} ";
//        $sql = 'select count(*) as cnt from daily_board order by number desc';
$result = $connect->query($query);
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
    $paging .= '<li class="page page_start"><a href="./board.php?page=1"><img src="image/page_pprev.png"/></a></li>';
}

//첫 섹션이 아니라면 이전 버튼을 생성
if ($currentSection != 1) {
    $paging .= '<li class="page page_prev"><a href="./board.php?page=' . $prevPage . '"><img src="image/page_prev.png"/></a></li>';
}

for ($i = $firstPage; $i <= $lastPage; $i++) {
    if ($i == $page) {
        $paging .= '<li class="page current">' . $i . '</li>';
    } else {
        $paging .= '<li class="page"><a href="./board.php?page=' . $i . '">' . $i . '</a></li>';
    }
}
//마지막 섹션이 아니라면 다음 버튼을 생성
if ($currentSection != $allSection) {
    $paging .= '<li class="page page_next"><a href="./board.php?page=' . $nextPage . '"><img src="image/page_next.png"/></a></li>';
}

//마지막 페이지가 아니라면 끝 버튼을 생성
if ($page != $total_page) {
    $paging .= '<li class="page page_end"><a href="./board.php?page=' . $total_page . '"><img src="image/page_nnext.png"/></a></li>';
}

$paging .= '</ul>';

$list = array();
$i = 0;

while ($row = $result->fetch_array()) {
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
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <meta http-equiv="content-type" content="text/html; charset = UTF-8"/>
    <title>Seokjae</title>
    <link href="https://fonts.googleapis.com/css?family=Arvo" rel="stylesheet" type="text/css"/>
    <link href="style.css?ver=6" rel="stylesheet" type="text/css"/>
</head>
<body>
<div id="bg">
    <div id="outer">
        <div id="login">
            <?php
            $connect = mysqli_connect('54.180.145.206:3306', 'baeseokjae', 'qotjrwo95!', 'seokjae') or die ("connect fail");
            $board_number = 'select * from daily_board order by number desc limit 1';
            $result2 = $connect->query($board_number);
            $board_number1 = $result2->fetch_assoc();

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
                    <!--                    <li class="first">-->
                    <!--                        <a href="http://seokjae.cf/info.html">Info</a>-->
                    <!--                    </li>-->
                    <li>
                        <a href="#">공지사항</a>
                    </li>
                    <li>
                        <a href="http://seokjae.cf/board.php">게시판</a>
                    </li>
                    <li class="active">
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

                    .text input{
                        text-align: center;
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
                <h2 align=center>데일리룩</h2>
                <h4>데일리룩에서 '<?php echo $search_con; ?>'로 검색한 결과입니다.</h4>
                <thead align="center">
                </thead>
                <div id="thumbnailBox">
                    <?php if ($result->num_rows == 0) : ?>
                    <tr>
                        <td colspan="5" class="text-center">해당 내용에 대한 검색 결과가 없습니다.</td>
                    </tr>
                    <?php else : ?>
                    <?php foreach ($list as $row) : ?>
                    <?php
                    //                    while ($row1 = $result->fetch_assoc()) {
                    ?>
                    <div class="cell" style="width: auto;  height: auto;">
                        <a href="daily_board_view.php?number=<?= $row['board_num'] ?>"><?php echo '<img src=' . $row['imgurl'] . ' width=200  height=200 border="0" alt class="thumb"><p>'; ?></a>
                        <?php if ($row['daily_board_reply_count'] == 0) { ?>
                        <div width="100" align="center" style="font-size: 20px; margin: 10px; padding: 0 0 10px 0; border-bottom: solid 1px gray">
                            <?php if ($category == 'title') { ?>
                                <?php $str = preg_replace('/' . $search_con . '/', $replacement, $row["title"]);
                                print $str ?>
                            <?php } else { ?>
                            <?php echo($row['title']); ?>
                            <?php } ?>
                        </div>
                        <?php } else { ?>
                        <div width="100" align="center"
                             style="font-size: 20px; margin: 10px"><?php echo($row['title']); ?> <strong
                                    class="reply">(<?php echo $row['daily_board_reply_count'] ?>)</strong>
                        </div>
                        <?php } ?>
                        <div width="100" align="center"
                             style="font-size: 15px; margin: 15px ;">
                            조회수 : (<?php echo($row['hit']); ?>)
                        </div>
                        <div width="100" align="center" style="font-size: 15px; margin: 15px">작성자
                            : <?php echo($row['id']); ?></div>
                        <div width="100" align="center" style="font-size: 15px; margin: 15px">추천수
                            : <?php echo($row['content_like']); ?></div>
                    </div>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <div class="list" style="text-align: right">
                    <button style="cursor: hand" onClick="location.href='daily_board.php'">목록으로</button>
                </div>
                <form action="daily_write.php" method="get">
                    <div class=text>
                        <input type="hidden" name="number" width=1000 value="<?= $board_number1['number'] ?>">
                        <input type="submit" value="글쓰기" name="submit" style="margin: .9em; width: 50px;

                        background-color: #3CA9CD;

                        border: none;

                        color: #fff;

                        padding: 5px 0;

                        text-align: center;

                        text-decoration: none;

                        display: inline-block;

                        font-size: 13px;

                        cursor: pointer;">
                    </div>
                </form>
                <div class="paging">
                    <style>
                        .paging {
                            text-align: center;
                        }

                        .paging li {
                            display: inline-block;
                            width: 30px;
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
                    <?php if ($result->num_rows == 0) { ?>
                    <?php } else { ?>
                        <?php echo $paging ?>
                    <?php } ?>
                </div>
                <div id="search_box2">
                    <form action="daily_board_search.php" method="get">
                        <select name="category" style="width: 100px; font-size: 15px">
                            <option value="title">제목</option>
                            <option value="id">글쓴이</option>
                            <option value="content">내용</option>
                        </select>
                        <input type="text" name="search" size="50" required="required" style="height: 17px"/><button style="width: 50px; font-size: 15px; margin-left: 5px">검색</button>
                    </form>
                </div>
            </div>
            <div id="copyright">
                &copy; Seokjae. All rights reserved. | Design by <a href="http://templated.co"
                                                                    rel="nofollow">TEMPLATED</a>
            </div>
        </div>
</body>
</html>