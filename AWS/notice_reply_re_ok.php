<?php
$connect = mysqli_connect('54.180.145.206:3306', 'baeseokjae', 'qotjrwo95!', 'seokjae') or die ("connect fail");

session_start();

$r_no = $_POST['r_no'];
$r_r_no = $_POST['r_r_no'];
$r_r_no_con = $_POST['r_r_no_con'];
$id = $_SESSION['userid'];
$content = $_POST['content'];
$date = date('Y-m-d H:i:s');

//$userpw = password_hash($_POST['dat_pw'], PASSWORD_DEFAULT);
if ($r_r_no_con == 0) {
    $r_r_no_con = $r_r_no_con + 1;
    $sql = "insert into notice_reply (number, reply_number, con_num, re_reply_number, con_num_reply, id, content, date, status) 
                            values(null,'$r_no','$r_r_no','$r_no','$r_r_no_con','$id','$content','$date', default)";
    $result = $connect->query($sql);
}
else if($r_r_no_con > 0) {
    $r_r_no_con = $r_r_no_con + 1;
    $sql = "insert into notice_reply (number, reply_number, con_num, re_reply_number, con_num_reply, id, content, date, status) 
                            values(null,'$r_no','$r_r_no','$r_no','$r_r_no_con','$id','$content','$date', default)";
    $result = $connect->query($sql);
}

if ($result) {
    $query = "UPDATE notice SET notice_reply_count = notice_reply_count + 1 WHERE number = $bno";
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