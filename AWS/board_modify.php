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
            $connect = mysqli_connect('54.180.145.206:3306', 'baeseokjae', 'qotjrwo95!', 'seokjae') or die ("connect fail");
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
<!--                    <li class="first">-->
<!--                        <a href="http://seokjae.cf/info.html">Info</a>-->
<!--                    </li>-->
                    <li>
                        <a href="http://seokjae.cf/notice.php">공지사항</a>
                    </li>
                    <li class="active">
                        <a href="http://seokjae.cf/board.php">게시판</a>
                    </li>
                    <li>
                        <a href="http://seokjae.cf/daily_board.php">데일리룩</a>
                    </li>
                    <li>
                        <a href="#">패션소식</a>
                    </li>
                    <li class="last">
                        <a href="#">Contact</a>
                    </li>
                </ul>
                <br class="clear"/>
            </div>
        </div>
        <div id="main">
            <div id="contentlist">
                <style>
                    table.table2 {
                        color: #000000;
                        border-collapse: separate;
                        border-spacing: 1px;
                        text-align: left;
                        line-height: 1.5;
                        border-top: 1px solid #ccc;
                        margin: 20px 10px;
                    }

                    table.table2 tr {
                        color: #000000;
                        width: 50px;
                        padding: 10px;
                        font-weight: bold;
                        vertical-align: top;
                        border-bottom: 1px solid #ccc;
                    }

                    table.table2 td {
                        color: #000000;
                        width: 100px;
                        padding: 10px;
                        vertical-align: top;
                        border-bottom: 1px solid #ccc;
                    }

                </style>
                <?php $connect = mysqli_connect("54.180.145.206:3306", "baeseokjae", "qotjrwo95!", "seokjae") or die("connect fail");
                $id = $_GET[id];
                $number = $_GET[number];
                $query = "select title, content, date, id from board where number=$number";
                $result = $connect->query($query);
                $rows = mysqli_fetch_assoc($result);

                $title = $rows['title'];
                $content = $rows['content'];
                $usrid = $rows['id'];

                if (!isset($_SESSION['userid'])) {
                    ?>
                    <script>
                        alert("권한이 없습니다.");
                        history.back();
                        //location.replace("<?php //echo $URL?>//");
                    </script>
                <?php } else if ($_SESSION['userid'] == $usrid) {
                ?>
                <form method="get" action="board_modify_action.php">
                    <table style="padding-top:50px" align=center width=1000 border=0 cellpadding=2>
                        <tr>
                            <td height=20 align=center bgcolor=#ccc><font color=white> 글수정</font></td>
                        </tr>
                        <tr>
                            <td bgcolor=white>
                                <table class="table2">
                                    <tr>
                                        <td>작성자</td>
                                        <td><input type="hidden" name="id"
                                                   value="<?= $_SESSION['userid'] ?>"><?= $_SESSION['userid'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>제목</td>
                                        <td><input type=text name=title size=60 value="<?= $title ?>"></td>
                                    </tr>

                                    <tr>
                                        <td>내용</td>
                                        <td><textarea name=content cols=85 rows=15><?= $content ?></textarea></td>
                                    </tr>

                                </table>

                                <center>
                                    <input type="hidden" name="number" value="<?= $number ?>">
                                    <input type="submit" value="작성">
                                </center>
                            </td>
                        </tr>
                    </table>
                    <?php }
                    else {
                        ?>
                        <script>
                            alert("권한이 없습니다.");
                            history.back();
                            //location.replace("<?php //echo $URL?>//");
                        </script>
                    <?php }
                    ?>
            </div>
            <div id="copyright">
                &copy; Seokjae. All rights reserved. | Design by <a href="http://templated.co"
                                                                    rel="nofollow">TEMPLATED</a>
            </div>
        </div>
</body>
</html>


