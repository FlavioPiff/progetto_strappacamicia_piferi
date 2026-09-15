<?php

session_start(); //avvio la sessione per poter riconoscere l'utente che ha giocato la partita. Quando salverò una partita, non farò inviare al Javascript l'id_utente ma PHP prenderà direttamente l'utente autenticato dalla sessione ($_SESSION["id_utente])

?>