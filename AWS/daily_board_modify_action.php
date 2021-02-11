<?php
$connect = mysqli_connect("13.209.88.207:3306", "root", "qotjrwo95!", "seokjae") or die ("connect fail");
session_start();
$id = $_SESSION['userid'];
$number = $_POST[board_num];
$board_num = $_POST[board_num];
//$number = $number + 1;
$title = $_POST[title];
$content = $_POST[content];
$date = date('Y-m-d');
$hit = $_POST[hit];
$status = $_POST[status];
$daily_board_reply_count = $_POST['daily_board_reply_count'];
$sql = "delete from daily_board where board_num='" . $board_num . "'";
$result = $connect->query($sql);
$reset = "ALTER TABLE daily_board AUTO_INCREMENT = 1";
$result1 = $connect->query($reset);

$target_dir = "./uploads/";
$total = count($_FILES["file"]["name"]);

for ($i = 0; $i < $total; $i++) {

    $target_file = $target_dir . basename($_FILES["file"]["name"][$i]);
    $ext = pathinfo($target_file, PATHINFO_EXTENSION);
    $filename = basename($target_file, ".$ext");
    $num = 1;

    if (file_exists($target_file)) {
        while (file_exists($target_file)) {
            $filename2 = $filename . "($num)";
            $target_file = $target_dir . $filename2 . ".$ext";
            $num++;
        }
    }
    if ($size = $_FILES["file"]["size"] < 200000) { ?>
        <script>alert('업로드를 성공하지 못했습니다.');</script>
        <?php exit();
    }
    if (move_uploaded_file($_FILES["file"]["tmp_name"][$i], $target_file)) {
        $sql = "insert into daily_board(number, board_num, title, content, filename, imgurl, size, date, hit, id, password, status, daily_board_reply_count, content_like) 
                        values($number,'$board_num', '$title' ,'$content', '" . $filename . ".$ext" . "', '$target_file', 0, '$date',$hit, '$id', '$pw', '$status','$daily_board_reply_count', 0)";
        $result = $connect->query($sql);
        $number++;
        ?>
        <?php
    } else {
        echo "<script>parent.alert('업로드를 성공하지 못했습니다.');</script>";
        exit();
    }
}
?>
<script>
    alert("<?php echo "수정완료."?>");
    location.replace("daily_board.php");
</script>
