# Documentazione Database - Strappacamicia

Il database utilizzato dall'applicazione si chiama 'strappacamicia' e serve per memorizzare gli utenti che possono accedere al gioco e le partite giocate.

Il database è composto da 2 tabelle:

- 'utenti'
- 'partite'

## Tabella utenti

La tabella 'utenti' contiene i dati necessari per identificare gli utenti e permettere l'accesso all'applicazione.


| Attributo | Tipo | Vincoli | Descrizione |
| --- | --- | --- | --- |
| 'id_utente' | INT(11) | PRIMARY KEY, AUTO_INCREMENT, NOT NULL | Identificatore univoco dell'utente |
| 'nickname' | VARCHAR(15) | UNIQUE, NOT NULL | Nickname utilizzato dall'utente per effettuare il login |
| 'password hash' | VARCHAR(255) | NOT NULL | Hash della password dell'utente |

## Tabella partite

La tabella 'partite' contiene i dati relativi alle partite giocate dagli utenti.

| Attributo | Tipo | Vincoli | Descrizione |
| --- | --- | --- | --- |
| 'id_partita' | INT(11) | PRIMARY KEY, AUTO_INCREMENT, NOT NULL | Identificatore univoco della partita |
| 'id_utente' | INT(11) | FOREIGN KEY, NOT NULL | Identifica l'utente che ha giocato la partita |
| 'data_partita' | DATETIME | NOT NULL | Data e ora in cui è stata giocata la partita |
| 'durata' | INT(11) | NOT NULL | Durata della partita espressa in secondi |
| 'esito' | VARCHAR(10) | NOT NULL | Esito della partita, che può essere vittoria oppure sconfitta |