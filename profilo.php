<?php

session_start(); //avvio la sessione per poter riconoscere che l'utente che ha effettuato il login 

require_once "php/connessione.php"; //carico la connessione al database per recuperare le statistiche dell'utente (uso la stessa connessione MySQL che abbiamo già preparato)

if (isset($_SESSION["id_utente"]) === false){ //controllo se nella sessione non è presente un utente autenticato, se non è presente significa che il visitatore non ha effettuato il login. Userò questo controllo per impedirgli di entrare direttamente nel profilo
    header("Location: index.html"); //rimando alla pagina di login chi non ha effettuato l'accesso, in questa maniera profilo.php non è più accessibile direttamente senza login
    exit; //serve a fermare subito PHP dopo il reindirizzamente
}

$idUtente = $_SESSION["id_utente"]; //recupero dalla sessione l'id dell'utente che ha effettuato il login (es. Flavio-> id_utente = 1)

$sql = "SELECT COUNT(*) AS partite_giocate FROM partite WHERE id_utente = ?"; //preparo la query per contare le partite dell'utente (numero totale di partite giocate dall'utente), (il ? è un segnaposto, non inserirò direttamente l'id_utente nella query, è più sicuro e mi permette di usare una prepared statement, evitando SQL injection)
$stmt = $connessione->prepare($sql); //preparo la query prima di inserire l'id dell'utente
$stmt->bind_param("i", $idUtente); //collego l'id dell'utente al punto interrogativo della query, la "i" indica che il parametro è un intero, perchè l'id_utente è un intero
$stmt->execute(); //eseguo la query per contare le partite giocate dall'utente, execute() esegue la ricerca

?>

<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Strappacamicia - Profilo</title>
    </head>

    <body>
        <h1>Profilo di <?php echo $_SESSION["nickname"]; ?></h1> <!-- mostro il nickname dell'utente autenticato -->
        <h2>Le tue statistiche</h2> <!-- titolo della sezione che conterrà le statistiche delle partite-->
    </body>
</html>