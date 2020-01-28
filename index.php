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
        <title>SwearStopper</title>
    </head>
    <body>
        <div class="wrapper">
            <div id="cont" class="container">
                <div id="" class="row" style="margin-top: 5%">
                    <form method="POST">
                        <h2>Schlagwörter</h2>
                        <input name="title" type="input" placeholde="Schlagwort eingeben">
                        <!--textarea id="title" name="title" placeholder="Schlagwort" cols="25" rows="1"></textarea-->
                        <input id="send" class="button-primary" type="submit" value="Absenden">
                    </form>
                    <div>
                        <?php #outputDatabase();?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

<?php





if (isset($_POST["title"])){
    
    //query 
    $input = $_POST["title"];
    $sqlInsert = "INSERT INTO forbidden_words (forb_word) VALUES ('$input')";

    if ($conn->query($sqlInsert) === TRUE){
        echo "Neuer Eintrag erfolgreich erstellt <br>";
    }else{
        echo "Error: " . $sqlInsert . "<br>" . $conn->error;
    }


}

#function outputDatabase(){
    $sqlOutput = "SELECT forb_word FROM forbidden_words";
    $result = $conn->query($sqlOutput);

    if ($result->num_rows > 0){
        //output data of each row
        while ($row = $result->fetch_assoc()){
            echo "Verbotenes Wort: " . $row["forb_word"] . "<br>";
        }
    }else{
            echo "0 Results";
        }
    $conn->close();
#}


function debugger($a){
    echo "<xmp>";
    print_r($a);
    echo "</xmp>";
}
?>