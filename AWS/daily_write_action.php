<?php
header("Content-Type: text/html; charset=UTF-8");
session_start();
$connect = mysqli_connect('13.209.88.207:3306', 'root', '1234', 'seokjae') or die ("connect fail");
mysqli_query($connect, 'SET NAMES utf8');
$board_num = $_POST['number'];
$board_number = $board_num + 1;
$id = $_SESSION['userid'];                      //Writer
$pw = $_POST['userpw'];                        //Password
$title = $_POST['title'];                  //Title
$content = $_POST['content'];              //Content
$date = date('Y-m-d H:i:s');            //Date
$URL = './daily_board.php';//return URL
$target_dir = "./uploads/";
$total = count($_FILES["file"]["name"]);

// Check file size

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
//    if ($size = $_FILES["file"]["size"] < 200000) { ?>
    <!--        <script>alert('업로드를 성공하지 못했습니다.');</script>-->
    <!--        --><?php //exit();
//    }
    if (move_uploaded_file($_FILES["file"]["tmp_name"][$i], $target_file)) {
        $sql = "insert into daily_board(number, board_num, title, content, filename, imgurl, size, date, hit, id, password, status, daily_board_reply_count, content_like) 
                        values(null,'$board_number', '$title' ,'$content', '" . $filename . ".$ext" . "', '$target_file', 0, '$date',0, '$id', '$pw',default,0,0)";
        $result = $connect->query($sql);
        ?>
        <?php
    } else {
        echo "<script>parent.alert('업로드를 성공하지 못했습니다.');</script>";
        exit();
    }
}
?>
<script>
    alert("<?php echo "글이 등록되었습니다."?>");
    location.replace("daily_board.php");
</script>
