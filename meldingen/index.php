<?php require_once('../security.php'); ?>

<!doctype html>
<html lang="nl">

<head>
    <title>StoringApp | Meldingen</title>
    <?php require_once '../head.php'; ?>
</head>

    <body>

        <?php require_once '../header.php'; ?>
        
        <div class="container">
            <h1>Meldingen</h1>
            <a href="create.php">Nieuwe melding &gt;</a>

            <?php if(isset($_GET['msg']))
            {
                echo "<div class='msg'>" . $_GET['msg'] . "</div>";
            } ?>

            <?php
            //query uitvoeren:
            if(empty($_GET['filter'])){
                require_once('../backend/conn.php');
                $query = "SELECT * FROM meldingen";
                $statement = $conn->prepare($query);
                $statement->execute([
                    ":user_id" => $_SESSION['user_id']
                ]);
            }
            else{
                require_once('../backend/conn.php');
                $query = "SELECT * FROM meldingen WHERE type = :filter";
                $statement = $conn->prepare($query);
                $statement->execute([
                    ":filter" => $_GET['filter']
                ]);
            }
            $meldingen = $statement->fetchAll(PDO::FETCH_ASSOC);
            
            ?>
            <div class="filter-group">
                <p>Aantal meldingen: <strong><?php echo count($meldingen); ?></strong></p>
                <form action="" method="GET">
                    <select name="filter" id="filter">
                        <option value="">-Kies een type-</option>   
                        <option value="achtbaan" <?php if(strtolower($_GET['filter']) == "achtbaan"){echo "selected";} ?>>Achtbaan</option>   
                        <option value="draaiend" <?php if(strtolower($_GET['filter']) == "draaiend"){echo "selected";} ?>>draaiend</option>   
                        <option value="kinder" <?php if(strtolower($_GET['filter']) == "kinder"){echo "selected";} ?>>kinder</option>   
                        <option value="horeca" <?php if(strtolower($_GET['filter']) == "horeca"){echo "selected";} ?>>horeca</option>   
                        <option value="show" <?php if(strtolower($_GET['filter']) == "show"){echo "selected";} ?>>show</option>   
                        <option value="water" <?php if(strtolower($_GET['filter']) == "water"){echo "selected";} ?>>water</option>   
                        <option value="overig" <?php if(strtolower($_GET['filter']) == "overig"){echo "selected";} ?>>overig</option>
                    </select>
                    <input type="submit" value="Filter">
                </form>
            </div>
            <table class="Meldingen">
                <tr>
                    <th>Attractie</th>
                    <th>Type</th>
                    <th>Capaciteit</th>
                    <th>Melder</th>
                    <th>Overige info</th>
                    <th>Aanpassen</th>
                </tr>
                <?php foreach ($meldingen as $melding): ?>
                    <tr>
                        <td><?php echo ucfirst($melding['attractie']);?></td>
                        <td><?php echo ucfirst($melding['type']);?></td>
                        <td><?php echo ucfirst($melding['capaciteit']);?></td>
                        <td><?php echo ucfirst($melding['melder']);?></td>
                        <td><?php echo ucfirst($melding['overige_info']);?></td>
                        <td><?php echo "<a href='edit.php?id={$melding['id']}'>Aanpassen</a>"; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>  

    </body>

</html>