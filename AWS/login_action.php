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
            <a href="#">아이디 / 비밀번호 찾기</a>
        </div>
        <div id="header">
            <div id="logo">
                <h1>
                    <a href="#">Seokjae</a>
                </h1>
            </div>
            <div id="nav">
                <ul>
                    <li>
                        <a href="http://seokjae.cf/notice.php">공지사항</a>
                    </li>
                    <li>
                        <a href="http://seokjae.cf/test1.php">게시판</a>
                    </li>
                    <li>
                        <a href="#">데일리룩</a>
                    </li>
                    <li class="last">
                        <a href="#">패션소식</a>
                    </li>
                </ul>
                <br class="clear"/>
            </div>
        </div>
        <div id="main">
            <div id="content">
                <?php
                $connect = mysqli_connect("54.180.145.206:3306", "baeseokjae", "qotjrwo95!", "seokjae") or die("fail");

                //입력 받은 id와 password
                $id = $_POST['id'];
                $pw = $_POST['pw'];

                //아이디가 있는지 검사
                $query = "select * from member where id='$id'";
                $result = $connect->query($query);

                //아이디가 있다면 비밀번호 검사
                if (mysqli_num_rows($result) == 1) {

                    $row = mysqli_fetch_assoc($result);

                    //비밀번호가 맞다면 세션 생성
                if ($row['pw'] == $pw) {
                    $_SESSION['userid'] = $id;
                    if (isset($_SESSION['userid'])) {
                    session_start();
                        ?>
                        <script>
                        // alert('로그인 되었습니다.');
                        location.replace("./index.php");
                        </script>
                        <?php
                    } else {
                        echo "session fail";
                    }
                } else {
                    ?>
                    <script>
                        alert("아이디 혹은 비밀번호가 잘못되었습니다.");
                        history.back();
                    </script>
                <?php
                }
                } else {
                ?>
                    <script>
                        alert("아이디 혹은 비밀번호가 잘못되었습니다.");
                        history.back();
                    </script>
                    <?php
                }
                ?>
            </div>
            <br class="clear"/>
        </div>
        <br class="clear"/>
    </div>
</div>
<div id="copyright">
    &copy; Seokjae. All rights reserved. | Design by <a href="http://templated.co" rel="nofollow">TEMPLATED</a>
</div>
</div>
</body>
</html>

