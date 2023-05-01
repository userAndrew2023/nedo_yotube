<?php
    $video_url = $_GET["video_id"];
    if ($video_url == null) {

        die();
    }
    $title = $video_url;
    require_once "../blocks/header.php";
    $query = "SELECT * FROM `videos` WHERE name = '$video_url'";
    $host = "localhost:3306";
    $user = "andrew";
    $password = "password!";
    $db_name = "ruvie";
    $mysqli = mysqli_connect($host, $user, $password, $db_name);
    if ($result = $mysqli -> query($query)){
        while($q_row = $result -> fetch_array()){
            $row = $q_row;
        }
    }
    $video = $row['id'];
    $author = $row['user_id'];
    $views = $row['views'] + 1;
    $sql = "SELECT * FROM `comments` where video_id = '$video'";
    $sql2 = "SELECT * FROM `users` where id = $author";
    $list = [];
    if($result = $mysqli -> query($sql)){
        while($row7 = $result -> fetch_array()){
            $list[] = $row7;
        }
    }
    $list2 = [];
    $row2 = null;
    if($result = $mysqli -> query($sql2)){
        while($q_row_2 = $result -> fetch_array()){
            $row2 = $q_row_2;
        }
    }

    $view_sql_query = "UPDATE `videos` SET `views` = '$views' WHERE (`id` = '$video')";

    $mysqli -> query($view_sql_query);

    $mysqli -> close();
?>
<body>
    <style>
        <?php include '../styles/styles.css'; ?>
    </style>
    <video autoplay="autoplay" controls width='1000' height='562'><source src='../videos/<?=$video_url?>.mp4' type='video/mp4'></video>
    <p class='title_video'><?=$video_url?></p>
    <div>
        <img class="img-icon" width="48" height="48" src="../avatars/<?=$row2['icon']?>" alt="logo">
        <span style="vertical-align: middle;">
            <a class="author_title_video" href="../user/user_videos.php?user_id=<?=$row2['id']?>"><?=$row2['name']?></a>
        </span>
        <button class="sub" style="display: inline-block; vertical-align: middle;">Подписаться</button>
    </div>
    <p class="desc"><?=$row['desc']?></p>

    <form action="comment.php?video_id=<?=$row['id']?>&video_name=<?=$row['name']?>" method="post">
        <label>
            <input class="comment_edit" placeholder="Введите комментарий" name="text" autocomplete="off">
        </label><br>
        <button type="submit" class="send">Отправить</button>
    </form>

    <?php
        $cookie_user = json_decode($_COOKIE['user']);
        foreach ($list as $item) {
            if ($item['user_id'] == $cookie_user -> id) {
                $id = $item['id'];
                echo "<p class='comment'>" . $item['text'] . "<a href='delete_comment.php?id=$id&video_id=$video_url' style='float: right; font-weight: 600; cursor: pointer'>Удалить</a></p>";
            } else {
                echo "<p class='comment'>" . $item['text'] . "</p>";
            }
        }
    ?>

</body>

