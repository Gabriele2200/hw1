
<?php

require_once 'verifica_auth.php';
if(!$userid=checkA())
{
    echo"Errore (non sei loggato)";
    exit;
}


$conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));

if (isset($_GET["posts"])) {
    if ($_GET["posts"] == "all") {
        $query = "SELECT pst.id,username,content,title FROM post pst join users usr on usr.id=pst.autore ";
        $res = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($res)) {
            $posts[] = array("Post_id" => $row["id"], "autore" => $row["username"], "title" => $row["title"], "content" => $row["content"]);
        }
        if(!empty($posts)) echo json_encode($posts);
        else echo 0;
    }
    else if ($_GET["posts"] == "my_post") { 
        $query = "SELECT pst.id,username,content,title FROM post pst join users usr on usr.id=pst.autore WHERE usr.id=".$_SESSION["id"];
        $res = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($res)) {
            $posts[] = array("Post_id" => $row["id"], "autore" => $row["username"], "title" => $row["title"], "content" => $row["content"]);
        }
        if(!empty($posts)) echo json_encode($posts);
        else echo 0;
    }
} 

if(isset($_GET["cerca"])){
    $query_s= mysqli_real_escape_string($conn,$_GET["cerca"]);
    $query = "SELECT pst.id,username,content,title FROM post pst join users usr on usr.id=pst.autore 
    WHERE title LIKE  '%" . $query_s . "%' OR content LIKE '%" . $query_s . "%'"; 
    $res = mysqli_query($conn,$query);
    while ($row = mysqli_fetch_assoc($res)) {
        $posts[] = array("Post_id" => $row["id"], "autore" => $row["username"], "title" => $row["title"],
        "content" => $row["content"],  'ricerca' => $query_s, 'numberOfResults' => mysqli_num_rows($res) );
    }
   if (!empty($posts)) echo json_encode($posts);
    else echo 0;
}


?>