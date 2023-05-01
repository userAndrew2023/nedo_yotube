<?php
    $title = "Поиск";
    require_once "../blocks/header.php";
    ?>

<style>
    <?php include "../styles/styles.css";?>
</style>

<?php
    $text = $_POST['text'];
    $host = "localhost:3306";
    $user = "andrew";
    $password = "password!";
    $db_name = "ruvie";
    $mysqli = mysqli_connect($host, $user, $password, $db_name);

    if ($text == "") {
            echo "Введен пустой поисковой запрос";
    } else {
        $sql = "SELECT * FROM `videos`";
        $list = [];
        if($result = $mysqli -> query($sql)){
            while($row = $result -> fetch_array()){
                $list[] = $row;
            }
        }
        foreach ($list as $item) {
            if (strpos($item['name'], strtolower(trim($text))) !== false) {
                $name = $item['name'];
                $preview = $item['preview'];
                $views = $item['views'];
                echo "<ul>
                    <li>$name</li>
                    <li>$preview</li>
                    <li><a href='../video/video.php?video_id=$name'>../video/video.php?video_id=$name'</a></li>
                    <li>$views</li>
                  </ul><hr>";
            }
        }
    }