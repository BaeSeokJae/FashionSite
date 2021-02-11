<?php
$connect = mysqli_connect('13.209.88.207:3306', 'root', '1234', 'seokjae') or die ("connect fail");
$rno = $_POST['rno']; //댓글번호
//$sql = "select * from board_reply where number='" . $rno . "'"; //reply테이블에서 idx가 rno변수에 저장된 값을 찾음
//$result = $connect->query($sql);
////$reply = $sql->fetch_array();
//
//$bno = $_POST['b_no']; //게시글 번호
//$sql2 = "select * from board where number='" . $bno . "'"; //board테이블에서 idx가 bno변수에 저장된 값을 찾음
//$result = $connect->query($sql2);
////$board = $sql2->fetch_array();

$sql3 = "update board_reply set content='" . $_POST['content'] . "' where number = '" . $rno . "'"; //reply테이블의 idx가 rno변수에 저장된 값의 content를 선택해서 값 저장
$result = $connect->query($sql3);

?>
<script type="text/javascript">
    history.back();
</script>