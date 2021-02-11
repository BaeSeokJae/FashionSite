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
</head>
<body>
<div id="bg">
    <div id="outer">
        <div id="login">
            <?php
            $connect = mysqli_connect('13.209.88.207:3306', 'root', '1234', 'seokjae') or die ("connect fail");
            $query = "select * from board order by number desc";
            $result = $connect->query($query);
            $total = mysqli_num_rows($result);

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

            }
            else { ?>

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
            <div id="contentlist">
                <div align='center'>
                    <span>로그인</span>
                    <form method='post' action='login_action.php'>
                        <p>ID: <input name="id" type="text"></p>
                        <p>PW: <input name="pw" type="password"></p>
                        <input type="submit" value="로그인">
                    </form>
                    <br />
                    <button id="join" onclick="location.href='./join.php'">회원가입</button>
                </div>
            </div>
        </div>
        <div id="copyright">
            &copy; Seokjae. All rights reserved. | Design by <a href="http://templated.co" rel="nofollow">TEMPLATED</a>
        </div>
    </div>
</body>
</html>
