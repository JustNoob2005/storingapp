<?php
require_once('../security.php');

$action = $_POST['action'];
if($action == "create"){


    //Variabelen vullen
    if (isset($_POST['attractie'])) {
        $attractie = $_POST['attractie'];
    } else {
        die("attractie is not set.");
    }
    
    if (isset($_POST['types'])) {
        $type = $_POST['types'];
    } else {
        die("types is not set.");
    }
    
    if (isset($_POST['capaciteit'])) {
        $capaciteit = $_POST['capaciteit'];
    } else {
        die("capaciteit is not set.");
    }
    
    if (isset($_POST['melder'])) {
        $melder = $_POST['melder'];
    } else {
        die("melder is not set.");
    }
    
    if (isset($_POST['overig'])) {
        $overig = $_POST['overig'];
    } else {
        die("overig is not set.");
    }
    
    if(isset($_POST['prioriteit']))
    {
        $prioriteit = 1;
    }
    else {
        $prioriteit = 0;
    }

    //1. Verbinding
    require_once 'conn.php';

    //2. Query
    $query = "INSERT INTO meldingen (attractie, type, capaciteit, prioriteit, melder, overige_info)
    Values(:attractie, :type, :capaciteit, :prioriteit, :melder, :overige_info)";
    //3. Prepare
    $statement = $conn->prepare($query);
    //4. Execute
    $statement->execute([
        ":attractie" => $attractie,
        ":type" => $type,
        ":capaciteit" => $capaciteit,
        ":prioriteit" => $prioriteit,
        ":melder" => $melder,
        ":overige_info" => $overig 
    ]);

    header("Location: ../meldingen/index.php?msg=Melding opgeslagen");
        
}
if($action == "update")
{
    //Variabelen vullen
    
    if (isset($_POST['capaciteit'])) {
        $capaciteit = $_POST['capaciteit'];
    } else {
        die("capaciteit is not set.");
    }
    
    if (isset($_POST['melder'])) {
        $melder = $_POST['melder'];
    } else {
        die("melder is not set.");
    }
    
    if (isset($_POST['overig'])) {
        $overig = $_POST['overig'];
    } else {
        die("overig is not set.");
    }
    
    if(isset($_POST['prioriteit']))
    {
        $prioriteit = 1;
    }
    else {
        $prioriteit = 0;
    }

    if(isset($_POST['id']))
    {
        $id = $_POST['id'];
    }
    //..........................
    //..........................
    require_once('conn.php');
    $query = "UPDATE meldingen SET capaciteit = :capaciteit, prioriteit = :prioriteit, melder = :melder, overige_info = :overige_info WHERE id = :id";
    $statement = $conn->prepare($query);
    echo $capaciteit;
    echo $prioriteit;
    echo $melder;
    echo $overig; 
    echo $id;

    $statement->execute([
        ":capaciteit" => $capaciteit,
        ":prioriteit" => $prioriteit,
        ":melder" => $melder,
        ":overige_info" => $overig,
        ":id" => $id
    ]);
    header("Location: ../meldingen/index.php");
}
if($action == "delete"){
    $id  = $_POST['id'];
    require_once('conn.php');
    $query = "DELETE FROM meldingen WHERE id = :id";
    $statement = $conn->prepare($query);  
    $statement->execute([
        ":id" => $id
    ]);
    header("Location: ../meldingen/index.php?msg=Melding succesvol verwijderd");
}
?>