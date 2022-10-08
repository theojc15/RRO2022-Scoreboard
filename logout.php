<?php
    session_start();
    unset($_SESSION["name"]);
   
    header('Refresh: 2; URL = index.php');
?>