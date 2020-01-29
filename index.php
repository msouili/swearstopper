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
                        <input type="text" name="title" placeholder="Schlagwort eingeben">
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
                            ?>
                            <tr><th> <?php echo $row["forb_word"]?> <td><a href="<?php 
                                                                                $delete = 10;
                                                                                $sql = "DELETE FROM `forbidden_words` WHERE `forbidden_words` = 10"; ?>" data-alias="<?php echo $row["forb_word"]?>"><b>x</b></a></td></th></tr>
                            <?php
                            }
                        }else{
                                echo "0 Results";
                            }
                    ?>
                </table>
            </div>
        </section>
    </body>
</html>

<?php

if (isset($_POST["title"])){
    
    //query 
    $input = $_POST["title"];
    $sqlInsert = "INSERT INTO forbidden_words (forb_word) VALUES ('$input')";
    $sqlFind = "SELECT '$input' FROM forbidden_words";

    $resultFind = $conn->query($sqlFind);
    
    if($resultFind->num_rows > 1){
        echo "Eintrag bereits vorhanden";
    }else{

        if ($conn->query($sqlInsert) === TRUE){
            $return = "Neuer Eintrag erfolgreich erstellt <br>";
            return $return;
        }else{
            echo "Error: " . $sqlInsert . "<br>" . $conn->error;
        }
    }

}



function debugger($a){
    echo "<xmp>";
    print_r($a);
    echo "</xmp>";
}
?>