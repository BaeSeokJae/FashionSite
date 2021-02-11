<?php
$connect = mysqli_connect('13.209.88.207:3306', 'root', '1234', 'seokjae');
$connect->set_charset("UTF-8");
session_start();
$userid = $_SESSION['userid'];
$number = $_GET["number"];
setcookie("board" . $number . $_SESSION['userid'], TRUE, time() + (60 * 60 * 24), '/');

$query = "select * from board where number =$number";
$result = $connect->query($query);
$rows = mysqli_fetch_assoc($result);
$row = $result->fetch_array();

// 쿠키를 이용한 조회수 중복 방지
if (!isset($_COOKIE["board" . $number . $_SESSION['userid']])) {
    $sql = "update board set hit=hit+1 where number = '$number'";
    $result = $connect->query($sql);
    if (empty($result)) {
        ?>
        <script>
            alert('오류가 발생했습니다.');
            history.back();
        </script>
        <?php
    }
} else {
}
//                $hit = "update board set hit=hit+1 where number='$number'";
$like = "select * from board_like where like_id='$number'";
$result1 = $connect->query($like);
$like_status = mysqli_num_rows($result1);
$like_id = "select * from board_like where id= '$_SESSION[userid]' AND like_id='$number'";
$like_id_result = $connect->query($like_id);
$like2 = mysqli_fetch_assoc($like_id_result);

$sql3 = "select * from board_reply where con_num='" . $number . "' AND status = 'Y' ORDER BY reply_number";
$result3 = $connect->query($sql3);
$reply_delete = mysqli_num_rows($result3);

$sql4 = "select * from board_reply where con_num='" . $number . "' AND status = 'Y' AND ready_status = 'Y' AND con_num_reply != 0 ORDER BY reply_number";
$result4 = $connect->query($sql4);

$sql5 = "select * from board_reply where status = 'Y' AND ready_status = 'Y' AND con_num = '$number'";
$result5 = $connect->query($sql5);
$reply_count = mysqli_num_rows($result5);

$re_reply = array();

while ($row1 = $result4->fetch_array()) {
    $re_reply[] = $row1;
}

$sql5 = "SELECT MAX(con_num_reply) FROM board_reply where con_num='" . $number . "' AND status ='Y' AND reply_number = re_reply_number";
$result5 = $connect->query($sql5);
$re_reply_number = mysqli_fetch_assoc($result5);

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
    <meta http-equiv="content-type" content="text/html" charset=UTF-8"/>
    <title>Seokjae</title>
    <link href="https://fonts.googleapis.com/css?family=Arvo" rel="stylesheet" type="text/css"/>
    <link href="style.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript" src="/js/common.js?ver=4"></script>
</head>
<body>
<div id="bg">
    <div id="outer">
        <div id="login">
            <?php

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
            <style>
                /* 댓글 */
                .reply_view {
                    width: 900px;
                    margin-top: 50px;
                    word-break: break-all;
                }

                .dap_lo {
                    font-size: 16px;
                    padding: 10px 0 0px 0;
                    border-bottom: solid 1px gray;
                }

                .dap_lo div.dap_to_comt_edit {
                    padding: 15px 0 15px 0;
                }

                .dap_to {
                    margin-top: 5px;
                }

                .rep_me {
                    font-size: 12px;
                }

                .rep_me ul li {
                    float: left;
                    width: 30px;
                }

                .dat_delete {
                    display: none;
                }

                .dat_edit {
                    display: none;
                }

                .dat_re_edit {
                    display: none;
                }

                .dat_re_modify {
                    display: none;
                }

                .dat_re_delete {
                    display: none;
                }

                .dap_sm {
                    position: absolute;
                    top: 10px;
                }

                .dap_edit_t {
                    width: 520px;
                    height: 70px;
                    position: absolute;
                    top: 40px;
                }

                .re_mo_bt {
                    position: absolute;
                    top: 40px;
                    right: 5px;
                    width: 90px;
                    height: 72px;
                }

                #re_content {
                    width: 700px;
                    height: 56px;
                }

                .dap_ins {
                    margin-top: 50px;
                }

                .re_bt {
                    position: absolute;
                    width: 100px;
                    height: 56px;
                    font-size: 16px;
                    margin-left: 10px;
                }

                #foot_box {
                    height: 50px;
                }

                .re_reply .reply_name {
                    font-size: 16px;
                    padding-left: 20px;
                    padding-top: 10px;
                    border-top: solid 1px gray;
                }

                .re_reply .re_dap_to_comt_edit {

                    padding: 15px 0px 15px 20px;

                }

                .re_reply .re_rep_me_dap_to {
                    font-size: 13px;
                    padding: 0 0 0 20px;

                }

                .re_reply .re_rep_me_rep_menu {
                    padding: 0px 10px 10px 20px;
                }

                .rep_me_rep_menu {
                    padding: 0px 0px 10px 0px;
                }

                .rep_me_dap_to {
                    padding: 0 0 0 0;
                    font-size: 13px;
                }

                .rep_me_rep_menu button {
                    width: 70px;

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

                .re_rep_me_rep_menu {
                    padding: 0px 0px 10px 0px;
                }

                .re_rep_me_rep_menu button {
                    width: 70px;

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

                .reply_list h3 {
                    margin: 0 0 0px 0;
                    padding: 0 0 15px 0;
                    border-bottom: solid 1px gray;
                }


            </style>
            <div id="contentlist">
                <table class="view_table" align=center>
                    <style>
                        .view_table {
                            border: 1px solid #444444;
                            margin-top: 30px;
                        }

                        .view_title {
                            height: 30px;
                            text-align: center;
                            background-color: #cccccc;
                            color: black;
                            width: 1000px;
                        }

                        .view_id {
                            text-align: center;
                            background-color: #EEEEEE;
                            width: 30px;
                            color: black;
                        }

                        .view_id2 {
                            background-color: white;
                            width: 60px;
                            color: black;
                        }

                        .view_hit {
                            background-color: #EEEEEE;
                            width: 30px;
                            text-align: center;
                            color: black;
                        }

                        .view_hit2 {
                            background-color: white;
                            width: 60px;
                        }

                        .view_content {
                            padding-top: 20px;
                            padding-left: 20px;
                            border-top: 1px solid #444444;
                            height: 500px;
                        }

                        .view_btn {
                            width: 700px;
                            text-align: center;
                            margin: auto;
                            margin-top: 50px;
                        }

                        .view_btn1 {
                            height: 50px;
                            width: 100px;
                            font-size: 20px;
                            text-align: center;
                            background-color: white;
                            border: 2px solid black;
                            border-radius: 10px;
                        }

                        .view_btn2 {
                            height: 50px;
                            width: 100px;
                            font-size: 20px;
                            text-align: center;
                            background-color: #000000;
                            border: 2px solid black;
                            border-radius: 10px;
                        }
                    </style>
                    <tr>
                        <td colspan="4" class="view_title"><?php echo $rows['title'] ?></td>
                    </tr>
                    <tr>
                        <td class="view_id">작성자</td>
                        <td class="view_id2"><?php echo $rows['id'] ?></td>
                        <td class="view_hit">조회수</td>
                        <td class="view_hit2">
                            <?php echo $rows['hit'] ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" class="view_content" valign="top">
                            <?php echo $rows['content'] ?>
                        </td>
                    </tr>
                </table>

                <!-- MODIFY & DELETE -->
                <div class="view_btn">
                    <?php if ($rows['id'] == $_SESSION['userid']) { ?>
                        <button class="view_btn1" onclick="location.href='board.php'">목록으로</button>
                        <button class="view_btn1"
                                onclick="location.href='./board_modify.php?number=<?= $number ?>&id=<?= $rows['id'] ?>'">
                            수정
                        </button>
                        <button class="view_btn1"
                                onclick="location.href='./board_delete.php?number=<?= $number ?>&id=<?= $rows['id'] ?>'">
                            삭제
                        </button>
                    <?php } else { ?>
                        <button class="view_btn1" onclick="location.href='board.php'">목록으로</button>
                    <?php } ?>
                </div>
                <div class="view_btn">
                    <?php if ($_SESSION['userid'] == null) { ?>
                        추천 기능은
                        <button type="button" id="newLogin"><b class="w3-text-blue">로그인</b></button> 후 사용 가능합니다.
                        <br/>
                        <i class="fa fa-heart" style="font-size:16px;color:red"></i>
                        <span class="rec_count"></span>
                    <?php } else if ($like2['id'] == $_SESSION['userid']) { ?>
                        <img src="image/heart_black.png" width=50 height=50 border="0"
                             onclick="location.href='./board_like_action.php?number=<?= $number ?>&id=<?= $_SESSION['userid'] ?>'">
                        ( <?php echo $like_status; ?> )
                    <?php } else { ?>
                        <img src="image/heart.png" width=50 height=50 border="0"
                             onclick="location.href='./board_like_action.php?number=<?= $number ?>&id=<?= $_SESSION['userid'] ?>'">
                        ( <?php echo $like_status; ?> )
                    <?php } ?>
                </div>
                <!--- 댓글 불러오기 -->
                <div class="reply_view">
                    <div class="reply_list">
                        <h3>댓글 목록 ( <?php echo $reply_count ?> )</h3>
                    </div>
                    <?php
                    while ($reply = $result3->fetch_assoc()) {
                        if ($reply['con_num_reply'] == 0) { ?>
                            <div class="dap_lo">
                                <?php if ($reply['ready_status'] == 'N' && $reply['status'] == 'Y') { ?>
                                    <?php if ($rows['id'] == $reply['id']) { ?>
                                        <div><b><?php echo $reply['id']; ?> (작성자) </b></div>
                                    <?php } else { ?>
                                        <div><b><?php echo $reply['id']; ?></b></div>
                                    <?php } ?>
                                    <div class="dap_to_comt_edit">삭제된 댓글입니다.</div>
                                    <div class="rep_me_dap_to"><?php echo $reply['date']; ?></div>
                                <?php } else { ?>
                                    <?php if ($rows['id'] == $reply['id']) { ?>
                                        <div><b><?php echo $reply['id']; ?> (작성자) </b></div>
                                    <?php } else { ?>
                                        <div><b><?php echo $reply['id']; ?></b></div>
                                    <?php } ?>
                                    <div class="rep_me_dap_to"><?php echo $reply['date']; ?></div>
                                    <div class="dap_to_comt_edit"><?php echo $reply['content']; ?></div>
                                    <?php if ($_SESSION['userid'] == $reply['id']) { ?>
                                        <div class="rep_me_rep_menu">
                                            <button class="dat_edit_bt">수정</button>
                                            <button class="dat_delete_bt">삭제</button>
                                            <button class="dat_re_edit_bt">답글달기</button>
                                        </div>
                                    <?php } else { ?>
                                        <div class="rep_me_rep_menu">
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                                <?php foreach ($re_reply as $row1) { ?>
                                    <?php if ($reply['reply_number'] == $row1['re_reply_number']) { ?>
                                        <div class="re_reply">
                                            <?php if ($rows['id'] == $row1['id']) { ?>
                                                <div class="reply_name"><b>re: <?php echo $row1['id']; ?> (작성자) </b>
                                                </div>
                                            <?php } else { ?>
                                                <div class="reply_name">
                                                    <b> re: <?php echo $row1['id']; ?></b>
                                                </div>
                                            <?php } ?>
                                            <div class="re_rep_me_dap_to"><?php echo $row1['date']; ?></div>
                                            <div class="re_dap_to_comt_edit"><?php echo $row1['content']; ?></div>
                                            <?php if ($_SESSION['userid'] == $row1['id']) { ?>
                                                <div class="re_rep_me_rep_menu">
                                                    <button class="re_dat_edit_bt">수정</button>
                                                    <button class="re_dat_delete_bt">삭제</button>
                                                </div>
                                            <?php } else { ?>
                                                <div class="re_rep_me_rep_menu">
                                                </div>
                                            <?php } ?>
                                            <!--답글 수정 폼 dialog-->
                                            <div class="dat_re_modify">
                                                <form action="board_reply_re_modify_ok.php" method="post">
                                                    <input type="hidden" name="rno"
                                                           value="<?php echo $row1['number']; ?>"/>
                                                    <input type="hidden" name="b_no" value="<?php echo $number; ?>">
                                                    <input type="hidden" name="reply_number"
                                                           value="<?php echo $row1['con_num_reply']; ?>"/>
                                                    <textarea name="content"
                                                              class="dap_edit_t"><?php echo $row1['content']; ?></textarea>
                                                    <input type="submit" value="수정하기" class="re_mo_bt">
                                                </form>
                                            </div>
                                            <!--답글 삭제 폼 dialog-->
                                            <div class='dat_re_delete'>
                                                <form action="board_reply_re_delete.php" method="post">
                                                    <input type="hidden" name="r_no"
                                                           value="<?php echo $row1['reply_number']; ?>"/>
                                                    <input type="hidden" name="rno"
                                                           value="<?php echo $row1['number']; ?>"/>
                                                    <input type="hidden" name="b_no" value="<?php echo $number; ?>">
                                                    <input type="hidden" name="reply_number"
                                                           value="<?php echo $row1['con_num_reply']; ?>"/>
                                                    <p><input type="submit" value="확인"></p>
                                                </form>
                                            </div>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                                <!-- 댓글 수정 폼 dialog -->
                                <div class="dat_edit">
                                    <form action="board_reply_modify_ok.php" method="post">
                                        <input type="hidden" name="rno" value="<?php echo $reply['number']; ?>"/>
                                        <input type="hidden" name="b_no" value="<?php echo $number; ?>">
                                        <textarea name="content"
                                                  class="dap_edit_t"><?php echo $reply['content']; ?></textarea>
                                        <input type="submit" value="수정하기" class="re_mo_bt">
                                    </form>
                                </div>
                                <!-- 댓글 삭제 폼 dialog -->
                                <div class='dat_delete'>
                                    <form action="board_reply_delete.php" method="post">
                                        <input type="hidden" name="r_no" value="<?php echo $reply['reply_number']; ?>"/>
                                        <input type="hidden" name="rno" value="<?php echo $reply['number']; ?>"/>
                                        <input type="hidden" name="b_no" value="<?php echo $number; ?>">
                                        <input type="hidden" name="r_r_no_con"
                                               value="<?php echo $reply['con_num_reply']; ?>">
                                        <strong name="content"></strong>
                                        <p><input type="submit" value="확인"></p>
                                    </form>
                                </div>
                                <!--답글 작성 폼 dialog-->
                                <div class='dat_re_edit'>
                                    <form action="board_reply_re_ok.php" method="post">
                                        <input type="hidden" name="r_no" value="<?php echo $reply['reply_number']; ?>"/>
                                        <input type="hidden" name="b_no" value="<?php echo $number; ?>">
                                        <input type="hidden" name="r_r_no" value="<?php echo $reply['con_num']; ?>">
                                        <input type="hidden" name="r_r_no_con"
                                               value="<?php echo $reply['con_num_reply']; ?>">
                                        <textarea name="content" class="dap_edit_t"></textarea>
                                        <input type="submit" value="답글작성" class="re_mo_bt">
                                    </form>
                                </div>
                            </div>
                        <?php }
                    } ?>
                    <!--- 댓글 입력 폼 -->
                    <div class="dap_ins">
                        <form action="board_reply_ok.php?number=<?php echo $number; ?>" method="post">
                            <td>
                                <input type="hidden" name="name" width=1000
                                       value="<?= $_SESSION['userid'] ?>"><?= $_SESSION['userid'] ?>
                            </td>
                            <!--                            <input type="text" name="dat_user" id="dat_user" class="dat_user" size="15" placeholder="아이디">-->
                            <!--                            <input type="password" name="dat_pw" id="dat_pw" class="dat_pw" size="15" placeholder="비밀번호">-->
                            <div style="margin-top:10px; " class="reply_input">
                                <script>
                                    $(function () {
                                        $('.reply_content').val('');
                                    });

                                    $(function () {
                                        $('.dap_edit_t').val('');
                                    });
                                </script>
                                <textarea name="content" class="reply_content" id="re_content"></textarea>
                                <button id="rep_bt" class="re_bt">댓글</button>
                            </div>
                        </form>
                    </div>
                </div><!--- 댓글 불러오기 끝 -->
                <div id="foot_box"></div>
            </div>
        </div>

        <div id="copyright">
            &copy; Seokjae. All rights reserved. | Design by <a href="http://templated.co" rel="nofollow">TEMPLATED</a>
        </div>
    </div>
</body>
</html>
