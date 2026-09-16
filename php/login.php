<?php 

session_start(); //avvio la sessione che userò per mantere l'utente autenticato

header("Content-Type: application/json"); // gli dico che dovrà restituire JSON

require_once "connessione.php";

$datiRicevuti = file_get_contents("php://input"); // $datiRicevuti contiene il JSON dei dati ricevuti dal login
$dati = json_decode($datiRicevuti, true); // in questa maniera trasformiamo i dati ricevuti dal formato JSON in un array associativo PHP

if (isset($dati["nickname"]) === true && isset($dati["password"]) === true){
    $nickname = $dati["nickname"]; //così prendiamo il valore associato alla chiave "nickname" e lo salviamo nella variabile PHP $nickname
    $password = $dati["password"]; //così prendiamo il valore associato alla chiave "password" e lo salviamo nella variabile PGP $password
} else {
    echo json_encode(["successo" => false]);
    exit; //interrompo il login se non sono stati inviati nickname e password
}


$sql = "SELECT * FROM utenti WHERE nickname = ?"; //preparo la query per cercare l'utente tramite il nickname (il ? è un segnaposto, non inserirò direttamente $nickname nella query, è più sicuro e mi permette di usare una prepared statement, evitando SQL injection)
$stmt = $connessione->prepare($sql); //preparo la query prima di inserire il nickname
$stmt->bind_param("s", $nickname); // collego il nickname al punto interrogativo della query, la "s" indica che il parametro è una stringa, perchè il nickname è testo
$stmt->execute(); //eseguo la query per cercare l'utente nel database, execute() esegue la ricerca
$risultato = $stmt->get_result(); //recupero il risultato della ricerca nel database, get_result() mi permette di prendere ciò che MySQL ha trovato e lo salvo in $risultato
$utente = $risultato->fetch_assoc(); //recupero i dati dell'utente trovato, in questo modo $risultato contiene il risultato della query e poi con fetch_assoc() prendo la priam riga trovata e la trasformo in un array PHP

if ($utente !== null){ //controllo se l'utente è stato trovato nel database, infatti fetch_assoc() restituisce i dati dell'utente se trova un riga, in caso contrario restituisce null

    if (password_verify($password, $utente["password_hash"])){ //controllo se la password inserita è corretta, password_verify() confronta in modo sicuro le due password, infatti non confronto la password in chiaro con il databse e non mando l'hash a Javascript

        session_regenerate_id(true); //creo un nuovo id di sessione dopo che il login è riuscito
        $_SESSION["id_utente"] = $utente["id_utente"]; //salvo nella sessione l'id dell'utente che ha effettuato il login
        $_SESSION["nickname"] = $utente["nickname"]; //salvo nella sessione anche il nickname dell'utente


        $risposta = ["successo" => true]; //preparo la risposta in caso di Login andato a buon fine
        echo json_encode($risposta); //invio la risposta in formato JSON in caso di Login andato a buon fine
    }
    else {
        $risposta = ["successo" => false]; //preparo la risposta in caso di Login andato male
        echo json_encode($risposta); //invio la risposta in formato JSON in caso di Login andato male
    }
}
else{
    $risposta = ["successo" => false]; //preparo la risposta nel caso in cui l'utente non esiste
    echo json_encode($risposta); //invio la risposta in formato JSON nel caso in cui l'utente non esiste
}
?>