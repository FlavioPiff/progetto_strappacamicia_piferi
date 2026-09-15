<?php

session_start(); //avvio la sessione per poter controllare se l'utente ha effettuato il login

if (isset($_SESSION["id_utente"]) === false){ //controllo se l'utente non ha effetuato il login, $_SESSION["id_utente] viene creato solamente dopo un login corretto. Nel caso in cui non esista non permetto di entrare direttamente nel gioco e rimandiamo l'utente alla pagina di login.
    header("Location: index.html");
    exit;
}

?>

<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Strappacamicia - Gioco</title>
        <link rel="stylesheet" href="stile.css">
    </head>

    <body>
        <h1>Strappacamicia</h1>
        <div class="tavolo">

                <p class="tempo">Tempo: <span id="cronometro">00:00</span></p>
                <div id="risultatoPartita">
                    <p id="testoRisultato"></p>
                    <a href="gioco.html" id="tornaGioco">Ricomincia una nuova partita</a>
                </div>
                <div class="cpu">
                    <p class="nomeCPU">CPU</p>
                    <p class="numeroCarte"><span id="carteCPU">20</span> carte</p>
                    <img id="mazzoCPU" src="immagini/carte/dorso.jpg" alt="Mazzo della CPU">
                </div>

                <div class="carte">
                    <div id="tavoloCarte"></div>
                </div>

                <div class="giocatore">
                    <img id="mazzoGiocatore" src="immagini/carte/dorso.jpg" alt="Mazzo del giocatore">
                    <p class="numeroCarte"><span id="carteGiocatore">20</span> carte</p>
                    <p class="nomeGiocatore" id="nomeGiocatore">Nome del giocatore </p>
                    <button id="giocaGiocatore">Gira la carta</button>
                </div>

                <div class="azioni">
                        <a href="index.html">Torna al menù</a>
                </div>
        </div>
        <script src="logica.js"></script>
    </body>
</html>