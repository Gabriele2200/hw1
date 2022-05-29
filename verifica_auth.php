<?php
    require_once 'db.php';
    session_start();

    function checkA() {
        if(isset($_SESSION['id'])) return $_SESSION['id']; 
        else 
        return 0;
    }
?>