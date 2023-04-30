<?php
    $title = "Мои видео";
    require_once "../blocks/header.php";

    $host = "localhost:3306";
    $user = "andrew";
    $password = "password!";
    $db_name = "ruvie";

    $mysqli = mysqli_connect($host, $user, $password, $db_name);
    $user_id = $_GET["user_id"];
    $sql = "SELECT * FROM `videos` WHERE user_id = $user_id";
    $list = [];
    if($result = $mysqli -> query($sql)){
        while($row = $result -> fetch_array()){
            $list[] = $row;
        }
    }
?>

<?php
    for ($i = 0; $i < sizeof($list); $i++) {
        $name = $list[$i]['name'];
        $desc = $list[$i]['desc'];
        $preview = $list[$i]['preview'];
        $link = $list[$i]['link'];
        $likes = $list[$i]['likes'];
        $dislikes = $list[$i]['dislikes'];
        $views = $list[$i]['views'];

        echo "<ul>
                <li>$name</li>
                <li>$preview</li>
                <li><a href='../video/video.php?video_id=$name'>../video/video.php?video_id=$name'</a></li>
                <li>$views</li>
              </ul><hr>";
    }
?>

<h2>Загрузка</h2>

<form action="../video/upload.php?user_id=<?=$user_id?>" method="post" enctype="multipart/form-data">
    Description: <label>
        <input type="text" name="vid_desk">
    </label><br>
    Video: <label>
        <input type="file" name="video">
    </label><br><br>
    <button type="submit" name="submit">UPLOAD</button>
</form>

<?php
    if ($_GET['txt'] == "error") {
        echo "<p>An error occurred during upload file (((</p>";
    }
    $mysqli -> close();
