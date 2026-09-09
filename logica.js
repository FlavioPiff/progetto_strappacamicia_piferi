const semi = ["Spade", "Denari", "Coppe", "Bastoni"];
const valori = ["Asso", "2", "3", "4", "5", "6", "7", "8", "9", "10"];

let mazzo = [];
let carteGiocatore = [];
let carteCPU = [];
let carteSulTavolo = [];
let turno = "giocatore";
let risposteRimanenti = 0;
let ultimoOnore = "";

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


const contatoreGiocatore = document.getElementById("carteGiocatore");
const contatoreCPU = document.getElementById("carteCPU");
const tavoloCarte = document.getElementById("tavoloCarte");
const pulsanteGiocaGiocatore = document.getElementById("giocaGiocatore");

pulsanteGiocaGiocatore.addEventListener("click", giocaGiocatore);


function giocaGiocatore(){

    if (turno !== "giocatore"){
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

    if (risposteRimanenti === 0 && ultimoOnore === "CPU"){
        carteCPU = carteCPU.concat(carteSulTavolo);
        carteSulTavolo = [];
        ultimoOnore = "";

        setTimeout(function(){ //Quando la CPU prende la mano dal tavolo si aspetta 1.5 secondi mostrando la presa sul tavolo, viene pulito il tavolo e poi la CPU rigioca una carta
            tavoloCarte.innerHTML = "";
            turno = "CPU";
            giocaCPU();
        }, 1500);

        return; //Il return serve ad impedire che la CPU giochi subito anche tramite il codice che ho subito sotto
    }

    if (onoreGiocatore === false && risposteRimanenti > 0){
        turno = "giocatore";
        return;
    }

    turno = "CPU";

    giocaCPU();

    console.log(onoreGiocatore);
    console.log(risposteGiocatore);
}


function giocaCPU(){

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
        return;
    }

    console.log(onoreCPU);
    console.log("Rispposte prima:", risposteRimanenti);

    if (onoreCPU === false && risposteRimanenti > 0){
        risposteRimanenti = risposteRimanenti - 1;
    }

    console.log("Risposte dopo:", risposteRimanenti);

    if (risposteRimanenti === 0 && ultimoOnore === "giocatore"){
        carteGiocatore = carteGiocatore.concat(carteSulTavolo);
        carteSulTavolo = [];
        ultimoOnore = "";

        setTimeout(function(){ //Quando il giocatore prende la mano dal tavolo si aspetta 1.5 secondi mostrando la presa sul tavolo, viene pulito il tavolo e poi il giocatore rigioca una carta
            tavoloCarte.innerHTML = "";
            turno = "giocatore"; //La differenza rispetto alla CPU è che qui non chiamo subito una funzione per giocare una carta (giocaGiocatore()), perchè il giocatore deve premere il pulsante "Gira la carta"
        }, 1500);

        return; //Il return serve a fermare la funzione giocaCPU() dopo che il giocatore ha preso il mucchio di carte sul tavolo
    }

    if (risposteRimanenti > 0){
        giocaCPU();
        return;
    }

    turno ="giocatore";
}