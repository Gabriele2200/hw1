<?php 

    require_once 'dbconfig.php'; 

    session_start(); 
    if(!isset($_SESSION['username'])){ 

        header("Location: login_page.php"); 
        exit; 
    } 
    else if(!isset($_GET["search"])){ 
        header("Location: home.php"); 
        exit; 
    } 

    header('Content-Type: application/json'); 
 

    $conn = mysqli_connect($dbconfig['host'], $dbconfig['username'], $dbconfig['password'], $dbconfig['database']); 
 
    $STRING = mysqli_real_escape_string($conn,$_GET['q']); 

    $query = "SELECT * FROM posts where title LIKE  '%".$STRING."%' OR story LIKE '%".$STRING."%'"; 
    $res = mysqli_query($conn,$query); 
    if(mysqli_num_rows($res)>0){ 
        while($row = mysqli_fetch_assoc($res)){ 
        $query2 = "SELECT personID,username from users where personID = '".$row['userID']."'"; 
        $res2 = mysqli_query($conn,$query2); 
        $idcompare = 0; 
         
        while($row2 = mysqli_fetch_assoc($res2)){ 
            $username = $row2['username']; 
        } 
             $array[]=array( 
            'owner' => 'frb', 
            'postid' => $row['postID'], 
            'username' => $username, 
            'title' => $row['title'], 
            'story' => $row['story'], 
            'search' => $STRING, 
            'numberOfResults' => mysqli_num_rows($res) 
        ); 
 
 
    } 
 
    }else $array[] = array('found' => false); 
    echo json_encode($array); 
    mysqli_close($conn); 
 
 
?>