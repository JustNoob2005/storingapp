<?php session_start(); ?>

<!doctype html>
<html lang="nl">

<head>
    <title>StoringApp | Edit</title>
    <?php require_once '../head.php'; ?>
</head>

<body>
    <?php 

    if(!isset($_GET['id'])){
        echo "Geef in je aanpaslink op de index.php het id van betreffende item mee achter de URL in je a-element om deze pagina werkend te krijgen na invoer van je vijfstappenplan";
        exit;

    }
    ?>
    <?php
        require_once '../header.php'; ?>

    <div class="container">
        <h1>Melding aanpassen</h1>

        <?php
        //Haal het id uit de URL:
        $id = $_GET['id'];

        //1. Haal de verbinding erbij
        require_once('../backend/conn.php');

        //2. Query, vul deze aan met een WHERE zodat je alleen de melding met dit id ophaalt
        $query = "SELECT * FROM meldingen WHERE id = :id";

        //3. Van query naar statement
        $statement = $conn->prepare($query);

        //4. Voer de query uit, voeg hier nog de placeholder toe
        $statement->execute([
            ":id" => $id
        ]);

        //5. Ophalen gegevens, tip: gebruik hier fetch().
        $melding = $statement->fetch(PDO::FETCH_ASSOC);
        ?>

        <form action="../backend/meldingenController.php" method="POST">
            <!-- (voeg hier opdracht 7 toe) -->
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="id" value=" <?php echo $id;?>">
            <div class="form-group">
                <label>Naam attractie:</label>
                <?php echo $melding['attractie']; ?>
            </div>

            <div class="form-group">
                <label>Type attractie:</label>
                <?php echo $melding['type']; ?>
            </div>
            <!-- Zorg dat het type wordt getoond, net als de naam hierboven -->
            <div class="form-group">
                <label for="capaciteit" name="capaciteit">Capaciteit p/uur:</label>
                <input type="text" name="capaciteit" value="<?php echo $melding['capaciteit']; ?>">
            </div>
            <div class="form-group">
                <label for="prioriteit">Prio:</label>
                <!-- Let op: de checkbox blijft nu altijd uit, pas dit nog aan -->

                <label for="prioriteit">Melding met prioriteit</label>
                <input type="checkbox" name="prioriteit" id="prioriteit" <?php if ($melding['prioriteit'] == 1){echo 'checked';}?>>
            </div>
            <div class="form-group"> 
                <label for="melder">Naam melder:</label>
                <!-- Voeg hieronder nog een value-attribuut toe, zoals bij capaciteit -->
                <input type="text" name="melder" id="melder" class="form-input" <?php $melder = $melding['melder']; echo "value='$melder'";?>>
            </div>
            <div class="form-group">
                <label for="overig" name="overig">Overige info:</label>
                <textarea name="overig" id="overig" class="form-input" rows="4"><?php echo $melding['overige_info'] ?></textarea>
            </div>
            
            <input type="submit" value="Melding opslaan">
            
        </form>
        <hr>
        <form action="../backend/meldingenController.php" method="POST">
            <input type="hidden" name="action" value="delete">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="submit" value="Verwijderen">
        </form>
    </div>  

</body>

</html>
