<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../styles/styles.css">
    <title><?=$title?></title>
</head>

<div class="img_ic">
    <img src="../icon.png" alt="logo" width="200" style="display: inline-block;">
</div>

<div>
    <form action="../search/search.php" method="post">
        <label>
            <input type="text" name="text" class="search_edit" placeholder="Введите поисковый запрос и нажмите Enter">
        </label>
    </form>
</div>

