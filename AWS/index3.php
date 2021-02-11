<?php

session_start();

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
    <link href="style.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="/js/popup.js"></script>
</head>
<body >
<div id="bg">
    <div id="outer">
        <div id="login">
            <?php
            $connect = mysqli_connect('13.209.88.207:3306', 'root', '1234', 'seokjae') or die ("connect fail");
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
            <?php } if (isset($_SESSION['userid'])) {

            } else { ?>
            <a href="http://seokjae.cf/join.php">회원가입</a>
            <?php }
            ?>
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
                <img src="Theme/templated-eponymous/images/Karl%20lagerfeld.jpg" width="720" height="378" alt=""/>
                <p>"personality begins Where Comparison ends"</p>
                <p>"비교를 멈출 때 개성은 시작된다."</p>
                <br>
                <p>"Karl Lagerfeld"</p>
                <p>"칼라거펠트"</p>
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
        #_hidden_layer_{position: absolute; z-index:999; width: 100%; height:100%; top: 0px; left: 0px;}/*팝업을 담아 제어할 레이어 - 그냥 상단에 커튼걸이 비슷한 용도*/
        #pop-layer-<?=$popupNum?>{position:absolute;z-index:999;display:none;width:<?=$popupWidth?>px;height:<?=$popupHeight?>px;top:<?=$popupTop?>px;left:<?=$popupLeft?>px;}/* 레이어 너비/높이, 상단/좌측 위치 width:600px;height:600px;top:130px;left:170px; */
        #pop-layer-<?=$popupNum?>-body{height:<?=$popupHeight-25?>px;overflow-x:hidden;overflow-y:hidden;border:#dfdfdf solid 1px;background:#ffffff;}/* 레이어 높이 -25 = height:575px;*/
        #pop-layer-<?=$popupNum?>-close{height:25px;background:#343434;text-align:center;color:#ffffff;}
        #pop-layer-<?=$popupNum?>-ckd{}
        #pop-layer-<?=$popupNum?>-btn{position:relative;left:20px;}
    </style>
    <!-- 레이어엘리먼트 -->
<!--    <div id="_hidden_layer_">-->
        <div id="pop-layer-<?=$popupNum?>">
            <div id="pop-layer-<?=$popupNum?>-body">
                <!-- 팝업 내용 입력영역 -->
                <a>
                    <img src="image/notice.jpeg" width="100%" height="75%" border="0" ></a>
                <!-- 팝업 내용 입력영역 끝-->
                <br><br>
                <div align="center">
                <a href="http://seokjae.cf/notice_view.php?number=1">
                    <img src="image/detail_image.png" width="50%" height="20%" border="0" ></a>
                </div>
            </div>
            <div id="pop-layer-<?=$popupNum?>-close">
                <!-- 하단 버튼영역 -->
                <input id="pop-layer-<?=$popupNum?>-ckd" type="checkbox">오늘 하루 이창을 그만 엽니다. &nbsp;
                <button id="pop-layer-<?=$popupNum?>-btn" onclick="hideLayerPopup('<?=$popupNum?>');" class="hand" alt="창닫기">X</button>
                <!-- 하단 버튼영역 끝-->
            </div>
        </div>
<!--    </div>-->
    <script type="text/javascript">
        <!--
        /*쿠키삭제*/
        function delPopupCookie(id){
            var nowcookie = getPopupCookie('popview');
            setPopupCookie('popview', '['+id+']' + nowcookie , 0);
        }
        /*쿠키세팅*/
        function setPopupCookie(name,value,expiredays) {
            var todayDate = new Date();
            todayDate.setDate( todayDate.getDate() + expiredays );
            document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + todayDate.toGMTString() + ";"
        }
        /*쿠키추출*/
        function getPopupCookie( name ){
            var nameOfCookie = name + "=";
            var x = 0;
            while ( x <= document.cookie.length ){
                var y = (x+nameOfCookie.length);
                if ( document.cookie.substring( x, y ) == nameOfCookie ) {
                    if ( (endOfCookie=document.cookie.indexOf( ";", y )) == -1 ) endOfCookie = document.cookie.length;
                    return unescape( document.cookie.substring( y, endOfCookie ) );
                }
                x = document.cookie.indexOf( " ", x ) + 1;
                if ( x == 0 ) break;
            }
            return "";
        }

        /*객체얻기*/
        function getElm(id){
            return document.getElementById(id);
        }

        /*닫기동작*/
        function hideLayerPopup(uid) {
            if (getElm('pop-layer-'+uid+'-ckd').checked == true){
                var nowcookie = getPopupCookie('popview');
                setPopupCookie('popview', '['+uid+']' + nowcookie , 1);
            }
            getElm('pop-layer-'+uid).style.display = 'none';
        }

        /*숨기기체크*/
        if (getPopupCookie('popview').indexOf('[<?=$popupNum?>]') == -1){
            getElm('pop-layer-<?=$popupNum?>').style.display = 'block';
        }

        /*숨겨진 팝업 쿠키를 초기화 할때 사용 - 스크립트가 아래 존재하기에 새로고침을 두번 해야 적용됨*/
        //delPopupCookie('<?//=$popupNum?>//');
        //-->
    </script>
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