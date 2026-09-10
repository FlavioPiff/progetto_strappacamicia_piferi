const semi = ["Spade", "Denari", "Coppe", "Bastoni"];
const valori = ["Asso", "2", "3", "4", "5", "6", "7", "8", "9", "10"];

let mazzo = [];
let carteGiocatore = [];
let carteCPU = [];
let carteSulTavolo = [];
let turno = "giocatore";
let risposteRimanenti = 0;
let ultimoOnore = "";
let partitaFinita = false;
let secondiTrascorsi = 0;
let intervalloCronometro;


function aggiornaCronometro(){ //Cronometro del gioco

    
    secondiTrascorsi = secondiTrascorsi + 1 //Aggiunge un secondo ogni volta
    let minuti = Math.floor(secondiTrascorsi / 60); // vado a calcolare i minuti interi trascorsi (Math.floor(1.25) ci dà 1 che sono i minuti)
    let secondi = secondiTrascorsi % 60 // vado a calcolare i secondi rimanenti, cioè quelli che devono comparire dopo i minuti (75 % 60 ci dà 15, il resto della divisione, che sono i secondi trascorsi dopo il primo minuto)
    
    if (minuti < 10){ // in questo modo non abbiamo 0:1 ma abbiamo 00:1
        minuti = "0" + minuti;
    }

    if (secondi < 10){ // in questo modo non abbiamo 00:1 ma abbiamo 00:01
        secondi = "0" + secondi;
    }

    cronometro.textContent = minuti + ":" + secondi; // mostra il tempo trascorso (0:1, 0:2, ecc. ecc.)
}

intervalloCronometro = setInterval(aggiornaCronometro, 1000); //richiama la funzione aggiornaCronometro ogni secondo


for (let seme of semi) { //Creazione del mazzo napoletano, non mischiato ([{Asso Spade}, {2 Spade}, ecc.ecc.])
    for (let valore of valori){
        const carta = { seme: seme, valore: valore};
        mazzo.push(carta);
    }
}


function mescolaMazzo(){ //Mischio il mazzo: prendo il mazzo originario, utilizzo un mazzo di appoggio e poi "sovrascivo" il mazzo originario con quello mischiato
    let mazzoMescolato = [];

    while (mazzo.length > 0) {
        let posizioneCasuale = Math.floor(Math.random() * mazzo.length);
        let carta = mazzo[posizioneCasuale];
        mazzo.splice(posizioneCasuale, 1);
        mazzoMescolato.push(carta);
    }
    mazzo = mazzoMescolato;
}

mescolaMazzo();

carteGiocatore = mazzo.slice(0, 20); //Creo il mazzo del giocatore
carteCPU = mazzo.slice(20, 40); //Creo il mazzo della CPU


function verificaSeOnore(carta){

    if (carta.valore === "Asso" || carta.valore === "2" || carta.valore === "3"){
        return true;
    }

    return false;
}

function numeroRisposte(carta){

    if (carta.valore === "Asso"){
        return 1;
    }

    if (carta.valore === "2"){
        return 2;
    }

    if (carta.valore === "3"){
        return 3;
    }

    return 0;
}

function terminaPartita(){

    partitaFinita = true; //in questo modo è più chiaro che la partita sia conclusa definitivamente
    clearInterval(intervalloCronometro); //ferma il setInterval che sta chiamando aggiornaCronometro() perchè la partita è finita
    document.getElementById("giocaGiocatore").disabled = true; //Blocco il pulsante "Gira carta" del giocatore

}



function verificaSconfitta(onoreGiocato, chiHaGiocato){ //Funzione che utilizzo per fare tutte le verifiche sulla fine della partita, utilizzo onoreGiocato come parametro della funzione, ovvero una variabile disponibile dentro la funzione

    if (carteGiocatore.length === 0 && risposteRimanenti > 0 && ultimoOnore === "CPU"){ //Con questo if abbiamo che se il mazzetto del giocatore è finito E deve ancora rispondere ad un'onore E l'onore è della CPU allora il giocatore ha automaticamente perso la partita

        terminaPartita(); //In questo modo termino definitivamente la partita e blocco il pulsante del giocatore

        setTimeout(function(){ //aggiungo questo timeout per fare in modo che prima che venga visualizzato il messaggio di perdita della partita venga mostrata l'ultima carta giocata dal gioatore. Se non mettessi questo timeout la carta verrebbe visualizzata dopo il messaggio di sconfitta.
            alert("Hai perso!");
        }, 1000);

        return true; //ritorna true se si è trovata la sconfitta del giocatore
    }
    
    if (carteCPU.length === 0 && risposteRimanenti > 0 && ultimoOnore === "giocatore"){ //Con questo if abbiamo che se il mazzetto della CPU è finito E deve ancora rispondere ad un'onore E l'onore è del giocatore allora la CPU ha automaticamente perso la partita
        
        terminaPartita(); //In questo modo termino definitivamente la partita e blocco il pulsante del giocatore

        setTimeout(function(){ //aggiungo questo timeout per fare in modo che prima che venga visualizzato il messaggio di vittoria della partita venga mostrata l'ultima carta giocata dalla CPU. Se non mettessi questo timeout la carta verrebbe visualizzata dopo il messaggio di vittoria.
            alert("Hai vinto!");
        }, 1000);

        return true; //ritorna true se si è trovata la sconfitta della CPU
    }

    if (carteGiocatore.length === 0 && risposteRimanenti === 0 && onoreGiocato === false && chiHaGiocato === "giocatore"){ // Con questo if abbiamo che se il giocatore finisce tutte le carte del mazzo e l'ultima carta che gioca non è un Onore allora il giocatore ha automaticamente perso la partita
        
        terminaPartita(); //In questo modo termino definitivamente la partita e blocco il pulsante del giocatore

        setTimeout(function(){ //aggiungo questo timeout per fare in modo che prima che venga visualizzato il messaggio di perdita della partita venga mostrata l'ultima carta giocata dal gioatore. Se non mettessi questo timeout la carta verrebbe visualizzata dopo il messaggio di sconfitta.
            alert("Hai perso perchè hai finito le carte!");
        }, 1000);

        return true; //ritorna true se si è trovata la sconfitta del giocatore
    }

    if (carteCPU.length === 0 && risposteRimanenti === 0 && onoreGiocato === false && chiHaGiocato === "CPU"){ // Con questo if abbiamo che se la CPU finisce tutte le carte del mazzo e l'ultima carta che gioca non è un Onore allora la CPU ha automaticamente perso la partita

        terminaPartita(); //In questo modo termino definitivamente la partita e blocco il pulsante del giocatore

        setTimeout(function(){ //aggiungo questo timeout per fare in modo che prima che venga visualizzato il messaggio di vittoria della partita venga mostrata l'ultima carta giocata dalla CPU. Se non mettessi questo timeout la carta verrebbe visualizzata dopo il messaggio di vittoria.
            alert("Hai vinto perchè la CPU ha finito le carte!");
        }, 1000);

        return true; //ritorna true se si è trovata la sconfitta della CPU
    }

    return false; //ritorna false se non si è trovata la sconfitta e quindi la partità può continuare
}


const contatoreGiocatore = document.getElementById("carteGiocatore");
const contatoreCPU = document.getElementById("carteCPU");
const tavoloCarte = document.getElementById("tavoloCarte");
const pulsanteGiocaGiocatore = document.getElementById("giocaGiocatore");
const cronometro = document.getElementById("cronometro");

pulsanteGiocaGiocatore.addEventListener("click", giocaGiocatore);


function giocaGiocatore(){

    if (turno !== "giocatore"){ //Con questo if abbiamo che se NON è il turno del giocatore allora si ferma la funzione giocaGiocatore()
        return;
    }

    if (partitaFinita === true){ //Con questo if, una volta terminata la partita, facciamo in modo che il giocatore premendo il pulsante per girare la carta non generi nessun effetto
        return;
    }

    if (verificaSconfitta() === true){ // if che richiama la funzione di verifica della sconfitta (verificaSconfitta())
        return;
    }

    if (carteGiocatore.length === 0){ //Controllo di sicurezza per evitare che il giocatore provi a giocare una carta se il suo mazzo è vuoto
        return;
    }

    let carta = carteGiocatore.shift();

    carteSulTavolo.push(carta);

    let nomeImmagine = carta.valore.toLowerCase() + "_" + carta.seme.toLowerCase() + ".jpg";
    
    let nuovaCarta = document.createElement("img");
    nuovaCarta.src = "immagini/carte/" + nomeImmagine;

    tavoloCarte.appendChild(nuovaCarta);

    contatoreGiocatore.textContent = carteGiocatore.length;

    let onoreGiocatore = verificaSeOnore(carta);

    let risposteGiocatore = numeroRisposte(carta);

    if (onoreGiocatore === true){
        risposteRimanenti = risposteGiocatore;
        ultimoOnore = "giocatore";
    }

    if (onoreGiocatore === false && risposteRimanenti > 0){
        risposteRimanenti = risposteRimanenti - 1;
    }

    if (verificaSconfitta(onoreGiocatore, "giocatore") === true){ // if che richiama la funzione di verifica della sconfitta (verificaSconfitta()) passandogli come parametro il verificaSeOnore della carta del giocatore e l'informazione che è il giocatore a giocare la carta
        return;
    }

    if (risposteRimanenti === 0 && ultimoOnore === "CPU"){
        carteCPU = carteCPU.concat(carteSulTavolo);
        carteSulTavolo = [];
        contatoreCPU.textContent = carteCPU.length;
        ultimoOnore = "";

        setTimeout(function(){ //Quando la CPU prende la mano dal tavolo si aspetta 1 secondo mostrando la presa sul tavolo, viene pulito il tavolo e poi la CPU rigioca una carta
            tavoloCarte.innerHTML = "";
            turno = "CPU";

            setTimeout(function(){ //Dopo che la CPU ha preso le carte dal tavolo non gioca istantaneamente la carta ma aspetta un po', come se dall'altra parte dello schermo ci fosse un giocatore reale che non preme immediatamente il pulsante ma ha tempi di reazione più lenti e non istantanei
                giocaCPU();
            }, 1000);

        }, 1000);

        return; //Il return serve ad impedire che la CPU giochi subito anche tramite il codice che ho subito sotto
    }

    if (onoreGiocatore === false && risposteRimanenti > 0){
        turno = "giocatore";
        return;
    }

    turno = "CPU";

    setTimeout(function(){ //rendo la CPU più lenta nel voltare la carta evitando che la giri immediatamente, rendendo più realistici i tempi, come se stessi giocando con una persona e non con un computer
        giocaCPU();
    }, 1000);

}


function giocaCPU(){

    if (turno !== "CPU"){ //Con questo if abbiamo che se NON è il turno della CPU allora si ferma la funzione giocaCPU()
        return;
    }

    if (partitaFinita === true){ //Con questo if, una volta terminata la partita, facciamo in modo che la CPU non generi nessun effetto
        return;
    }

    if (verificaSconfitta() === true){ //if che richiama la funzione di verifica della sconfitta (verificaSconfitta())
        return;
    }

    if (carteCPU.length === 0){ //Controllo di sicurezza per evitare che il giocatore provi a giocare una carta se il suo mazzo è vuoto
        return;
    }

    let carta = carteCPU.shift();

    carteSulTavolo.push(carta);

    let nomeImmagine = carta.valore.toLowerCase() + "_" + carta.seme.toLowerCase() + ".jpg";

    let nuovaCarta = document.createElement("img");
    nuovaCarta.src = "immagini/carte/" + nomeImmagine;

    tavoloCarte.appendChild(nuovaCarta);

    contatoreCPU.textContent = carteCPU.length;

    let onoreCPU = verificaSeOnore(carta);

    let risposteCPU = numeroRisposte(carta)

    if (onoreCPU === true){
        risposteRimanenti = risposteCPU;
        ultimoOnore = "CPU";
        turno = "giocatore";

        if (verificaSconfitta() === true){
            return;
        }

        return;
    }

    if (onoreCPU === false && risposteRimanenti > 0){
        risposteRimanenti = risposteRimanenti - 1;
    }

    if (verificaSconfitta(onoreCPU, "CPU") === true){ // if che richiama la funzione di verifica della sconfitta (verificaSconfitta()) passandogli come parametro il verificaSeOnore della carta della CPU e l'informazione che è la CPU a giocare la carta
        return;
    }


    if (risposteRimanenti === 0 && ultimoOnore === "giocatore"){
        carteGiocatore = carteGiocatore.concat(carteSulTavolo);
        carteSulTavolo = [];
        contatoreGiocatore.textContent = carteGiocatore.length;
        ultimoOnore = "";

        setTimeout(function(){ //Quando il giocatore prende la mano dal tavolo si aspetta 1 secondo mostrando la presa sul tavolo, viene pulito il tavolo e poi il giocatore rigioca una carta
            tavoloCarte.innerHTML = "";
            turno = "giocatore"; //La differenza rispetto alla CPU è che qui non chiamo subito una funzione per giocare una carta (giocaGiocatore()), perchè il giocatore deve premere il pulsante "Gira la carta"
        }, 1000);

        return; //Il return serve a fermare la funzione giocaCPU() dopo che il giocatore ha preso il mucchio di carte sul tavolo
    }

    if (risposteRimanenti > 0){

        setTimeout(function(){ //rallento la risposta della carta da parte della CPU quando il giocatore gioca un onore
            giocaCPU();
        }, 1000);

        return;
    }

    turno ="giocatore";
}