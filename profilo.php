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
$risultato = $stmt->get_result(); //recupero il risultato della query con il numero di partite giocate, get_result() mi permette di prendere ciò che MySQL ha trovato e lo salvo in $risultato
$datiStatistiche = $risultato->fetch_assoc(); //recupero i dati con il numero di partite giocate, in questo modo $risultato contiene il risultato della query e poi con fetch_assoc() prendo la priam riga trovata e la trasformo in un array PHP

$partiteGiocatore = $datiStatistiche["partite_giocate"]; //salvo il numero di partite giocate dall'utente, con questa riga prendiamo solo quel valore e lo salviamo in $partiteGiocate

$sqlVittorie = "SELECT COUNT(*) AS partite_vinte FROM partite WHERE id_utente = ? AND esito = 'vittoria'"; //preparo la query per contare le partite vinte dall'utente (il ? è un segnaposto, non inserirò direttamente l'id_utente nella query, è più sicuro e mi permette di usare una prepared statement, evitando SQL injection)
$stmtVittorie = $connessione->prepare($sqlVittorie); //preparo la query delle vittorie prima di inserire l'id dell'utente
$stmtVittorie->bind_param("i", $idUtente); //collego l'id dell'utente al punto interrogativo della query, la "i" indica che il parametro è un intero, perchè l'id_utente è un intero
$stmtVittorie->execute(); //eseguo la query per contare le partite vinte dall'utente, execute() esegue la ricerca
$risultatoVittorie = $stmtVittorie->get_result(); //recupero il risultato della query con il numero di partite vinte, get_result() mi permette di prendere ciò che MySQL ha trovato e lo salvo in $risultatoVittorie
$datiVittorie = $risultatoVittorie->fetch_assoc(); //recupero i dati con il numero di partite vinte, in questo modo $risultatoVittorie contiene il risultato della query e poi con fetch_assoc() prendo la prima riga trovata e la trasformo in un array PHP

$partiteVinte = $datiVittorie["partite_vinte"]; //salvo il numero di partite vinte dall'utente, con questa riga prendiamo solo quel valore e lo salviamo in $partiteVinte

$partitePerse = $partiteGiocatore - $partiteVinte; // calcolo le partite perse sottraendo le vittorie dalle partite giocate

$percentualeVittorie = 0; //imposto inizialmente la percentuale di vittorie a zero

if ($partiteGiocatore > 0) { //controllo che l'utente abbia giocato almeno una partita prima di calcolare la percentuale delle vittorie, per evitare l'errore 0 / 0
    $percentualeVittorie = ($partiteVinte / $partiteGiocatore) * 100; //calcolo la percentuale di vittorie del giocatore
}

$sqlDurata = "SELECT AVG(durata) AS durata_media FROM partite WHERE id_utente = ?"; //preparo la query per calcolare la durata media delle partite dell'utente (il ? è un segnaposto, non inserirò direttamente l'id_utente nella query, è più sicuro e mi permette di usare una prepared statement, evitando SQL injection)
$stmtDurata = $connessione->prepare($sqlDurata); //preparo la query della durata media prima di inserire l'id utente
$stmtDurata->bind_param("i", $idUtente); //collego l'id utente al punto interrogativo della query della media, la "i" indica che il parametro è un intero, perchè l'id_utente è un intero
$stmtDurata->execute(); //eseguo la query per calcolare la durata media delle partite dell'utente, execute() esegue la ricerca
$risultatoDurata = $stmtDurata->get_result(); //recupero il risultato della query con la durata media delle partite, get_result() mi permette di prendere ciò che MySQL ha trovato e lo salvo in $risultatoDurata
$datiDurata = $risultatoDurata->fetch_assoc(); //recupero i dati con la durata media delle partite, in questo modo $risultatoDurata contiene il risultato della query e poi con fetch_assoc() prendo la prima riga trovata e la trasformo in un array PHP

$durataMedia = $datiDurata["durata_media"]; //salvo la durata media delle partite dell'utente, con questa riga prendiamo solo quel valore e lo salviamo in $durataMedia

if ($durataMedia === null){ //controllo se l'utente non ha ancora una durata media
    $durataMedia = 0; //se nella tabella partite non ci sono partite dell'utente allora la query non restituisce 0 ma può restituire NULL, se ciò si verifica faccio in modo che venga mostrato 0 evitando un valore vuoto
}

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
        <p>Partite giocate: <?php echo $partiteGiocatore; ?></p> <!-- mostro il numero totale di partite giocate dall'utente -->
        <p>Partite vinte: <?php echo $partiteVinte; ?></p> <!-- mostro il numero totale di partite vinte dall'utente -->
        <p>Partite perse: <?php echo $partitePerse; ?></p> <!-- mostro il numero totale di partite perse dall'utente -->
        <p>Percentuale vittorie: <?php echo $percentualeVittorie; ?>%</p> <!-- mostro la percentuale di vittorie dell'utente -->
        <p>Durata media: <?php echo $durataMedia; ?> secondi</p> <!-- mostro la durata media delle partite dell'utente -->
    </body>
</html>