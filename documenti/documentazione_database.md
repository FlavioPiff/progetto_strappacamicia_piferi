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