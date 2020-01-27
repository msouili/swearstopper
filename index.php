<?php
    # include 'index.html';
    require_once ('configuration.php');
    $db_link = mysqli_connect (
                        MYSQL_HOST, 
                        MYSQL_BENUTZER, 
                        MYSQL_KENNWORT, 
                        MYSQL_DATENBANK
                        );
    if ( $db_link )
    {
        echo 'Verbindung erfolgreich: ';
        print_r( $db_link);
    }
    else
    {
        // hier sollte dann später dem Programmierer eine
        // E-Mail mit dem Problem zukommen gelassen werden
        die('keine Verbindung möglich: ' . mysqli_error());
    }
?>