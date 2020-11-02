<?php
$connect = mysqli_connect('54.180.145.206:3306', 'baeseokjae', 'qotjrwo95!', 'seokjae') or die ("connect fail");

session_start();

$bno = $_POST['b_no'];
$r_no = $_POST['r_no'];
$r_r_no = $_POST['r_r_no'];
$id = $_SESSION['userid'];
$content = $_POST['content'];
$date = date('Y-m-d H:i:s');

$query = "select MAX(con_num_reply) from board_reply where reply_number = '$r_no' AND re_reply_number = '$r_no'";
$result1 = $connect->query($query);
$row = mysqli_fetch_assoc($result1);
$reply = $row['MAX(con_num_reply)'];

//$userpw = password_hash($_POST['dat_pw'], PASSWORD_DEFAULT);
if ($reply == null) {
    $r_r_no_con = $r_r_no_con + 1;
    $sql = "insert into board_reply (number, reply_number, con_num, re_reply_number, con_num_reply, id, content, date, status) 
                            values(null,'$r_no','$r_r_no','$r_no','$r_r_no_con','$id','$content','$date', default)";
    $result = $connect->query($sql);
}
else if($reply > 0) {
    $reply = $reply + 1;
    $sql = "insert into board_reply (number, reply_number, con_num, re_reply_number, con_num_reply, id, content, date, status) 
                            values(null,'$r_no','$r_r_no','$r_no','$reply','$id','$content','$date', default)";
    $result = $connect->query($sql);
}

if ($result) {
    $query = "UPDATE board SET board_reply_count = board_reply_count + 1 WHERE number = $bno";
    $result = $connect->query($query);
    ?>
    <script type="text/javascript">
        history.back();
    </script>
    <?php
} else {
    echo "FAIL";
}
?>