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
    $author = $row['user_id'];
    $sql = "SELECT * FROM `comments`";
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
    $mysqli -> close();
?>
<body>
    <style>
        <?php include '../styles/styles.css'; ?>
    </style>
    <video controls width='1000' height='562'><source src='../videos/<?=$video_url?>.mp4' type='video/mp4'></video>
    <p class='title_video'><?=$video_url?></p>
    <div>
        <p>Автор: <a href="../user/user_videos.php?user_id=<?=$row2['id']?>"><?=$row2['name']?></a></p>
    </div>
    <p class="desc"><?=$row['desc']?></p>

    <form action="comment.php?video_id=<?=$row['id']?>&video_name=<?=$row['name']?>" method="post">
        <label>
            <input name="text">
        </label>
        <button type="submit">Отправить</button>
    </form>

    <?php
        foreach ($list as $item) {
            echo "<p class='comment'>" . $item['text'] . "</p>";
        }
    ?>

</body>

