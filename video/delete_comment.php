<?php
    $id = $_GET['id'];
    $id = intval($id);
    $video_id = $_GET['video_id'];
    $sql = "DELETE FROM `comments` WHERE (`id` = $id);";

    echo $id;
    $host = "localhost:3306";
    $user = "andrew";
    $password = "password!";
    $db_name = "ruvie";
    $mysqli = mysqli_connect($host, $user, $password, $db_name);

    $mysqli -> query($sql);
    $mysqli -> close();

    header("Location: video.php?video_id=$video_id");

