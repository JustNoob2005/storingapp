<?php session_start();
if(!isset($_SESSION['user_id']))
{
    $base_url = 'http://localhost/storingapp';
    $msg = "Je moet eerst inloggen!";
    header("Location: $base_url/login.php?msg=$msg");
    exit;
}
?>