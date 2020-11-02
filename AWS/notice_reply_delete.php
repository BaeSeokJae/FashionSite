<?php
$connect = mysqli_connect("54.180.145.206:3306", "baeseokjae", "qotjrwo95!", "seokjae") or die ("connect fail");
$rno = $_POST['rno']; //댓글번호
$sql = "select * from notice_reply where number='" . $rno . "'"; //reply테이블에서 idx가 rno변수에 저장된 값을 찾음
$result = $connect->query($sql);
$reply = $result->fetch_array();

$bno = $_POST['b_no']; //게시글 번호
//$sql2 = "select * from board where number='" . $bno . "'"; //board테이블에서 idx가 bno변수에 저장된 값을 찾음
//$result1 = $connect->query($sql2);
//$board = $result1->fetch_array();

$sql3 = "update notice_reply SET status = 'N' where number='" . $rno . "'";
$result2 = $connect->query($sql3);

$query = "UPDATE notice SET notice_reply_count = notice_reply_count - 1 WHERE number = $bno";
$result3 = $connect->query($query);
?>

<script type="text/javascript">
    alert('삭제되었습니다..');
    history.back();
</script>