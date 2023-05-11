<?php session_start(); ?>

<!doctype html>
<html lang="nl">

<head>
    <title>StoringApp</title>
    <?php require_once 'head.php'; ?>
</head>

<body>

    <?php require_once 'header.php'; 
    if(isset($_SESSION['user_id'])){
        header("Location: index.php?msg=Je bent al ingelogd");
    }?>
    <?php if (isset($_GET['msg'])): ?>
            <p class="msgEl"><?php echo($_GET['msg']); ?></p>
        <?php endif ?>


    <div class="container home">
        <form action="backend/loginController.php" method="POST">

            <div class="form-group">
                <label for="username">Gebruikersnaam:</label>
                <input type="text" name="username" id="username">
            </div>

            <div class="form-group">
                <label for="password">Wachtwoord:</label>
                <input type="password" name="password" id="password">
            </div>
            <input type="hidden" name="action" id="action" value="Signin">

            <input type="submit" value="Login">
        </form>
    </div>

</body>

</html>