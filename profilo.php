<?php

session_start(); //avvio la sessione per poter riconoscere che l'utente che ha effettuato il login 

if (isset($_SESSION["id_utente"]) === false){ //controllo se nella sessione non è presente un utente autenticato, se non è presente significa che il visitatore non ha effettuato il login. Userò questo controllo per impedirgli di entrare direttamente nel profilo
    header("Location: index.html"); //rimando alla pagina di login chi non ha effettuato l'accesso, in questa maniera profilo.php non è più accessibile direttamente senza login
    exit; //serve a fermare subito PHP dopo il reindirizzamente
}

?>