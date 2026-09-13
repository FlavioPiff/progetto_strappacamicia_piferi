<?php

session_start(); //avvio la sessione per poter riconoscere che l'utente che ha effettuato il login 

if (isset($_SESSION["id_utente"]) === false){ //controllo se nella sessione non è presente un utente autenticato, se non è presente significa che il visitatore non ha effettuato il login. Userò questo controllo per impedirgli di entrare direttamente nel profilo
    header("Location: index.html"); //rimando alla pagina di login chi non ha effettuato l'accesso, in questa maniera profilo.php non è più accessibile direttamente senza login
    exit; //serve a fermare subito PHP dopo il reindirizzamente
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
    </body>
</html>
