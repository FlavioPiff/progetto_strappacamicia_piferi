<?php 

header("Content-Type: application/json"); // gli dico che dovrà restituire JSON

require_once "connessione.php"

$datiRicevuti = file_get_contents("php://input");

?>