<?php
$connect = mysqli_connect('13.209.88.207:3306', 'root', '1234', 'seokjae') or die ("connect fail");
//simple_html_dom php 파일을 include함
include('./library/simple_html_dom.php');
//$url = "https://www.musinsa.com/index.php?m=news&p=1"; //자신이 원하는 페이지
//$url = "https://www.fashionn.com/board/list_new.php?page=1&table=1006"; //자신이 원하는 페이지
//$html = file_get_html($url);

$page_number = 2;
$number = 1;
?>

<?php
/* 페이징 시작 */
//페이지 get 변수가 있다면 받아오고, 없다면 1페이지를 보여준다.
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}

$onePage = 10; //한 페이지에 보여줄 게시글의 수.
$start = ($page - 1) * $onePage;

$query = "SELECT SQL_CALC_FOUND_ROWS * FROM news";
//$query .= " ORDER BY id DESC ";
//$query .= " LIMIT {$start}, {$onePage} ";
$result = $connect->query($query);
$count = mysqli_num_rows($result);

if ($count == 0) {
    while ($page_number < 7) {
        $url = "https://www.fashionn.com/board/list_new.php?page=" . $page_number . "&table=1006"; //자신이 원하는 페이지
        $html = file_get_html($url);
        foreach ($html->find('div[id=content] div.text_none div.thum_board_wrap ul.list_type_list01 li.list') as $element) {  //이미지 태그의 주소를 찾아 배열에 저장
            $item['title_url'] = $element->children(1)->children(0)->children(0)->href;
            if ($item['title_url'] == null) {
                $item['title_url'] = $element->children(0)->children(0)->children(0)->href;
            }
            $item['title'] = $element->children(1)->children(0)->children(0)->plaintext;
            if ($item['title'] == null) {
                $item['title'] = $element->children(0)->children(0)->children(0)->plaintext;
            }
            $item['context'] = $element->children(1)->children(1)->children(0)->plaintext;
            if($item['context'] == null) {
                $item['context'] = $element->children(0)->children(1)->children(0)->plaintext;
            }
            $item['url'] = $element->children(1)->children(0)->children(0)->href;
            $item['img'] = $element->children(0)->children(0)->children(0)->src;
            if ($item['img'] == null) {
                $item['img'] = $element->children(0)->children(1)->children(0)->src;
            }
            $title_url = $item['title_url'];
            $title = $item['title'];
            $context = $item['context'];
            $url = $item['url'];
            $img = $item['img'];

            $title_url = addslashes($title_url);
            $title = addslashes($title);
            $context = addslashes($context);
            $url = addslashes($url);
            $img = addslashes($img);

            $sql = "insert into news(id, title_url, title, context, url, img)
                        values(null,'$title_url','$title','$context','$url','$img')";
            $result = $connect->query($sql);
            reset($item);
        }
        $page_number++;
    }
} else if ($count > 0) {
    while ($page_number < 7) {
        $url = "https://www.fashionn.com/board/list_new.php?page=" . $page_number . "&table=1006"; //자신이 원하는 페이지
        $html = file_get_html($url);
        foreach ($html->find('div[id=content] div.text_none div.thum_board_wrap ul.list_type_list01 li.list') as $element) {  //이미지 태그의 주소를 찾아 배열에 저장
            $item['title_url'] = $element->children(1)->children(0)->children(0)->href;
            if ($item['title_url'] == null) {
                $item['title_url'] = $element->children(0)->children(0)->children(0)->href;
            }
            $item['title'] = $element->children(1)->children(0)->children(0)->plaintext;
            if ($item['title'] == null) {
                $item['title'] = $element->children(0)->children(0)->children(0)->plaintext;
            }
            $item['context'] = $element->children(1)->children(1)->children(0)->plaintext;
            if($item['context'] == null) {
                $item['context'] = $element->children(0)->children(1)->children(0)->plaintext;
            }
            $item['url'] = $element->children(1)->children(0)->children(0)->href;
            $item['img'] = $element->children(0)->children(0)->children(0)->src;
            if ($item['img'] == null) {
                $item['img'] = $element->children(0)->children(1)->children(0)->src;
            }
            $title_url = $item['title_url'];
            $title = $item['title'];
            $context = $item['context'];
            $url = $item['url'];
            $img = $item['img'];

            $title_url = addslashes($title_url);
            $title = addslashes($title);
            $context = addslashes($context);
            $url = addslashes($url);
            $img = addslashes($img);

            $query = "update news set title_url='$title_url', title='$title', context='$context', url='$url', img='$img' where id='$number'";
            $result = $connect->query($query);
            reset($item);
            $number++;
        }
        $page_number++;
    }
}

if ($count == 0) {
    foreach ($html->find('body.NEWS_BODY div.column-wrapper div.bottom-column.column.clearfix div.main-content-wrapper div.main-content div.content-wrapper.news div.section ul.news-article-list.article-list.list li.listItem') as $element) {  //이미지 태그의 주소를 찾아 배열에 저장
        $item['title_url'] = $element->children(1)->children(0)->children(0)->href;
        $item['title'] = $element->children(1)->children(0)->children(0)->plaintext;
        $item['context'] = $element->children(1)->children(2)->plaintext;
        $item['url'] = $element->children(0)->children(0)->href;
        $item['img'] = $element->children(0)->children(0)->children(0)->src;

        $sql = "insert into news(id, title_url, title, context, url, img)
                        values(null,'$item[title_url]','$item[title]','$item[context]','$item[url]','$item[img]')";
        $result = $connect->query($sql);
        reset($item);
    }
} else if ($count > 0) {
    foreach ($html->find('body.NEWS_BODY div.column-wrapper div.bottom-column.column.clearfix div.main-content-wrapper div.main-content div.content-wrapper.news div.section ul.news-article-list.article-list.list li.listItem') as $element) {  //이미지 태그의 주소를 찾아 배열에 저장
        $item['title_url'] = $element->children(1)->children(0)->children(0)->href;
        $item['title'] = $element->children(1)->children(0)->children(0)->plaintext;
        $item['context'] = $element->children(1)->children(2)->plaintext;
        $item['url'] = $element->children(0)->children(0)->href;
        $item['img'] = $element->children(0)->children(0)->children(0)->src;

        $query = "update news set title_url='$item[title_url]', title='$item[title]', context='$item[context]', url='$item[url]', img='$item[img]' where id='$number'";
        $result = $connect->query($query);
        reset($item);
        $number++;
    }
}

$query = "SELECT SQL_CALC_FOUND_ROWS * FROM news";
//$query .= " ORDER BY id DESC ";
$query .= " LIMIT {$start}, {$onePage} ";
$result = $connect->query($query);

//게시글 목록을 가져오는 쿼리
$tmp_result = $connect->query("SELECT FOUND_ROWS() AS `cnt`");
$tmp_row = $tmp_result->fetch_array();
$total_count = (int)$tmp_row['cnt'];
$allPage = ceil($total_count / $onePage); //전체 페이지의 수

if ($page < 1 || ($allPage && $page > $allPage)) {
    ?>
    <script>
        alert("존재하지 않는 페이지입니다.");
        history.back();
    </script>
    <?php
    exit;
}

$oneSection = 10; //한번에 보여줄 총 페이지 개수(1 ~ 10, 11 ~ 20 ...)
$currentSection = ceil($page / $oneSection); //현재 섹션
$allSection = ceil($allPage / $oneSection); //전체 섹션의 수
$firstPage = ($currentSection * $oneSection) - ($oneSection - 1); //현재 섹션의 처음 페이지

if ($currentSection == $allSection) {
    $lastPage = $allPage; //현재 섹션이 마지막 섹션이라면 $allPage가 마지막 페이지가 된다.
} else {
    $lastPage = $currentSection * $oneSection; //현재 섹션의 마지막 페이지
}

$prevPage = (($currentSection - 1) * $oneSection); //이전 페이지, 11~20일 때 이전을 누르면 10 페이지로 이동.
$nextPage = (($currentSection + 1) * $oneSection) - ($oneSection - 1); //다음 페이지, 11~20일 때 다음을 누르면 21 페이지로 이동.
$paging = '<ul>'; // 페이징을 저장할 변수

//첫 페이지가 아니라면 처음 버튼을 생성
if ($page != 1) {
    $paging .= '<li class="page page_start"><a href="./news.php?page=1"><img src="image/page_pprev.png"/></a></li>';
}

//첫 섹션이 아니라면 이전 버튼을 생성
if ($currentSection != 1) {
    $paging .= '<li class="page page_prev"><a href="./news.php?page=' . $prevPage . '"><img src="image/page_prev.png"/></a></li>';
}

for ($i = $firstPage; $i <= $lastPage; $i++) {
    if ($i == $page) {
        $paging .= '<li class="page current">' . $i . '</li>';
    } else {
        $paging .= '<li class="page"><a href="./news.php?page=' . $i . '">' . $i . '</a></li>';
    }
}

//마지막 섹션이 아니라면 다음 버튼을 생성
if ($currentSection != $allSection) {
    $paging .= '<li class="page page_next"><a href="./news.php?page=' . $nextPage . '"><img src="image/page_next.png"/></a></li>';
}

//마지막 페이지가 아니라면 끝 버튼을 생성
if ($page != $allPage) {
    $paging .= '<li class="page page_end"><a href="./news.php?page=' . $allPage . '"><img src="image/page_nnext.png"/></a></li>';
}

$paging .= '</ul>';

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
    <link href="style.css?ver=7" rel="stylesheet" type="text/css"/>
</head>
<body>
<div id="bg">
    <div id="outer">
        <div id="login">
            <?php
            $connect = mysqli_connect('13.209.88.207:3306', 'root', '1234', 'seokjae') or die ("connect fail");

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
            ?>
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
                        <a href="#">공지사항</a>
                    </li>
                    <li>
                        <a href="http://seokjae.cf/board.php">게시판</a>
                    </li>
                    <li>
                        <a href="http://seokjae.cf/daily_board.php">데일리룩</a>
                    </li>
                    <li class="active">
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
                </style>
                <h2 align="center">패션소식</h2>
                <thead align="center">
                </thead>
                <div id="thumbnailBox">
                    <ul class="box" style="width: auto;  height: auto;">
                        <?php while ($row = $result->fetch_array()) { ?>
                            <li class="cell" style="width: auto;  height: auto;">
                                <p class="box1">
                                    <a href=https://www.fashionn.com/board/<?php echo $row['url'] ?>> <?php echo '<img src=https://www.fashionn.com/' . $row['img'] . '  width=170  height=120 border=\"0\" alt class=\"thumb\"><a>'; ?></a>
                                    <dl class="box2">
                                        <a href=https://www.fashionn.com/board/<?php echo $row['title_url'] ?>>
                                            <dt><?php echo $row['title'] ?></dt>
                                <p></p>
                                <dd><?php echo $row['context'] ?></dd>
                                </a>
                                </dl>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
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
                    <?php echo $paging ?>
                    <?php simple_html_dom_node::class__destruct(); ?>
                </div>
            </div>
            <div id="copyright">
                &copy; Seokjae. All rights reserved. | Design by <a href="http://templated.co"
                                                                    rel="nofollow">TEMPLATED</a>
            </div>
        </div>
</body>
</html>