<?php
$connect = mysqli_connect('13.209.88.207:3306', 'root', '1234', 'seokjae') or die ("connect fail");
$youtube_api_key = "AIzaSyDU2CDhOZZcdgO1bj6BVIlrZavN_8AZuso";
$url = "https://www.youtube.com/watch?v=ieo68NzgXkk"; //https://www.youtube.com/watch?v=IPXIgEAGe4U

parse_str(parse_url($url, PHP_URL_QUERY), $u_id); // v= 이후로 영상ID 짤라오기
$snippet_url = "https://www.googleapis.com/youtube/v3/videos?id=" . $u_id['v'] . "&fields=items&key=" . $youtube_api_key . "&part=snippet"; //채널 ID 알아낼수있음 -> 구독자수
$snippet_json = file_get_contents($snippet_url); //file_get_contents 웹 JSON 읽어오기

$data = json_decode($snippet_json);
$channelId = $data->items[0]->snippet->channelId;       // 채널 ID

?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <meta http-equiv="content-type" content="text/html" charset=UTF-8"/>
    <title>Seokjae</title>
    <link href="https://fonts.googleapis.com/css?family=Arvo" rel="stylesheet" type="text/css"/>
</head>
<body>
<div id="bg">
    <?php echo $channelId ?>
</div>
</body>
</html>