<?php
include 'login_check.php';
$connect = mysqli_connect('localhost:3306', 'baeseokjae', 'qotjrwo95!', 'seokjae') or die("fail");

$id=$_POST[id];
$pw=$_POST[pw];
$nickname=$_POST[nickname];
$email=$_POST[email];

$date = date('Y-m-d H:i:s');

//입력받은 데이터를 DB에 저장
$query = "insert into member (number, id, pw, nickname, email, date, permit) values (null,'$id', '$pw', '$nickname', '$email', '$date', 0)";

$result = $connect->query($query);

if ($id == null) {
    ?>
    <script>
        alert('아이디를 입력해주세요')
        history.back();
    </script>
        <?php
}

//저장이 됬다면 (result = true) 가입 완료
else if($result) {
    ?>      <script>
        alert('가입 되었습니다.');
        location.replace("./login.php");
    </script>

<?php   }
else{
    ?>              <script>

        alert("fail");
    </script>
<?php   }

mysqli_close($connect);
?>
