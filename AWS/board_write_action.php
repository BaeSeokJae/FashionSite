<?php
$connect = mysqli_connect("54.180.145.206:3306", "baeseokjae", "qotjrwo95!", "seokjae") or die("fail");

session_start();

$id = $_SESSION['userid'];                      //Writer
$pw = $_POST['userpw'];                        //Password
$title = $_POST[title];                  //Title
$content = $_POST[content];              //Content
$date = date('Y-m-d H:i:s');            //Date
$URL = './board.php';                   //return URL
$nickname = $_POST['nickname'];

$query = "insert into board (number, title, content, date, hit, id, password, board_reply_count, status, nickname, content_like) 
                        values(null,'$title', '$content', '$date',0, '$id', '$pw', 0, default, 0,0)";

$result = $connect->query($query);
if($result){
    ?>                  <script>
        alert("<?php echo "글이 등록되었습니다."?>");
        location.replace("<?php echo $URL?>");
    </script>
    <?php
}
else{
    echo "FAIL";
}
mysqli_close($connect);
?>