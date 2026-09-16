# Progetto Strappacamicia

Applicazione web che permette ad un utente autenticato di giocare al gioco dello Strappacamicia contro il computer e di visualizzare e le statistiche delle partite giocate.

## Funzionalità applicazione:

+ Permettere ad un utente autenticato di giocare a Strappacamicia contro il computer tramite un'interfaccia grafica
+ Salvare nel database i risulatati e la durata delle partite giocate
+Mostrare all'utente le statistiche relative alle proprie partite 

## Modalità di utilizzo:

**1. Accesso tramite account**

+ L'utente accede all'applicazione inserendo nickname e password
+ Le credenziali vengono verificate e, se corrette, l'utente viene indirizzato alla propria pagina del profilo 

**2. Visualizzazione delle statistiche**

+ Nel profilo vengono mostrate le statistiche delle partite giocate:

1. Partite giocate
2. Partite vinte
3. Partite perse
4. Percentuale vittorie
5. Durata media delle partite (espressa in secondi)

**3. Partita contro il computer**

+ Dal profilo l'utente può iniziare una partita a Strappacamicia contro il computer 
+ Al termine della partita vengono salvati nel database l'esito e la durata della partita


## Interfaccia:

**1. Pagina di login**

+ Form per l'inserimento del nickname

+ Form per l'inserimento della password

+ Messaggio di errore in caso di credenziali non corrette

**2. Pagina del profilo e statistiche**

+ Nickname dell'utente

+ Partite giocate

+ Partite vinte e perse

+ Percentuale di vittorie

+ Durata media delle partite

+ Collegamento per iniziare una nuova partita

+ Collegamento per effettuare il logout

**3. Pagina di gioco**

+ Mazzo del giocatore e mazzo del computer con il rispettivo numero di carte

+ Area centrale in cui vengono mostrate le carte giocate

+ Cronometro della partita

+ Pulsante per giocare una carta

+ Messaggio finale di vittoria o sconfitta

+ Collegamento per iniziare una nuova partita


## Installazione e avvio del progetto

### 1. Scaricare il progetto

+ Clonare il repository GitHub oppure scaricarlo come file ZIP.

### 2. Configurare il database

Avviare i server Apache e MySQL tramite MAMP.

Aprire phpMyAdmin e creare un nuovo database chiamato:

+ strappacamicia


Dopo selezionare il database appena creato e importare il file:

+ database/strappacamicia.sql


Il file SQL permette di ricreare le tabelle 'utenti' e 'partite' e i dati necessari per utilizzare il progetto.

La connessione al database utilizzata dal progetto è configurata nel file 'php/connessione.php' con i seguenti parametri:

- Host: 'localhost'
- Utente MySQL: 'root'
- Password MySQL: 'root'
- Database: 'strappacamicia'
- Porta MySQL: '3306'

Se si ha una configurazione di MySQL diversa vanno modificare questi valori nel file 'php/connessione.php'.


### 3. Configurare MAMP

Aprire MAMP e verificare che Apache utilizzi la porta '80' e MySQL la porta '3306'.

Impostare come Document Root di Apache la cartella del progetto:

+ C:\MAMP\htdocs\progetto_strappacamicia_piferi


     
## LINK REGOLE GIOCO:

+ https://www.cavallore.it/index.php/giochi/29-stracciacamicia-o-resta-in-camicia

## LINK SET IMMAGINI CARTE DA GIOCO NAPOLETANE:

+ https://commons.wikimedia.org/wiki/Category:Naples_deck

+ (ATTENZIONE: Ho verificato che tutte le immagini delle carte che metto sono di pubblico dominio e non soggette a copyrigth)
