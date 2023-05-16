<?php session_start();

$username = $_POST['username'];
$password = $_POST['password'];

//connectie
require_once("conn.php");
//input strippen
$password = strip_tags($password);
$username = strip_tags($username);
//query maken
$query = "SELECT * FROM users WHERE username = :username";
//statement prepare
$statement = $conn->prepare($query);
//statement execute
$statement->execute([ ":username" => $username]);
//useraccount
$useraccount = $statement->fetch(PDO::FETCH_ASSOC);

if($statement->rowCount() < 1)
{
    header("Location: ../login.php?msg=Wachtwoord onjuist!");
}

if(!password_verify($password,$useraccount['password']))
{
    header("Location: ../login.php?msg=Wachtwoord onjuist!");
    exit;
}

$_SESSION['user_id'] = $useraccount['id'];
header("Location: ../index.php?msg=logged in")
?>