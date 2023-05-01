<?php
    $host = "localhost:3306";
    $user = "andrew";
    $password = "password!";
    $db_name = "ruvie";
    $mysqli = mysqli_connect($host, $user, $password, $db_name);

    $video_id = $_GET['video_id'];
    $video_name = $_GET['video_name'];
    $text = $_POST['text'];
    if ($text == "") {
        header("Location: video.php?video_id=$video_name");
        die();
    }
    $cookie_id = json_decode($_COOKIE['user']) -> id;
    $sql = "INSERT INTO comments (`user_id`, `video_id`, `text`, `likes`, `dislikes`) 
                            VALUES ($cookie_id, $video_id, '$text', 0, 0)";

    if($mysqli->query($sql)){
        echo "Данные успешно добавлены";
    } else{
        echo "Ошибка: " . $mysqli->error;
    }
    $mysqli -> close();
    header("Location: video.php?video_id=$video_name");
    die();
