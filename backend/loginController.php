<?php session_start();
$action = $_POST['action'];
if($action == "Signin"){
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
    header("Location: ../index.php?msg=logged in");
}elseif(strtolower($action)=="signup"){

    $username = $_POST['username'];
    $password = $_POST['password'];
    $passwordcheck = $_POST['passwordcheck'];

    $username = strip_tags($username);
    $password = strip_tags($passsword);
    $passwordcheck = strip_tags($passwordcheck);    
    
    require_once("conn.php");
    $query = "SELECT COUNT(*) FROM users WHERE username = :username";
    $statement = $conn->prepare($query);
    $statement->execute([":username" => $username]);
    if ($statement->fetchColumn() > 0) {
        header("Location: ../accountSignin&Signup.php?status=username already exists");
        exit();
    }

    

    //connectie
    require_once("conn.php");
    //input strippen
    $password = strip_tags($password);
    $passwordcheck = strip_tags($passwordcheck);
    $username = strip_tags($username);

    if($password != $passwordcheck){
        header("Location: ../register.php?msg=Wachtwoorden komen niet overeen!");
        exit;
    }

    $hashedpassword = password_hash($password, PASSWORD_DEFAULT);

    //query maken
    $query = "INSERT INTO users (username, password) VALUES(:username, :password)";
    //statement prepare
    $statement = $conn->prepare($query);
    //statement execute
    $statement->execute([ ":username" => $username,
                            ":password" => $hashedpassword]);
    //useraccount
    $useraccount = $statement->fetch(PDO::FETCH_ASSOC);

    header("Location: ../index.php?msg=account aangemaakt!");
}
?>