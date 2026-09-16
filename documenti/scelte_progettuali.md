# Scelte progettuali - Strappacamicia

Durante lo sviluppo del progetto ho cercato di realizzare un' applicazione semplice da utilizzare e con una struttura abbastanza chiara, separando la parte grafica, la logica del gioco e la gestione dei dati.

Il progetto permette ad un utente di effettuare il login, visualizzare le proprie statistiche e giocare a Strappacamicia contro il computer. Al termine di ogni partia vengono salvati nel database l'esito e la durata, in modo da aggiornare le statistiche dell'utente.

## Scelte progettuali

Una delle prime scelte è stata quella di dividere l'applicazione in tre pagine principali: una pagina per il login, una pagina per il profilo e le statistiche e una pagina dedicata al gioco. In questo modo ogni pagina ha un compito preciso e il funzionamento dell'applicazione rimane più ordinato.

Per il database ho scelto di utilizzare solamente due tabelle, 'utenti' e 'partite'. La tabella 'utenti' contiene i dati necessari per effettuare l'accesso, mentre la tabella 'partite' contiene i risultati delle partite giocate. Le statistiche non vengono salvate direttamente nel database, ma vengono calcolate utilizzando i dati presenti nella tabella 'partite'.

Per l'accesso degli utenti ho scelto di utilizzare account già presenti nel database, senza una pagina di registrazione. Le password non vengono salvate direttamente, ma viene memorizzato il loro hash.

Ho inoltre utilizzato le sessioni PHP per mantenere l'utente autenticato durante la navigazione tra il profilo e la pagina di gioco.

## Struttura del progetto e tecnologie utilizzate

Per realizzare il progetto ho utilizzato HTML, CSS, JavaScript, PHP e MySQL. Ho cercato di dividere i diversi compiti dell'applicazione tra più file, in modo da mantenere il progetto più ordinato.

### File principali

- 'index.html': contiene la pagina di login. Utilizza HTML per la struttura della pagina e JavaScript per leggere i dati inseriti dall'utente e inviarli al server.

- 'profilo.php': contiene la pagina del profilo dell'utente. Utilizza PHP per controllare la sessione e per interrogare il database, calcolando le statistiche delle partite dell'utente.

- 'gioco.php': contiene la struttura della pagina di gioco. Utilizza anche PHP per verificare che l'utente abbia effettuato il login prima di permettere l'accesso alla partita.

- 'logica.js': contiene la logica principale del gioco. In questo file vengono creati e mescolati i mazzi, vengono gestiti i turni del giocatore e della CPU, le regole di Strappacamicia, il cronometro e la fine della partita. JavaScript viene utilizzato anche per modificare gli elementi della pagina attraverso il DOM e per comunicare con PHP tramite 'fetch()'.

- 'stile.css': contiene le regole CSS utilizzate per la parte grafica delle pagine di login, profilo e gioco.

### File PHP

- 'php/connessione.php': contiene i dati e le istruzioni necessarie per effettuare la connessione al database MySQL.

- 'php/login.php': riceve nickname e password dalla pagina di login, cerca l'utente nel database, verifica la password e crea la sessione dell'utente autenticato.

- 'php/logout.php': termina la sessione dell'utente e lo riporta alla pagina di login.

- 'php/salva_partita.php': riceve tramite JavaScript l'esito e la durata della partita e li salva nel database associandoli all'utente autenticato.

### Database e API

- 'database/strappacamicia.sql': contiene l'esportazione del database necessaria per poter ricreare le tabelle e i dati del progetto.

- 'api/api.php': contiene la libreria PHP-CRUD-API che lei mi ha indicato, utilizzata per accedere ai dati del database tramite API. Ho limitato l'accesso in modo da non rendere disponibili i dati sensibili degli utenti e da permettere solamente la lettura delle partite appartenenti all'utente autenticato.

### Linguaggi e tecnologie

- **HTML**: utilizzato per creare la struttura delle pagine.
- **CSS**: utilizzato per gestire la parte grafica dell'applicazione.
- **JavaScript**: utilizzato per la logica del gioco, la gestione del DOM e le richieste asincrone tramite 'fetch()'.
- **PHP**: utilizzato per la parte server, l'autenticazione, le sessioni, l'accesso al database e il salvataggio delle partite.
- **MySQL**: utilizzato per memorizzare gli utenti e le partite.
- **AJAX / Fetch API**: utilizzato per permettere a JavaScript di comunicare con PHP senza dover ricaricare la pagina.
- **PHP-CRUD-API**: utilizzato per mettere a disposizione un'API REST collegata al database.