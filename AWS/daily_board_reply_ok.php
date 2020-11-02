<?php
$connect = mysqli_connect('54.180.145.206:3306', 'baeseokjae', 'qotjrwo95!', 'seokjae') or die ("connect fail");

session_start();

$bno = $_GET['number'];
$id = $_SESSION['userid'];
$content = $_POST['content'];
$date = date('Y-m-d H:i:s');
$URL = './board_view.php';
//$userpw = password_hash($_POST['dat_pw'], PASSWORD_DEFAULT);

$sql = "insert into daily_board_reply (number, con_num, id, content, date) values(null,'$bno','$id','$content','$date')";
$result = $connect->query($sql);

if ($result) {
    $query = "UPDATE daily_board SET daily_board_reply_count = daily_board_reply_count + 1 WHERE number = $bno";
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