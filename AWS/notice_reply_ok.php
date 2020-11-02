<?php
$connect = mysqli_connect('54.180.145.206:3306', 'baeseokjae', 'qotjrwo95!', 'seokjae') or die ("connect fail");

session_start();

$bno = $_GET['number'];
$id = $_SESSION['userid'];
$content = $_POST['content'];
$date = date('Y-m-d H:i:s');
//$userpw = password_hash($_POST['dat_pw'], PASSWORD_DEFAULT);

$sql = "insert into notice_reply (number, con_num, re_reply_number, id, content, date) values(null,'$bno', 0 ,'$id','$content','$date')";
$result = $connect->query($sql);

$sql1 = "update notice_reply SET reply_number = number";
$result1 = $connect->query($sql1);

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