<?php 
require_once 'db.php'; 
 
if (isset($_GET["email"])) { 
 
    header('Content-Type: application/json'); 
 
    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['pass'], $dbconfig['name']); 
    $email = mysqli_real_escape_string($conn, $_GET["email"]); 
    $query = "SELECT email FROM users WHERE email = '$email'"; 
    $res = mysqli_query($conn, $query) or die(mysqli_error($conn)); 
 
    echo json_encode(array('exists' => mysqli_num_rows($res) > 0 ? true : false)); 
    mysqli_close($conn); 
 
    exit; 
} 
 
if (isset($_GET["usr"])) { 
 
    header('Content-Type: application/json'); 
 
    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['pass'], $dbconfig['name']); 
    $username = mysqli_real_escape_string($conn, $_GET["usr"]); 
    $query = "SELECT username FROM users WHERE username = '$username'"; 
    $res = mysqli_query($conn, $query) or die(mysqli_error($conn)); 
 
    echo json_encode(array('exists' => mysqli_num_rows($res) > 0 ? true : false)); 
    mysqli_close($conn); 
    exit; 
} 
 
echo "Autorizzazione negata"; 
 
?>