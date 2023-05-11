<?php session_start(); ?>

<!doctype html>
<html lang="nl">

<head>
    <title>StoringApp</title>
    <?php require_once 'head.php'; ?>
</head>

<body>

    <?php require_once 'header.php'; ?>

        <?php if (isset($_GET['msg'])): ?>
            <p class="centerTesting"><?php echo($_GET['msg']); ?></p>
        <?php endif ?>


    <div class="container home">

        <h1>Welkom bij de technische dienst</h1>
        <img src="img/logo-big-fill-only.png" alt="logo">

    </div>

</body>

</html>