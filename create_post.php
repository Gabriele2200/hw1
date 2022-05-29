<?php
    include 'verifica_auth.php';
    if(!$userid=checkA())
    {
        header("Location: login_hw1.php");
        exit;
    }

    if(!empty($_POST['title']) && !empty($_POST['content'])){
        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
        $title = mysqli_real_escape_string($conn,$_POST['title']);
        $content = mysqli_real_escape_string($conn,$_POST['content']);
        $id=$_SESSION['id'];

        $query = "INSERT into post(Autore,title,content) values ('$id',\"$title\",\"$content\")";
        if(mysqli_query($conn,$query)){
            $posted = true;
        }
        else $posted=false;
        mysqli_close($conn);

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

    <link rel="stylesheet" href="style/nav.css">
    <link rel="stylesheet" href="style/c_post.css">
    <title>Crea post</title>
</head>
<body>
   <?php include_once 'nav.php' ?>

   <form method="post">
   <h1>Nuovo post</h1>
   <textarea id='Titolo'name="title" placeholder="Titolo.."></textarea>
   <textarea name="content" placeholder="nuovo post..."></textarea>
   <label><input type="submit" value="pubblica">&nbsp;
   </form>


   <?php
        if(isset($posted)){
        echo '<div class="ok">Post pubblicato correttamente!</div>'; }
        else if($posted = false){
        echo '<div class="errore">Errore nella pubblicazione del post</div>';
        }
    ?>



</body>
</html>