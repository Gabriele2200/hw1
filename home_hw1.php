<?php

require_once 'verifica_auth.php';
if(!$userid = checkA())
{
    header("Location: login_hw1.php");
    exit;
}
?>




<html>
    <?php
    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
    $userid = mysqli_real_escape_string($conn, $userid);
    $query = "SELECT * FROM users WHERE id = $userid";
    $res__u = mysqli_query($conn, $query);
    $userinfo = mysqli_fetch_assoc($res__u);
    ?>   
    <head>
        <link rel="stylesheet" href="style/home_hw1.css">
        <link rel="stylesheet" href="style/nav.css">
        <link rel="stylesheet" href="style/post.css">
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <script src="script/home.js" defer=></script>
        
        

        <title>TripBlog-Home</title>
    </head>

    
    <body>
        
    <?php include_once 'nav.php' ?>

    <!-- <form name='ricerca' id="ricerca">

        <div id="barra">
        <label> Cerca il meteo<input type='text' name="content" id="content">  </label> 
        <label>&nbsp;<input class="submit" type="submit" value="Cerca"></label>
        </div>
    </form> --> 
    <form name='ricerca' id="ricerca">
        <div id="barra">
        <label> <input type='text' name="content" id="content"></label> 
        <select name="tipo" id="tipo">
            <option value="meteo">Meteo</option>
            <option value="post">Post</option>

        </select>
        <label>&nbsp;<input class="submit" type="submit" value="Cerca"></label>    
        </div>
    </form>
    <div id="Risposta_R" class="hidden">
                 
        <div id="Meteo_div" class="hidden">
            <h1 id="Title_M"> </h1>
            <p id="Parag_M">
                <span >

                </span>
            </p>
            <a id="link_m"href=""> Clicca per maggiori informazioni</a>

        </div>        
        </div>



    </div>



    <header>
    <div id="img-overlay"></div>
      <div id="it-testo">
        <div id="titolo"> Benvenuto <br><?php echo $userinfo['username'] ?></div>
      </div>      
    </header>

    <div class="Home_post" >
        <article >
            <div class="post">
                <h1>All Post</h1>
            </div>
        </article>


    </div>




    <footer>
        <h1> Gabriele Blandini</h1>
        <em id="emf"> 1000002230</em>
    </footer>
    </body>
</html>