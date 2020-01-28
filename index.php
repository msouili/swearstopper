<?php
require_once ('configuration.php');

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="CSS/main.css">
        <script src="script.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Electrolize&display=swap" rel="stylesheet">
        <title>SwearStopper</title>
    </head>
    <body>
        <section class="form">
            <div class="form-container">
                <form method="POST">
                    <div class="form__input--container">
                        <input type="text" name="term" placeholder="Schlagwort eingeben">
                    </div>
                    <input class="form__submit" type="submit" value="Hinzufügen">
                </form>
                <table>
                    <tr>
                        <th>Schlagwort</th>
                    </tr>
                    <?php
                        $sqlOutput = "SELECT forb_word FROM forbidden_words";
                        $result = $conn->query($sqlOutput);
                    
                        if ($result->num_rows > 0){
                            //output data of each row
                            while ($row = $result->fetch_assoc()){
                                echo "<tr><th>" . $row["forb_word"] . "</tr></th>";
                            }
                        }else{
                                echo "0 Results";
                            }
                        $conn->close();
                    ?>
                </table>
            </div>
        </section>
    </body>
</html>

<?php

if (isset($_POST["term"])){
    
    //query 
    $input = $_POST["term"];
    $sqlInsert = "INSERT INTO forbidden_words (forb_word) VALUES ('$input')";

    if ($conn->query($sqlInsert) === TRUE){
        echo "Neuer Eintrag erfolgreich erstellt <br>";
    }else{
        echo "Error: " . $sqlInsert . "<br>" . $conn->error;
    }


}



function debugger($a){
    echo "<xmp>";
    print_r($a);
    echo "</xmp>";
}
?>