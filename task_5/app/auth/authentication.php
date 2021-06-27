<?php
$current_page = pathinfo($_SERVER['REQUEST_URI'])['filename'];

// logged user //
if( isset($_SESSION['user']) && ($current_page === 'login' || $current_page === 'register') ) 
header('location:index.php');

// Guest //
if(!isset($_SESSION['user']) && ($current_page === 'profile' || $current_page === 'logout') )
header('location:login.php');

?>