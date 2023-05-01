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
            if (strpos(mb_strtolower($item['name']), mb_strtolower(trim($text))) !== false) {

                $user_id = $item['user_id'];
                $sql_q = "SELECT * FROM `users` WHERE id = '$user_id'";

                if($result = $mysqli -> query($sql_q)){
                    while($q_row = $result -> fetch_array()){
                        $row2 = $q_row;
                    }
                }

                $name = $item['name'];
                if (strlen($name) > 100) {
                    $name = substr($name, 0, 97) . "...";
                }
                $preview = $item['preview'];
                $views = $item['views'];
                $link = $item['link'];

                $author = $row2['name'];
                $avatar = $row2['icon'];

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
                            <div>
                                <img class='img-icon' width='30' height='30' src='../avatars/$avatar' alt='logo'>
                                <span style='vertical-align: middle;'>
                                    <a class='author_title_search'>$author</a>
                                </span>
                            </div>
                        </div>
                     </div>";

            }
        }
    }
?>
