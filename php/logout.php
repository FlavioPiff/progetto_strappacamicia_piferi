<?php

session_start(); //avvio la sessione per effettuare il logout dell'utente. Per poter eliminare la sessione devo prima recuperare la sessione attualmente attiva tramite session_start()
session_destroy(); //distruggo la sessione dell'utente per effettuare il logout. Con session_destroy() PHP elimina la sessione corrente, di conseguenza l'utente non risulterà più autenticato.
?>