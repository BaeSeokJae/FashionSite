<?php
session_start();
$connect = mysqli_connect('54.180.145.206:3306', 'baeseokjae', 'qotjrwo95!', 'seokjae') or die ("connect fail");
$connect->set_charset("UTF-8");

//simple_html_dom php 파일을 include함
include('./library/simple_html_dom.php');

$query = "SELECT SQL_CALC_FOUND_ROWS * FROM `board` WHERE `status` = 'Y' ";
$query .= " ORDER BY number DESC ";
$query .= " LIMIT 0, 7 ";
//        $sql = 'select count(*) as cnt from board order by number desc';
$result1 = $connect->query($query);

$list = array();
$i = 0;

while ($row = $result1->fetch_array()) {
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

//게시글 목록을 가져오는 쿼리
$query = "SELECT SQL_CALC_FOUND_ROWS * FROM `daily_board` WHERE `status` = 'Y' AND (number = board_num)";
$query .= " ORDER BY number DESC ";
$query .= " LIMIT 0,6";
//        $sql = 'select count(*) as cnt from daily_board order by number desc';
$result = $connect->query($query);

$list1 = array();
$i = 0;

while ($row1 = $result->fetch_array()) {
    $datetime = explode(' ', $row1['date']);
    $date = $datetime[0];
    $time = $datetime[1];
    if ($date == Date('Y-m-d'))
        $row['date'] = $date;
    else
        $row['date'] = $date;
    $list1[] = $row1;
    $i++;
}

$page_number = 2;
$number = 1;

$query = "SELECT SQL_CALC_FOUND_ROWS * FROM news";
//$query .= " ORDER BY id DESC ";
//$query .= " LIMIT {$start}, {$onePage} ";
$result3 = $connect->query($query);
$count = mysqli_num_rows($result3);

//if ($count == 0) {
//    while ($page_number < 7) {
//        $url = "https://www.fashionn.com/board/list_new.php?page=" . $page_number . "&table=1006"; //자신이 원하는 페이지
//        $html = file_get_html($url);
//        foreach ($html->find('div[id=content] div.text_none div.thum_board_wrap ul.list_type_list01 li.list') as $element) {  //이미지 태그의 주소를 찾아 배열에 저장
//            $item['title_url'] = $element->children(1)->children(0)->children(0)->href;
//            if ($item['title_url'] == null) {
//                $item['title_url'] = $element->children(0)->children(0)->children(0)->href;
//            }
//            $item['title'] = $element->children(1)->children(0)->children(0)->plaintext;
//            if ($item['title'] == null) {
//                $item['title'] = $element->children(0)->children(0)->children(0)->plaintext;
//            }
//            $item['context'] = $element->children(1)->children(1)->children(0)->plaintext;
//            if($item['context'] == null) {
//                $item['context'] = $element->children(0)->children(1)->children(0)->plaintext;
//            }
//            $item['url'] = $element->children(1)->children(0)->children(0)->href;
//            $item['img'] = $element->children(0)->children(0)->children(0)->src;
//            if ($item['img'] == null) {
//                $item['img'] = $element->children(0)->children(1)->children(0)->src;
//            }
//            $title_url = $item['title_url'];
//            $title = $item['title'];
//            $context = $item['context'];
//            $url = $item['url'];
//            $img = $item['img'];
//
//            $title_url = addslashes($title_url);
//            $title = addslashes($title);
//            $context = addslashes($context);
//            $url = addslashes($url);
//            $img = addslashes($img);
//
//            $sql = "insert into news(id, title_url, title, context, url, img)
//                        values(null,'$title_url','$title','$context','$url','$img')";
//            $result3 = $connect->query($sql);
//            reset($item);
//        }
//        $page_number++;
//    }
//} else if ($count > 0) {
//    while ($page_number < 7) {
//        $url = "https://www.fashionn.com/board/list_new.php?page=" . $page_number . "&table=1006"; //자신이 원하는 페이지
//        $html = file_get_html($url);
//        foreach ($html->find('div[id=content] div.text_none div.thum_board_wrap ul.list_type_list01 li.list') as $element) {  //이미지 태그의 주소를 찾아 배열에 저장
//            $item['title_url'] = $element->children(1)->children(0)->children(0)->href;
//            if ($item['title_url'] == null) {
//                $item['title_url'] = $element->children(0)->children(0)->children(0)->href;
//            }
//            $item['title'] = $element->children(1)->children(0)->children(0)->plaintext;
//            if ($item['title'] == null) {
//                $item['title'] = $element->children(0)->children(0)->children(0)->plaintext;
//            }
//            $item['context'] = $element->children(1)->children(1)->children(0)->plaintext;
//            if($item['context'] == null) {
//                $item['context'] = $element->children(0)->children(1)->children(0)->plaintext;
//            }
//            $item['url'] = $element->children(1)->children(0)->children(0)->href;
//            $item['img'] = $element->children(0)->children(0)->children(0)->src;
//            if ($item['img'] == null) {
//                $item['img'] = $element->children(0)->children(1)->children(0)->src;
//            }
//            $title_url = $item['title_url'];
//            $title = $item['title'];
//            $context = $item['context'];
//            $url = $item['url'];
//            $img = $item['img'];
//
//            $title_url = addslashes($title_url);
//            $title = addslashes($title);
//            $context = addslashes($context);
//            $url = addslashes($url);
//            $img = addslashes($img);
//
//            $query = "update news set title_url='$title_url', title='$title', context='$context', url='$url', img='$img' where id='$number'";
//            $result3 = $connect->query($query);
//            reset($item);
//            $number++;
//        }
//        $page_number++;
//    }
//}

$query = "SELECT SQL_CALC_FOUND_ROWS * FROM news";
//$query .= " ORDER BY id DESC ";
$query .= " LIMIT 0, 2";
$result3 = $connect->query($query);

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
    <link href="style.css?ver=5" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="/js/popup.js"></script>
</head>
<body>
<div id="bg">
    <div id="outer">
        <div id="login">
            <?php
            $connect = mysqli_connect('54.180.145.206:3306', 'baeseokjae', 'qotjrwo95!', 'seokjae') or die ("connect fail");
            $query = "select * from member order by number desc";
            $result = $connect->query($query);
            $total = mysqli_num_rows($result);

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
                        <a href="http://seokjae.cf/notice.php">공지사항</a>
                    </li>
                    <li>
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
            <div id="content">
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
                        padding: 5px;
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

                    #thumbnailBox div.cell {
                        background-color: #ffffff;
                        display: block;
                        float: left;
                        overflow: hidden;
                        margin: 15px;
                        padding-top: 20px;
                        padding-bottom: 20px;
                        border: 1px solid gray;
                        border-radius: 0em;
                    }
                </style>
                <div class=box3
                     style="display: inline-block; margin: 0px 0px 20px 20px; border: 0px solid rgb(221, 221, 221); width: 500px; height: 360px; float: left; background-image: none; background-repeat: repeat; background-color: rgb(255, 255, 255);">
                    <div class="index_board" style="text-align: center; border-bottom: solid 1px gray; padding: 5px">
                        게시판
                    </div>
                    <table align=center>
                        <thead align="center" >
                        <tr style="font-size: 13px">
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
                                    <?php if ($row['board_reply_count'] == 0) { ?>
                                        <td class="title" style="text-align: center">
                                            <a href="board_view.php?number=<?php echo $row['number']; ?>"><?php echo $row['title'] ?></a>
                                            </a>
                                        </td>
                                    <?php } else { ?>
                                        <td class="title" style="text-align: center">
                                            <a href="board_view.php?number=<?php echo $row['number']; ?>"><?php echo $row['title'] ?></a>
                                            <strong class="reply">
                                                ( <?php echo $row['board_reply_count']; ?> )
                                            </strong>
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
                </div>
                <div class=box4
                     style="display: inline-block; margin: 0px 0px 20px 20px; border: 0px solid rgb(221, 221, 221); width: 500px; height: 360px; float: left; background-image: none; background-repeat: repeat; background-color: rgb(255, 255, 255);">
                    <div class="index_daily_board" style="text-align: center; border-bottom: solid 1px gray; padding: 5px">
                        데일리룩
                    </div>
                    <div id="thumbnailBox" style="padding: 10px; margin: 0px; width: 480px">
                        <?php if ($result->num_rows == 0) : ?>
                            <tr>
                                <td colspan="5" class="text-center">등록된 글이 없습니다.</td>
                            </tr>
                        <?php else : ?>
                            <?php foreach ($list1 as $row1) : ?>
                                <div class="cell" style="width: 130px;  height: 130px; margin: 10px 10px 0 15px; padding-top: 10px; padding-bottom: 0px;">
                                    <a href="daily_board_view.php?number=<?= $row1['board_num'] ?>"><?php echo '<img src=' . $row1['imgurl'] . ' width=100  height=100 border="0" alt class="thumb" style="margin: auto"><p>'; ?></a>
                                    <?php if ($row1['daily_board_reply_count'] == 0) { ?>
                                        <div width="100" align="center"
                                             style="font-size: 13px; margin: 0px;"><?php echo($row1['title']); ?>
                                        </div>
                                    <?php } else { ?>
                                        <div width="100" align="center"
                                             style="font-size: 13px; margin: 0px"><?php echo($row1['title']); ?> <strong class="reply">(<?php echo $row1['daily_board_reply_count'] ?>)</strong>
                                        </div>
                                    <?php } ?>
<!--                                    <div width="100" align="center"-->
<!--                                         style="font-size: 15px; margin: 15px ;">-->
<!--                                        조회수 : (--><?php //echo($row1['hit']); ?><!--)-->
<!--                                    </div>-->
<!--                                    <div width="100" align="center" style="font-size: 15px; margin: 15px">작성자-->
<!--                                        : --><?php //echo($row1['id']); ?><!--</div>-->
<!--                                    <div width="100" align="center" style="font-size: 15px; margin: 15px">추천수-->
<!--                                        : --><?php //echo($row1['content_like']); ?><!--</div>-->
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class=box5
                     style="background-position: 0% 0%; margin: 0px 0px 20px 20px; border: 0px solid rgb(221, 221, 221); width: 1020px; height: 340px; float: left; background-image: none; background-repeat: repeat; background-color: rgb(255, 255, 255);">
                    <div class="index_news" style="text-align: center; border-bottom: solid 1px gray; padding: 5px">
                        뉴스
                    </div>
                    <div id="thumbnailBox" style="margin-top: 0px; padding: 0 0 0 0">
                        <ul class="box" style="width: auto;  height: 300px; margin-bottom: 0px;">
                            <?php while ($row2 = $result3->fetch_array()) { ?>
                                <li class="cell" style="width: auto;  height: 125px;  border-top: 0px; border-bottom: solid 1px gray">
                                    <p class="box1" style="width: 250px; height: 100px">
                                        <a href=https://www.fashionn.com/board/<?php echo $row2['url'] ?>> <?php echo '<img src=https://www.fashionn.com/' . $row2['img'] . '  width=170  height=120 border=\"0\" alt class=\"thumb\" style="padding-bottom: 0px"><a>'; ?></a>
                                        <dl class="box2">
                                            <a href=https://www.fashionn.com/board/<?php echo $row2['title_url'] ?>>
                                                <dt><?php echo $row2['title'] ?></dt>
                                    <p></p>
                                    <dd><?php echo $row2['context'] ?></dd>
                                    </a>
                                    </dl>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div id="copyright">
            &copy; Seokjae. All rights reserved. | Design by <a href="http://templated.co" rel="nofollow">TEMPLATED</a>
        </div>
    </div>
    <?php
    $popupNum = 20190801;//팝업창 고유번호
    $popupWidth = 400;//팝업창 너비
    $popupHeight = 400;//팝업창 높이
    $popupTop = 130;//팝업창 너비
    $popupLeft = 170;//팝업창 높이
    ?>
    <!-- 레이어스타일 -->
    <style type="text/css">
        #_hidden_layer_ {
            position: absolute;
            z-index: 999;
            width: 100%;
            height: 100%;
            top: 0px;
            left: 0px;
        }

        /*팝업을 담아 제어할 레이어 - 그냥 상단에 커튼걸이 비슷한 용도*/
        #pop-layer-<?=$popupNum?> {
            position: absolute;
            z-index: 999;
            display: none;
            width: <?=$popupWidth?>px;
            height: <?=$popupHeight?>px;
            top: <?=$popupTop?>px;
            left: <?=$popupLeft?>px;
        }

        /* 레이어 너비/높이, 상단/좌측 위치 width:600px;height:600px;top:130px;left:170px; */
        #pop-layer-<?=$popupNum?>-body {
            height: <?=$popupHeight-25?>px;
            overflow-x: hidden;
            overflow-y: hidden;
            border: #dfdfdf solid 1px;
            background: #ffffff;
        }

        /* 레이어 높이 -25 = height:575px;*/
        #pop-layer-<?=$popupNum?>-close {
            height: 25px;
            background: #343434;
            text-align: center;
            color: #ffffff;
        }

        #pop-layer-<?=$popupNum?>-ckd {
        }

        #pop-layer-<?=$popupNum?>-btn {
            position: relative;
            left: 20px;
        }
    </style>
    <!-- 레이어엘리먼트 -->
    <!--    <div id="_hidden_layer_">-->
    <div id="pop-layer-<?= $popupNum ?>">
        <div id="pop-layer-<?= $popupNum ?>-body">
            <!-- 팝업 내용 입력영역 -->
            <a>
                <img src="image/notice.jpeg" width="100%" height="75%" border="0">
            </a>
            <!-- 팝업 내용 입력영역 끝-->
            <br><br>
            <div align="center">
                <a href="http://seokjae.cf/notice_view.php?number=1">
                    <img src="image/detail_image.png" width="50%" height="20%" border="0"></a>
            </div>
        </div>
        <div id="pop-layer-<?= $popupNum ?>-close">
            <!-- 하단 버튼영역 -->
            <input id="pop-layer-<?= $popupNum ?>-ckd" type="checkbox">오늘 하루 이창을 그만 엽니다. &nbsp;
            <button id="pop-layer-<?= $popupNum ?>-btn" onclick="hideLayerPopup('<?= $popupNum ?>');" class="hand"
                    alt="창닫기">X
            </button>
            <!-- 하단 버튼영역 끝-->
        </div>
    </div>
    <!--    </div>-->
    <script type="text/javascript">
        <!--
        /*쿠키삭제*/
        function delPopupCookie(id) {
            var nowcookie = getPopupCookie('popview');
            setPopupCookie('popview', '[' + id + ']' + nowcookie, 0);
        }

        /*쿠키세팅*/
        function setPopupCookie(name, value, expiredays) {
            var todayDate = new Date();
            todayDate.setDate(todayDate.getDate() + expiredays);
            document.cookie = name + "=" + escape(value) + "; path=/; expires=" + todayDate.toGMTString() + ";"
        }

        /*쿠키추출*/
        function getPopupCookie(name) {
            var nameOfCookie = name + "=";
            var x = 0;
            while (x <= document.cookie.length) {
                var y = (x + nameOfCookie.length);
                if (document.cookie.substring(x, y) == nameOfCookie) {
                    if ((endOfCookie = document.cookie.indexOf(";", y)) == -1) endOfCookie = document.cookie.length;
                    return unescape(document.cookie.substring(y, endOfCookie));
                }
                x = document.cookie.indexOf(" ", x) + 1;
                if (x == 0) break;
            }
            return "";
        }

        /*객체얻기*/
        function getElm(id) {
            return document.getElementById(id);
        }

        /*닫기동작*/
        function hideLayerPopup(uid) {
            if (getElm('pop-layer-' + uid + '-ckd').checked == true) {
                var nowcookie = getPopupCookie('popview');
                setPopupCookie('popview', '[' + uid + ']' + nowcookie, 1);
            }
            getElm('pop-layer-' + uid).style.display = 'none';
        }

        /*숨기기체크*/
        if (getPopupCookie('popview').indexOf('[<?=$popupNum?>]') == -1) {
            getElm('pop-layer-<?=$popupNum?>').style.display = 'block';
        }

        /*숨겨진 팝업 쿠키를 초기화 할때 사용 - 스크립트가 아래 존재하기에 새로고침을 두번 해야 적용됨*/
        //delPopupCookie('<?//=$popupNum?>//');
        //-->
    </script>
    <?php simple_html_dom_node::class__destruct(); ?>
    <!-- --------------------------------------------------------- 레이어 팝업 소스 끝 --------------------------------------------------------- -->
    <!--    <script>-->
    <!--        var noticeCookie = getCookie("name");-->
    <!--        if (noticeCookie != "value"){-->
    <!--            // 팝업창 띄우기-->
    <!--            // window.open('popup.php', 'width=500, height=650, status=no, scrollbars= 0, toolbar=0, menubar=no');-->
    <!--            window.open('popup.php','창name','width=430, height=495, scrollbars=no');-->
    <!--        }-->
    <!--    </script>-->
</body>
</html>