<?php 
require_once 'verifica_auth.php'; 
if (!$userid=checkA()) { 
    header('Location: login_hw1.php'); 
    exit; 
} 
if (!isset($_GET['q'])) { 
    echo "No ID has been provided"; 
    exit; 
} 
 
header('Content-Type: application/json'); 
 
$conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn)); 
$postId = mysqli_real_escape_string($conn, $_GET['q']); 
 
$query = "DELETE FROM post WHERE id = " . $postId . " AND Autore =".$_SESSION["id"]; 
 
if (mysqli_query($conn, $query)) $array[] = ['connesione' => true, 'deletedRows' => mysqli_affected_rows($conn)]; 
else $array[] = ['deleted' => false]; 
 
echo json_encode($array); 
mysqli_close($conn);