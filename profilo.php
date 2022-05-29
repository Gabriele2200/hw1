<?php

require_once 'verifica_auth.php';
if(!$userid=checkA())
{
    header("Location: login_hw1.php");
    exit;
}



?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <script src="script/profilo.js" defer=></script>
    <link rel="stylesheet" href="style/post.css">

    <link rel="stylesheet" href="style/nav.css">
    <title>Tripblog-Profile</title>
</head>
<body>
    
<?php include_once 'nav.php' ?>





<div class="Home_post">
        <article>
            <div class="_post">
                <h1>My Post</h1>
            </div>
        </article>
    </div>
</body>
</html>