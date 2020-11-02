<?php
$connect = mysqli_connect('localhost:3306', 'baeseokjae', 'qotjrwo95!', 'seokjae') or die ("connect fail");
$rno = $_POST['rno']; //댓글번호
$reply_number = $_POST['reply_number'];
//$content = $_POST['content'];
//$sql = "select * from board_reply where number='" . $rno . "' AND con_num_reply ='$reply_number'"; //reply테이블에서 idx가 rno변수에 저장된 값을 찾음
//$result = $connect->query($sql);
////$reply = $sql->fetch_array();
//
//$bno = $_POST['b_no']; //게시글 번호
//$sql2 = "select * from board where number='" . $bno . "'"; //board테이블에서 idx가 bno변수에 저장된 값을 찾음
//$result = $connect->query($sql2);
////$board = $sql2->fetch_array();

$sql3 = "update board_reply set content='" . $_POST['content'] . "' where number = '" . $rno . "'AND con_num_reply ='$reply_number'"; //reply테이블의 idx가 rno변수에 저장된 값의 content를 선택해서 값 저장
$result = $connect->query($sql3);

?>
<script type="text/javascript">
    history.back();
</script>