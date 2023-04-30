<?php
    if (isset($_POST['submit'])) {
        $file = $_FILES['video'];

        $filedesk = $_POST['vid_desk'];
        $user_id = $_GET["user_id"];
        $filename = $file['name'];
        $target_dir = "../videos/";
        $target_file = $target_dir . basename($_FILES["video"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
            header("Location: ../user/user_videos.php?txt=error?user_id=$user_id");
            die();
        }

        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars(basename($file["name"])) . " has been uploaded.";
            $host = "localhost:3306";
            $user = "andrew";
            $password = "password!";
            $db_name = "ruvie";
            $mysqli = mysqli_connect($host, $user, $password, $db_name);

            $filename = substr($filename,0,-4);
            $user_id = intval($user_id);
            $sql = "INSERT INTO videos (`name`, `desc`, `preview`, `link`, `likes`, `dislikes`, `user_id`, `views`) 
                        VALUES ('$filename', '$filedesk', 'preview', '../videos/video.php?video_id=$filename', 0, 0, $user_id, 0)";

            if($mysqli->query($sql)){
                echo "Данные успешно добавлены";
            } else{
                echo "Ошибка: " . $mysqli->error;
            }
            $mysqli -> close();

        } else {
            echo "Sorry, there was an error uploading your file.";
        }
        header("Location: ../user/user_videos.php?user_id=$user_id");
        die();
    }
    header("Location: ../user/user_videos.php?user_id=$user_id?txt=error");
    die();