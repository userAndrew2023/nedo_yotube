<?php
    $host = "localhost:3306";
    $user = "andrew";
    $password = "password!";
    $db_name = "ruvie";
    require_once "blocks/header.php";
?>

<style>
    <?php include './styles/styles.css'; ?>
</style>
<?php
    $mysqli = mysqli_connect($host, $user, $password, $db_name);

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
        $encode = urlencode(serialize($item));
        echo "<li>channel -> <a href='/user/user_videos.php?user=$encode'>channel</a></li>";
        echo "</ul>";
        echo "<hr>";
    }
    $mysqli -> close();
