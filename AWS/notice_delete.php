<?php
$connect = mysqli_connect("13.209.88.207:3306", "root", "1234", "seokjae") or die("connect fail");
$id = $_GET['id'];
$number = $_GET[number];
$query = "select * from notice where number=$number";
$result = $connect->query($query);
session_start();

if ($_SESSION['userid'] != $id) {
    ?>
    <script>
        alert("권한이 없습니다.");
        history.back();
        //location.replace("<?php //echo $URL?>//");
    </script>
<?php } else if ($_SESSION['userid'] == $id) {
    //삭제 할 글의 로그인된 아이디와 get으로 넘어온 아이디값 확인
    $query = "UPDATE notice SET `status` = 'N' WHERE number ='{$number}'";
    $result = $connect->query($query);

    if ($result) {
        ?>
        <script>
            alert("삭제되었습니다.");
            location.replace("./board.php");
        </script>
    <?php } else {
        echo "fail";
    }
} ?>