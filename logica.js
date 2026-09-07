const semi = ["Spade", "Denari", "Coppe", "Bastoni"];
const valori = ["Asso", "2", "3", "4", "5", "6", "7", "8", "9", "10"];

let mazzo = [];
let carteGiocatore = [];
let carteCPU = [];
let carteSulTavolo = [];
let turno = "giocatore";

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

const contatoreGiocatore = document.getElementById("carteGiocatore");
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

    turno = "CPU";

    console.log(carta);
}


function giocaCPU(){

    let carta = carteCPU.shift();

    carteSulTavolo.push(carta);

    let nomeImmagine = carta.valore.toLowerCase() + "_" + carta.seme.toLowerCase() + ".jpg";

    let nuovaCarta = document.createElement("img");
    nuovaCarta.src = "immagini/carte/" + nomeImmagine;

    tavoloCarte.appendChild(nuovaCarta);

    console.log(carta);
}