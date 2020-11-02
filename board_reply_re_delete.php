<?php
$connect = mysqli_connect("localhost:3306", "baeseokjae", "qotjrwo95!", "seokjae") or die ("connect fail");
$rno = $_POST['rno']; //댓글번호
$r_no = $_POST['r_no'];
$bno = $_POST['b_no']; //게시글 번호
$reply_number = $_POST['reply_number'];

//$sql = "select * from board_reply where con_num='" . $rno . "' AND con_num_reply ='$reply_number'"; //reply테이블에서 idx가 rno변수에 저장된 값을 찾음
//$result = $connect->query($sql);
//$reply = $result->fetch_array();

//$sql2 = "select * from board where number='" . $bno . "'"; //board테이블에서 idx가 bno변수에 저장된 값을 찾음
//$result1 = $connect->query($sql2);
//$board = $result1->fetch_array();

$sql3 = "update board_reply SET status = 'Y', ready_status = 'N' where number='" . $rno . "'AND con_num_reply ='$reply_number'";
$result2 = $connect->query($sql3);

$sql = "select * from board_reply where status = 'Y' AND ready_status = 'Y' AND con_num='" . $bno . "' AND reply_number ='$r_no'"; //reply테이블에서 idx가 rno변수에 저장된 값을 찾음
$result = $connect->query($sql);

if ($result->num_rows == 0) {
    $sql2 = "update board_reply SET status = 'N', ready_status = 'N' where con_num='" . $bno . "' AND number ='$r_no'";
    $result1 = $connect->query($sql2);
}

$query = "UPDATE board SET board_reply_count = board_reply_count - 1 WHERE number = $bno";
$result3 = $connect->query($query);
?>

<script type="text/javascript">
    // alert('삭제되었습니다..');
    history.back();
</script>