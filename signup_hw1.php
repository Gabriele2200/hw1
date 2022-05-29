<?php
  include 'verifica_auth.php';

  if(checkA())
  {
      header("Location: home_hw1.php");
      exit;
  }

  if(!empty($_POST["username"]) && !empty($_POST["password"]) && 
     !empty($_POST["email"]) && !empty($_POST["name"]) && 
     !empty($_POST["surname"])){
      $error = array();
      $conn = mysqli_connect($dbconfig['host'],$dbconfig['user'],$dbconfig['password'],$dbconfig['name'])
      or die(mysqli_error($conn));

        if(!preg_match('/^[a-zA-Z0-9_]{1,13}$/', $_POST['username'])) 
        {
         $error[] = "Username non valido";
        } 
        else{
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $query = "SELECT username FROM users WHERE username = '$username'";
        $res = mysqli_query($conn, $query);
        if (mysqli_num_rows($res) > 0) {
            $error[] = "Username già in utilizzo";
         }
        }
        
        if (strlen($_POST["password"]) < 5) {
            $error[] = "Caratteri password insufficienti minimo richiesto 5";
        }
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $error[] = "Email non valida";
        } else {
            $email = mysqli_real_escape_string($conn, strtolower($_POST['email']));
            $res = mysqli_query($conn, "SELECT email FROM users WHERE email = '$email'");
            if (mysqli_num_rows($res) > 0) {
                $error[] = "Email già utilizzata";
            }
        }

        if (count($error) == 0) {
            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $surname = mysqli_real_escape_string($conn, $_POST['surname']);

            $password = mysqli_real_escape_string($conn, $_POST['password']);
            $password = password_hash($password, PASSWORD_BCRYPT);

            $query = "INSERT INTO users(username, password, name, surname, email) VALUES('$username', '$password', '$name', '$surname', '$email')";
            if(mysqli_query($conn,$query))
            {
            $_SESSION["username"] = $_POST["username"];
            $_SESSION["id"] = mysqli_insert_id($conn);
            
            mysqli_close($conn);
            header("Location: home_hw1.php");
            exit;
            }
            else $error[]= "Connessione al database non riuscita";
            
        }

        
    }
   
?>




<html>
    <head>
        <link rel='stylesheet' href='style/login_hw1.css'>
        <script src='script/register_def.js' defer></script>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">


        <title>TripBlog ^Iscriviti^</title>
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
            <form id='form' name='nome_form' method='post'>
                <h1>Iscriviti</h1>
                <p class="name">
                    <label>Nome<input type='text' name='name'></label>  
                </p>
                <p class="surname">
                    <label>Cognome<input type='text' name='surname'></label>
                </p>
                <div id="name_error" class="sig_e hidden">Nome o cognome troppo lungo</div>
                <p class="username">
                    <label>Username<input type='text' name='username'></label>
                    <div id="username_error" class="sig_e hidden">Username non valido</div>
                </p>
                <p class="password">
                    <label>Password <input type='password' name='password'></label>
                    <div id="password_error" class="sig_e hidden">Password non valida (almeno 6 caratteri)</div>
                </p>
                <p class="email">
                    <label>Email<input type='text' name='email'></label>
                    <div id="email_error" class="sig_e hidden">Email non valida</div>
                </p>
                <p>
                    <label>&nbsp;<input type='submit' value="Registrati"></label>
                </p>
                <p class="signup">Hai un account? <a href="login_hw1.php">Accedi</a>
                <?php
                  if(isset($error)) echo "<span class='error'>$error</span>";
                ?>
                </p>
                <div id="final_error" class="sig_e hidden">Rivedi le tue credenzioli</div>
            </form>
            
            <div id='img'></div>

            

        </main>
        </div>

  </body>
</html>