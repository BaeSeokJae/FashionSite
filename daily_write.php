<!DOCTYPE html>
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
    <meta name="Generator" content="EditPlus®">
    <meta name="Author" content="">
    <meta name="Keywords" content="">
    <meta name="Description" content="">
    <meta http-equiv="content-type" content="text/html; charset = UTF-8"/>
    <title>Eponymous by TEMPLATED</title>
    <link href="http://fonts.googleapis.com/css?family=Arvo" rel="stylesheet" type="text/css"/>
    <link href="style.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript">

        // 이미지 정보들을 담을 배열
        var sel_files = [];


        $(document).ready(function() {
            $("#files").on("change", handleImgFileSelect);
        });

        function fileUploadAction() {
            console.log("fileUploadAction");
            $("#files").trigger('click');
        }

        function handleImgFileSelect(e) {

            // 이미지 정보들을 초기화
            sel_files = [];
            $(".imgs_wrap").empty();

            var files = e.target.files;
            var filesArr = Array.prototype.slice.call(files);

            var index = 0;
            filesArr.forEach(function(f) {
                if(!f.type.match("image.*")) {
                    alert("확장자는 이미지 확장자만 가능합니다.");
                    return;
                }

                sel_files.push(f);

                var reader = new FileReader();
                reader.onload = function(e) {
                    var html = "<a href=\"javascript:void(0);\" onclick=\"deleteImageAction("+index+")\" id=\"img_id_"+index+"\"><img src=\"" + e.target.result + "\" data-file='"+f.name+"' class='selProductFile' title='Click to remove'></a>";
                    $(".imgs_wrap").append(html);
                    index++;
                }
                reader.readAsDataURL(f);
            });
        }

        function deleteImageAction(index) {
            console.log("index : "+index);
            console.log("sel length : "+sel_files.length);

            sel_files.splice(index, 1);

            var img_id = "#img_id_"+index;
            $(img_id).remove();
        }

        function fileUploadAction() {
            console.log("fileUploadAction");
            $("#files").trigger('click');
        }

        function submitAction() {
            console.log("업로드 파일 갯수 : "+sel_files.length);
            var data = new FormData();

            for(var i=0, len=sel_files.length; i<len; i++) {
                var name = "image_"+i;
                data.append(name, sel_files[i]);
            }
            data.append("image_count", sel_files.length);

            if(sel_files.length < 1) {
                alert("한개이상의 파일을 선택해주세요.");
                return;
            }

            var xhr = new XMLHttpRequest();
            xhr.open("POST","./study01_af.php");
            xhr.onload = function(e) {
                if(this.status == 200) {
                    console.log("Result : "+e.currentTarget.responseText);
                }
            }

            xhr.send(data);

        }

    </script>
</head>
<body>
<div id="bg">
    <div id="outer">
        <div id="login">
            <?php
            $connect = mysqli_connect('localhost:3306', 'baeseokjae', 'qotjrwo95!', 'seokjae') or die ("connect fail");
            $board_num=$_GET['number'];
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

                <a href="http://localhost/join.php">회원가입</a>

            <?php }
            ?>
<!--            <a href="#">아이디 / 비밀번호 찾기</a>-->
        </div>
        <div id="header">
            <div id="logo">
                <h1>
                    <a href="http://localhost">Seokjae</a>
                </h1>
            </div>
            <div id="nav">
                <ul>
                    <li>
                        <a href="http://localhost/notice.php">공지사항</a>
                    </li>
                    <li>
                        <a href="http://localhost/board.php">게시판</a>
                    </li>
                    <li class="active">
                        <a href="http://localhost/daily_board.php">데일리룩</a>
                    </li>
                    <li class="last">
                        <a href="http://localhost/news.php">패션소식</a>
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

                    input[type=file] {
                        display: none;
                    }

                    .my_button {
                        display: inline-block;
                        width: 100px;
                        height: 25px;
                        text-align: center;
                        font-size: 15px;
                        background-color: #3CA9CD;
                        color: #ffffff;
                        text-decoration: none;
                        border-radius: 5px;
                    }

                    .imgs_wrap {

                        width: auto;
                        border: 2px solid #A8A8A8;
                        margin-top: 10px;
                        margin-bottom: 10px;
                        padding-top: 10px;
                        padding-bottom: 10px;

                    }
                    .imgs_wrap img {
                        max-width: 150px;
                        margin-left: 10px;
                        margin-right: 10px;
                    }
                </style>
                <?php
                if (!isset($_SESSION['userid'])) {
                    ?>
                    <script>
                        alert("로그인 및 회원가입 후 이용 가능합니다.");
                        location.replace("<?php echo $URL?>");
                    </script>
                    <?php
                }
                ?>
                <form method="post" action="daily_write_action.php" enctype="multipart/form-data" >
                    <table style="padding-top:30px" align=center width=1000 border=0 cellpadding=2>
                        <tr>
                            <td height=20 align=center bgcolor=#ccc><font color=black>글쓰기</font></td>
                        </tr>
                        <tr>
                            <td bgcolor=white>
                                <table class="table2">
                                    <tr>
                                        <td>작성자</td>
                                        <td>
                                            <input type="hidden" name="number" width=1000 value="<?= $board_num ?>">
                                            <input type="hidden" name="name" width=1000 value="<?= $_SESSION['userid'] ?>">
                                            <?= $_SESSION['userid'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>제목</td>
                                        <td><input type=text name=title size=60></td>
                                    </tr>

                                    <tr>
                                        <td>내용</td>
                                        <td><textarea name=content cols=85 rows=15></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>파일 첨부</td>
                                        <td>
                                            <div class="input_wrap">
                                                <a href="javascript:" onclick="fileUploadAction();" class="my_button">파일 업로드</a>
                                                <input type="file" name="file[]" id="files" multiple/>
                                            </div>
                                            <div>
                                                <div class="imgs_wrap">
                                                    <img id="img" />
                                                </div>
                                            </div>
<!--                                            <input type="file" multiple="multiple" name="file[]" id="files"/>-->
                                        </td>
                                    </tr>
                                </table>
                                <center>
                                    <input type="submit" value="작성" name="submit" style="margin: .9em">
                                </center>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        <div id="copyright">
            &copy; Seokjae. All rights reserved. | Design by <a href="http://templated.co" rel="nofollow">TEMPLATED</a>
        </div>
    </div>
</body>
</html>