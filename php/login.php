<?php 

header("Content-Type: application/json"); // gli dico che dovrà restituire JSON

require_once "connessione.php"

$datiRicevuti = file_get_contents("php://input"); // $datiRicevuti contiene il JSON dei dati ricevuti dal login
$dati = json_decode($datiRicevuti, true); // in questa maniera trasformiamo i dati ricevuti dal formato JSON in un array associativo PHP

$nickname = $dati["nickname"]; //così prendiamo il valore associato alla chiave "nickname" e lo salviamo nella variabile PHP $nickname
$password = $dati["password"]; //così prendiamo il valore associato alla chiave "password" e lo salviamo nella variabile PGP $password

$sql = "SELECT * FROM utenti WHERE nickname = ?"; //preparo la query per cercare l'utente tramite il nickname (il ? è un segnaposto, non inserirò direttamente $nickname nella query, è più sicuro e mi permette di usare una prepared statement, evitando SQL injection)
$stmt = $connessione->prepare($sql); //preparo la query prima di inserire il nickname
?>