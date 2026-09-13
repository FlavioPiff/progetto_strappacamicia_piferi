<?php 

header("Content-Type: application/json"); // gli dico che dovrà restituire JSON

require_once "connessione.php"

$datiRicevuti = file_get_contents("php://input"); // $datiRicevuti contiene il JSON dei dati ricevuti dal login
$dati = json_decode($datiRicevuti, true); // in questa maniera trasformiamo i dati ricevuti dal formato JSON in un array associativo PHP

?>