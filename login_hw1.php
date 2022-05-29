<?php
    include 'verifica_auth.php';

    if(checkA())
    {
        header("Location: home_hw1.php");
        exit;
    }
    if(!empty($_POST["username"]) && !empty($_POST["password"]))
    {

        $conn = mysqli_connect($dbconfig['host'],$dbconfig['user'],$dbconfig['password'],$dbconfig['name'])or die(mysqli_error($conn));

        $username = mysqli_real_escape_string($conn, $_POST["username"]);
        $password = mysqli_real_escape_string($conn, $_POST["password"]);
        $query = "SELECT id,username,password FROM users WHERE username = '".$username."'";
        $res = mysqli_query($conn, $query)or die(mysqli_error($conn));
        if(mysqli_num_rows($res) > 0){
            $entry = mysqli_fetch_assoc($res);
            if(password_verify($_POST['password'], $entry['password'])){
            $_SESSION["username"] = $entry["username"];
            $_SESSION["id"] = $entry["id"];
            header("Location: home_hw1.php");
            mysqli_free_result($res);
            mysqli_close($conn);
            exit;
            }
        }
        else $errore = "verifica le credenziali";
    } 
    else if (isset($_POST["username"]) || isset($_POST["password"])){
        $errore = "Username e password mancanti";
    }

?>
<html>
    <head>
        <link rel='stylesheet' href='style/login_hw1.css'>
        <script src='script/register_def.js' defer></script>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">


        <title>TripBlog ^Accedi^</title>
    </head>
    
 <body>

    <div id="foto1">
          <h1 id="Bio">Condividi le tue esperienze di viaggio su TripBlog</h1>  
    </div>
        <div>
            <img src="style/img/logo.png">
        </div>
        <div id="div2">    
        


        <main>
            <form id='form' name='nome_form_l' method='post'>
                <h1>Accedi</h1>
                <p>
                    <label>Username<input type='text' name='username'></label>
                </p>
                <p>
                    <label>Password<input type='password' name='password'></label>
                </p>
                <p>
                    <label>&nbsp;<input type='submit' value="Accedi"></label>
                </p>
                <div class="login_error hidden"> Compila entrambi i campi</div>
                <?php
                    if(isset($errore)){
                        echo "<p class='login_error'> $errore </spna>";
                    }
                ?>
                <p class="signup">Non hai un account? <a href="signup_hw1.php">Iscriviti</a>
                
                </p>
            </form>
            
            <div id='img'></div>

            

        </main>
        </div>

  </body>
</html>