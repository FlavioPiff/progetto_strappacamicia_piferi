<?php

session_start(); //avvio la sessione per effettuare il logout dell'utente. Per poter eliminare la sessione devo prima recuperare la sessione attualmente attiva tramite session_start()

$_SESSION = []; //svuoto i dati salvati nella sessione dell'utente e poi distruggo la sessione
session_destroy(); //distruggo la sessione dell'utente per effettuare il logout. Con session_destroy() PHP elimina la sessione corrente, di conseguenza l'utente non risulterà più autenticato.


header("Location: ../index.html"); //dopo il logout rimando l'utente alla pagina di login. Il ../ è importante perchè logout.php si trova dentro la cartella php, mentre index.html si trova nella cartella principale. Dopo session_destroy() l'utente non è più autenticato e con header() lo riporto automaticamente alla pagina di login.
exit; //interrompo il codice dopo aver reinderizzato l'utente alla pagina di login
?>