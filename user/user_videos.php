<?php
    $title = "Мои видео";
    require_once "../blocks/header.php";

    $host = "localhost:3306";
    $user = "andrew";
    $password = "password!";
    $db_name = "ruvie";
    $mysqli = mysqli_connect($host, $user, $password, $db_name);
    $user_obj = unserialize($_GET["user"]);
    $user_id = intval($user_obj['id']);

    setcookie('user', json_encode($user_obj), time() + (10 * 365 * 24 * 60 * 60), "/");

    $sql = "SELECT * FROM `videos` WHERE user_id = $user_id";
    $list = [];
    if($result = $mysqli -> query($sql)){
        while($row = $result -> fetch_array()){
            $list[] = $row;
        }
    }
?>

<?php
extracted($list);
?>

<h2>Загрузка</h2>

<form action="../video/upload.php?user=<?=urlencode(serialize($user_obj))?>" method="post" enctype="multipart/form-data">
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
