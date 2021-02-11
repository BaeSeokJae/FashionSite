<?php
$connect = mysqli_connect("13.209.88.207:3306", "root", "1234", "seokjae") or die("connect fail");
$id = $_GET[id];
$number = $_GET[number];
$board_like = "select * from daily_board_like WHERE id = '$id' AND like_id = '$number'";
$result = $connect->query($board_like);
$like = mysqli_fetch_assoc($result);
$board = "select * from daily_board where number ='$number'";
$result1 = $connect->query($board);
$like1 = mysqli_fetch_assoc($result1);

session_start();

if ($_SESSION['userid'] == null) {
    ?>
    <script>
        alert("로그인 후 이용 가능합니다..");
        history.back();
        //location.replace("<?php //echoURL?>//");
    </script>
<?php } else if ($like['id'] == $id && $like['like_id'] == $number) {
    $delete = "DELETE FROM daily_board_like WHERE id = " . "'$id' AND like_id = '$number'";
    $result1 = $connect->query($delete);
    $hit = "update daily_board_like set like_num = like_num -1";
    $result = $connect->query($hit);
    $hit1 = "update daily_board set content_like = content_like -1 where number = '$number'";
    $result = $connect->query($hit1);
    $reset = "ALTER TABLE daily_board_like AUTO_INCREMENT = 1";
    $result = $connect->query($reset);
    ?>
    <script>
        history.back();
    </script>
<?php } else if ($_SESSION['userid'] != null) {
    //삭제 할 글의 로그인된 아이디와 get으로 넘어온 아이디값 확인
    $query = "insert into daily_board_like (number, like_id, like_num, status, id)
                        values(null, '$number', 0, default, '$id')";
    $result = $connect->query($query);
    $hit = "update daily_board_like set like_num = like_num+1 ";
    $result = $connect->query($hit);
    $reset = "ALTER TABLE daily_board_like AUTO_INCREMENT = 1";
    $result = $connect->query($reset);
    $hit1 = "update daily_board set content_like = content_like +1 where number = '$number'";
    $result = $connect->query($hit1);

    if ($result) {
        ?>
        <script>
            history.back();
        </script>
    <?php } else {
        echo "fail";
    }
} ?>