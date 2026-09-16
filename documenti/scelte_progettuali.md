# Scelte progettuali - Strappacamicia

Durante lo sviluppo del progetto ho cercato di realizzare un' applicazione semplice da utilizzare e con una struttura abbastanza chiara, separando la parte grafica, la logica del gioco e la gestione dei dati.

Il progetto permette ad un utente di effettuare il login, visualizzare le proprie statistiche e giocare a Strappacamicia contro il computer. Al termine di ogni partia vengono salvati nel database l'esito e la durata, in modo da aggiornare le statistiche dell'utente.

## Scelte progettuali

Una delle prime scelte è stata quella di dividere l'applicazione in tre pagine principali: una pagina per il login, una pagina per il profilo e le statistiche e una pagina dedicata al gioco. In questo modo ogni pagina ha un compito preciso e il funzionamento dell'applicazione rimane più ordinato.

Per il database ho scelto di utilizzare solamente due tabelle, 'utenti' e 'partite'. La tabella 'utenti' contiene i dati necessari per effettuare l'accesso, mentre la tabella 'partite' contiene i risultati delle partite giocate. Le statistiche non vengono salvate direttamente nel database, ma vengono calcolate utilizzando i dati presenti nella tabella 'partite'.

Per l'accesso degli utenti ho scelto di utilizzare account già presenti nel database, senza una pagina di registrazione. Le password non vengono salvate direttamente, ma viene memorizzato il loro hash.

Ho inoltre utilizzato le sessioni PHP per mantenere l'utente autenticato durante la navigazione tra il profilo e la pagina di gioco.