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
        <div id="join_box">
            <div align='center'>
            <p>회원가입</p>
            </div>
            <form method='post' action='join_action.php'>
                <div id="content_title">아이디</div>
                <div class="content_content">
                <input type="text" name="id" >
                </div>
                <script src="http://code.jquery.com/jquery-latest.min.js"></script>

                <div id="content_title">비밀번호</div>
                <div class="content_content">
                    <input type="password" id="password_1" name="pw" >
<!--                    <input type="password" id="password_1" class="pw" placeholder="비밀번호">-->
                    <span>8~15자리의 영문, 숫자, 특수문자의 입력이 가능합니다.</span>
                </div>

                <div id="content_title">비밀번호 확인</div>
                <div class="content_content">
                    <input type="password" id="password_2" name="pw_check" >
                    <span id="alert-success" style="display: none;">비밀번호가 일치합니다.</span>
                    <span id="alert-danger"
                          style="display: none; color: #d92742; font-weight: bold; ">비밀번호가 일치하지 않습니다.</span>
                </div>
                <script>
                    $('.pw').focusout(function () {
                        var pwd1 = $("#password_1").val();
                        var pwd2 = $("#password_2").val();

                        if (!(pwd1 == '' || pwd2 != '')) {
                            null;
                        } else if (pwd1 != "" || pwd2 != "") {
                            if (pwd1 == pwd2) {
                                $("#alert-success").css('display', 'inline-block');
                                $("#alert-danger").css('display', 'none');
                            } else {
                                // alert("비밀번호가 일치하지 않습니다. 비밀번호를 재확인해주세요.");
                                $("#alert-success").css('display', 'none');
                                $("#alert-danger").css('display', 'inline-block');
                            }
                        }
                    });
                </script>
                <div id="content_title">닉네임</div>
                <div class="content_content">
                    <input type="text" name="nickname" >
                </div>
                <div id="content_title">Email</div>
                <div class="content_content">
                    <input type="email" name="email">
                </div>
                <div align='center'>
                <input type="submit" value="회원가입">
                </div>
            </form>
        </div>
    </div>
    <div id="copyright">
        &copy; Seokjae. All rights reserved. | Design by <a href="http://templated.co" rel="nofollow">TEMPLATED</a>
    </div>
</div>
</body>
</html>
