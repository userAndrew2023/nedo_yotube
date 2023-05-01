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

<style>
    <?php include "../styles/styles.css";?>
</style>

<h1>Ваши видео</h1>

<?php
foreach ($list as $item) {
    $name = $item['name'];
    $preview = $item['preview'];
    $views = $item['views'];
    $link = $item['link'];
    echo "<div class='container' '>
                        <div class='image'>
                            <img width='300' src='../previews/$preview' class='preview'>
                        </div>
                        <div class='colum'>
                            <div>
                                <a class='title_search' href='../video/video.php?video_id=$name'>$name</a>  
                            </div>
                            <div>
                                <p style='font-size: 15px'>$views просмотров</p>
                            </div>
                        </div>
                     </div>";
}
?>

<h2>Загрузка</h2>

<form action="../video/upload.php?user=<?=urlencode(serialize($user_obj))?>" method="post" enctype="multipart/form-data">
    Description: <label>
        <input class="input_desc" type="text" name="vid_desk">
    </label><br><br>
    Video: <label>
        <input class="input_desc" type="file" name="video">
    </label><br><br>
    <button class="upload" type="submit" name="submit">UPLOAD</button>
</form>

<?php
    if ($_GET['txt'] == "error") {
        echo "<p>An error occurred during upload file (((</p>";
    }
    $mysqli -> close();
