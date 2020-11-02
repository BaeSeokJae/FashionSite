<?php
session_start();
$connect = mysqli_connect("localhost:3306", "baeseokjae", "qotjrwo95!", "seokjae") or die("connect fail");
$id = $_GET['id'];
$number = $_GET['board_num'];
$board_num = $_GET['board_num'];
//$number = $number + 1;
$title = $_GET[title];
$content = $_GET[content];
$date = date('Y-m-d');
$hit = $_GET[hit];
$status = $_GET[status];
$daily_board_reply_count = $_GET['daily_board_reply_count'];
//$query = "select * from daily_board where number=$number";
//$result = $connect->query($query);


if ($_SESSION['userid'] != $id) {
    ?>
    <script>
        alert("권한이 없습니다.");
        history.back();
        //location.replace("<?php //echo $URL?>//");
    </script>
<?php } else if ($_SESSION['userid'] == $id) {
    //삭제 할 글의 로그인된 아이디와 GET으로 넘어온 아이디값 확인
    $query = "UPDATE daily_board SET `status` = 'N' WHERE board_num='" . $board_num . "'";
    $result = $connect->query($query);

    if ($result) {
        ?>
        <script>
            alert("삭제되었습니다.");
            location.replace("./board.php");
        </script>
    <?php } else {
        echo "fail";
    }
} ?>