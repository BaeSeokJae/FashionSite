<?php
$connect = mysqli_connect("localhost:3306", "baeseokjae", "qotjrwo95!", "seokjae") or die ("connect fail");
$rno = $_POST['rno']; //댓글번호
$bno = $_POST['b_no']; //게시글 번호
$sql = "select * from board_reply where number='" . $rno . "'"; //reply테이블에서 idx가 rno변수에 저장된 값을 찾음
$result = $connect->query($sql);
$reply = $result->fetch_array();

$sql1 = "select * from board_reply where reply_number = '$rno' AND re_reply_number = '$rno' AND status = 'Y' AND ready_status = 'Y'";
$result1 = $connect->query($sql1);
$re_reply = mysqli_num_rows($result1);

if ($re_reply == 0) {
    $sql3 = "update board_reply SET status = 'N', ready_status = 'N' where number='" . $rno . "' AND con_num='".$bno."' AND con_num_reply = '0'";
    $result2 = $connect->query($sql3);
} else {
    $sql3 = "update board_reply SET status = 'Y', ready_status = 'N' where number='" . $rno . "' AND con_num='".$bno."' AND con_num_reply = '0'";
    $result2 = $connect->query($sql3);
}

//$sql2 = "select * from board where number='" . $bno . "'"; //board테이블에서 idx가 bno변수에 저장된 값을 찾음
//$result1 = $connect->query($sql2);
//$board = $result1->fetch_array();

$query = "UPDATE board SET board_reply_count = board_reply_count - 1 WHERE number = $bno";
$result3 = $connect->query($query);
?>

<script type="text/javascript">
    history.back();
</script>