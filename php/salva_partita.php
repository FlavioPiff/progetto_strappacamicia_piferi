<?php

session_start(); //avvio la sessione per poter riconoscere l'utente che ha giocato la partita. Quando salverò una partita, non farò inviare al Javascript l'id_utente ma PHP prenderà direttamente l'utente autenticato dalla sessione ($_SESSION["id_utente])
header("Content-Type: application/json"); //specifico che la risposta inviata a Javascipt è in formato JSON

require_once "connessione.php"; //carico la connessione al database per poter salvare la partita. In questo modo questo file potrà eseguire un INSERT nella tabella partite, per poterlo fare gli serve la connessione MySQL che ho già preparato in connessione.php

if (isset($_SESSION["id_utente"]) === false){ //controllo se l'utente non ha effetuato il login, salva_partita.php non deve accettare il salvataggio di una partita se non esiste un utente autenticato. In questa maniera se qualcuno prova ad aprire o richiamare direttamente il file senza aver fatto il login alla PHP si ferma con exit; 
    exit;
}

$idUtente = $_SESSION["id_utente"]; // recupero dala sessione l'id utente che ha giocato la partita. In questa maniera invece di ricevere l'id_utente dal Javascript prendo direttamente dalla sessione.

$datiRicevuti = file_get_contents("php://input"); // recupero i dati della partita inviati dal Javascript in formaato JSON. Faccio questo perchè più vanti logica.js userà la fetch() per inciare a PHP le informazioni di esito e durata della partita. php://input permette a pHP di leggere il JSON ricevuto nella richiesta, analogamente a come ho fatto già nel login
$dati = json_decode($datiRicevuti, true); //trasformo i dati ricevuti dal formato JSON in un array PHP. con json_decode() trasformo il testo JSON in un array PHP

if ($dati === null){
    echo json_encode(["successo" => false]);
    exit; //interrompo il salvataggio se i dati ricevuti non sono in formato JSON. se json-decode() riceve qualcosa che non è JSON valido allora restituisce null, in questa maniera blocco subito la richiesta senza provare a leggere esito e durata
}

if (isset($dati["esito"]) === true && isset($dati["durata"]) === true){
    $esito = $dati["esito"]; //recupero dai dati ricevuti l'esito della partita
    $durata = $dati["durata"]; //recupero dai dati ricevuti la durata della partita
} else {
    echo json_encode(["successo" => false]);
    exit; //interrompo il salvataggio se non sono stati inviati tutti i dati della partita (devono essere inviati sia esito che durata, se uno dei due manca allora interrompo il salvataggio) 
}

if ($esito !== "vittoria" && $esito !== "sconfitta"){
    echo json_encode(["successo" => false]);
    exit; //interrompo il salvataggio se l'esito ricevuto non è valido
}

if (is_int($durata) === false || $durata < 0){
    echo json_encode(["successo" => false]);
    exit; //interrompo il salvataggio se la durata della partita ricevuta non è un numero intero valido
}



$sql = "INSERT INTO partite (id_utente, data_partita, durata, esito) VALUES (?, NOW(), ?, ?)"; //preparo la query per salvare la partita nel database. I dati che inserirò saranno quelli richiesti dalla tabella (id_utente, preso dalla sessione; data_partita, con NOw() inserisco automaticamente data ed ora; durata ed esito, ricevuti dal Javascritp). Utilizzo anche in questo caso, come per il login, i ? che verranno collegati alle mie variabili tramite un prepared statement
$stmt = $connessione->prepare($sql); //preparo la query prima di inserire i dati della partita
$stmt->bind_param("iis", $idUtente, $durata, $esito); // collego alla query l'id utente, la durata e l'esito della partita. la query contiene 3 ? e la stringa iis indica a PHP iil tipo dei 3 valori, i per l'id utente, i per la durata e s per l'esito
$stmt->execute(); //eseguo la query per salvare la partita nel database, execute() esegue esegue effettivamente l'INSERT
$risposta = ["successo" => true]; //preparo la risposta che conferma che la partita è stata salvata. quando Java chiamerà salva_partita.php dovrà sapere se PHP è arrivato correttamente fino al savataggio 
echo json_encode($risposta); //restituisco al Javascript la risposta in formato JSON ($risposta è ancora un array PHP, con json_encode() diventa una risposta JSON)
?>