<?php
$connect = mysqli_connect("localhost:3306", "baeseokjae", "qotjrwo95!", "seokjae") or die ("connect fail");
$number = $_GET[number];
$title = $_GET[title];
$content = $_GET[content];
$date = date('Y-m-d H:i:s');
$query = "update notice set title='$title', content='$content', date='$date' where number=$number";
$result = $connect->query($query);
if($result) {
    ?>
    <script>
        alert("수정되었습니다.");
        history.go(-2);
        //location.replace("./board_view.php?number=<?//=$number?>//");
    </script>
<?php    }
else {
    echo "fail";
}
?>