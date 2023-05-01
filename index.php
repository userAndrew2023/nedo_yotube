<?php
    $host = "localhost:3306";
    $user = "andrew";
    $password = "password!";
    $db_name = "ruvie";

    $mysqli = mysqli_connect($host, $user, $password, $db_name);

    $users = "CREATE TABLE IF NOT EXISTS `users` (
                  `id` int NOT NULL AUTO_INCREMENT,
                  `email` text NOT NULL,
                  `password` text NOT NULL,
                  `name` varchar(45) NOT NULL,
                  `icon` text NOT NULL,
                  PRIMARY KEY (`id`))";

    $videos = "CREATE TABLE IF NOT EXISTS `videos` (
                  `id` int NOT NULL AUTO_INCREMENT,
                  `name` text NOT NULL,
                  `desc` text NOT NULL,
                  `preview` text NOT NULL,
                  `link` text NOT NULL,
                  `likes` int NOT NULL,
                  `dislikes` int NOT NULL,
                  `user_id` int NOT NULL,
                  `views` int NOT NULL,
                  PRIMARY KEY (`id`))";

    $comments = "CREATE TABLE `comments` (
                  `id` int NOT NULL AUTO_INCREMENT,
                  `user_id` int NOT NULL,
                  `video_id` int NOT NULL,
                  `text` text NOT NULL,
                  `likes` int NOT NULL,
                  `dislikes` int NOT NULL,
                  PRIMARY KEY (`id`))";

    $mysqli -> query($users);
    $mysqli -> query($videos);
    $mysqli -> query($comments);

    require_once "blocks/header.php";
?>

<style>
    <?php include './styles/styles.css'; ?>
</style>

<h1>Переключиться на пользователя</h1>
<?php

    $sql = "SELECT * FROM `users`";
    $list = [];
    if($result = $mysqli -> query($sql)){
        while($row = $result -> fetch_array()){
            $list[] = $row;
        }
    }
    foreach ($list as $item) {
        echo "<ul>";
        $id = "";
        foreach ($item as $key => $value) {
            if (!is_numeric($key)) {
                if ($key == "id") {
                    $id = $value;
                }
                echo "<li>$key -> $value</li>";
            }
        }
        $email = $item['email'];
        $encode = urlencode(serialize($item));
        echo "<li>channel -> Войти как <a href='/user/user_videos.php?user=$encode'>$email</a></li>";
        echo "</ul>";
        echo "<hr>";
    }
    $mysqli -> close();
