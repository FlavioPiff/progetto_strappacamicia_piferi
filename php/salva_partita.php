<?php

session_start(); //avvio la sessione per poter riconoscere l'utente che ha giocato la partita. Quando salverò una partita, non farò inviare al Javascript l'id_utente ma PHP prenderà direttamente l'utente autenticato dalla sessione ($_SESSION["id_utente])

require_once "connessione.php"; //carico la connessione al database per poter salvare la partita. In questo modo questo file potrà eseguire un INSERT nella tabella partite, per poterlo fare gli serve la connessione MySQL che ho già preparato in connessione.php 
?>