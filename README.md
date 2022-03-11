# Dispensario automatico di medicine - Progetto Ingegneria del software

## **Requisiti Informali**

Il sistema consiste in un applicazione che ha l'obiettivo di monitorare e aiutare pazienti anziani che hanno bisogno di assumere quantità precise e in maniera regolare di farmaci.
Il sistema dovrà notificare al paziente quando assumere i medicinali in base alla ricetta caricata sul server da parte del medico curante.
La notifica avviene tramite un sistema hardware composto da led, display, buzzers e vani contenenti medicinali che si apriranno automaticamente, o manualmente dal paziente oppure da un qualsiasi utente, tramite applicazione.
L'applicazione interagisce con un server che hai il compito di memorizzare la quantità e la frequenza riguardo le assunzioni dei medicinali.
Il sistema può interagire con una farmacia con lo scopo di prenotare i medicinali per il rifornimento.

Nello specifico, il sistema verrà usato da 4 tipologie di utenti. Ad ognuna di queste tipologie di utenti sono associate delle specifiche funzioni:

* Il **Medico**, dovrà essere in grado di accedere al database e di ricercare i pazienti in modo da associare ad essi una specifica ricetta. La ricetta può essere importata attraverso una foto o tramite un form da lui personalizzabile.

* Il **Familiare**, dovrà essere in grado di controllare il dispositivo **Hardware** per un eventuale rifornimento di medicinali, e nel caso prenotare i medicinali necessari da una farmacia, visualizzare lo storico delle assunzioni da parte del **Paziente** e controllare il quantitativo di medicinali rimanenti nell'apposito cassetto dell'**Hardware**.

* Il **Paziente**, viene notificato dal sistema **Hardware** ad ogni occorrenza dell'assunzione. Dopo l'assunzione il **Paziente** potrà notificare l'assunzione del medicinale tramite la chiusura del cassetto, attraverso un pulsante incluso nel sistema **Hardware**

* Il **Tecnico**, si occuperà della manutenzione non ordinaria dell'**Hardware**, come il blocco del sistema oppure un guasto. 


## **Specifica dei requisiti funzionali**

* **Medico**
    * Crea la ricetta tramite app
    * Aggiorna una ricetta esistente
* **Familiare**
    * Viene notificato del rifornimento dei medicinali dal sistema.
    * Può prenotare i medicinali presso una farmacia
* **Paziente**
    * Il paziente viene notificato dall' **Hardware** tramite suoni e luci.
    * Il paziente notifica l'assunzione chiudendo i cassetti.
* **Farmacia**
    * Riceve le prenotazioni dei medicinali
* **Tecnico**
    * Esegue la manutenzione, dell'**Hardware**, notificata dal sistema.
* **Hardware**
    * Notifica orario assunzione, tramite suoni e luci.
    * Gestisce l'apertura e la chiusura dei cassetti
    * Notifica le manutenzioni
    * Notifica gli eventuali rifornimenti


## **Specifica dei requisiti non funzionali**

Elenco dei requisiti non funzionali

* **Usabilità** : L'hardware dovrà essere dotato di dispositivi che rendono chiaro il medicinale da assumere cercando di garantire il minimo sforzo da parte dell'anziano. L'interfaccia utente dovrà essere il più possibile user-friendly per garantire un'esperienza fluida da parte dell'utente.    
* **Recovery** : Nel caso l'Hardware non abbia più accesso alla rete deve continuare a notificare l'anziano utilizzando i registri scaricati dall'ultimo update. 
* **Sicurezza** : Il sistema memorizzando dati sensibili quali le ricette prescritte dal medico piuttosto che le patologie del paziente, o le più comuni password, deve garantire un determinato livello di sicurezza per preservarli.
Quindi i dati di ogni singolo utente non devono essere salvati in chiaro ma dovranno essere cifrati attraverso un Secure Hash Algorithm, in particolare lo SHA-256.

*HTTP Server*: **nginx 1.10.3** <br>
*DBMS*: **PostgreSQL 10.15** <br> *Linguaggio lato server*: **PHP 5.6.0** <br>
*Sistema operativo server*: **GNU/Linux Debian 10.7.0** <br>
*Sistema operativo lato client*: **Android 7.0 o maggiore** / **iOS 10 o maggiore** <br>
*Piattaforma hardware*: **Architettura ARM 32bit**

## **Use cases diagram**

![use cases](UML/UseCaseDiagram1.jpg)

## **Scenari**

| Caso d'uso : Prendere medicine |
| :----------------------------- |
| **Attori**: Paziente, Hardware |
| **Precondizioni**  <ol><li>Il caso d'uso inizia quando l'orario è prossimo all'ora dell'assunzione del medicinale</ol>|
| **Sequenza degli eventi** <ol><li>Il paziente viene notificato dall'hardware</li><li>L'Hardware apre automaticamente il cassetto</li><li>Il paziente clicca il pulsante per la chiusura e notifica l'assunzione<li>L'Hardware chiude il cassetto</ol>|
| **Post condizioni** <ol><li> L'assunzione è stata registrata sul sistema</ol>|
| **Sequenza alternativa 1** <ol><li>Il paziente viene notificato dall'hardware<li>L'Hardware apre automaticamente il cassetto</li><li>Il paziente non clicca il pulsante per chiudere il cassetto e non notifica l'assunzione</ol>|
| **Post condizioni**  <ol><li>La non assunzione è stata registrata sul sistema</li><li>Il familiare viene notificato della non assunzione</ol>|
| **Sequenza alternativa 2** <ol><li>La medicina non è presente</li></ol>|
| **Post condizioni** <ol><li>La non assunzione è stata registrata sul sistema</li><li>Il familiare viene avvisato con una notifica di urgenza</ol>|


| Caso d'uso : Rifornimento medicinali |
| :----------- |
| **Attori**: Farmacia, Familiare, Hardware |
| **Precondizioni**  <ol><li>Notifica di manutenzione da parte dell'app</ol>|
| **Sequenza degli eventi** <ol><li>Il familiare apre il cassetto tramite app</li><li>Conferma il rifornimento dei medicinali tramite app</ol>|
| **Post condizioni** <ol><li> Aggiornamento inventario da parte del sistema</ol>|
| **Sequenza alternativa 1** <ol><li>Prenotazione medicinali</li><li>Il familiare apre il cassetto tramite app</li><li>Conferma il rifornimento dei medicinali tramite app</ol>|
| **Post condizioni**  <ol><li>Aggiornamento inventario da parte del sistema</ol>|

| Caso d'uso : Aggiunta di una ricetta medica | 
| :----------- |
|**Attori**: Medico, Familiare |
|**Precondizioni** <ol><li>Login nell'applicazione da parte del medico</ol> |
|**Sequenza degli eventi** <ol><li>Il dottore crea la ricetta</li><li>Il sistema carica la ricetta</li><li>Il sistema fa un controllo sull'inventario</li><li>Se necessario il sistema aggiorna l'inventario</li></ol>|
|**Post condizioni** <ol><li>Al familiare del paziente viene notificato il caricamento della ricetta</li><li>Il familiare decide se esportare la ricetta in pdf o mandarla via mail alla farmacia</li><li>Si passa al caso d'uso in cui viene effettuata la prenotazione dei medicinali</li></ol>|
|**Sequenza alternativa 1** <ol><li>Il dottore crea la ricetta</li><li>Il sistema carica la ricetta</li><li>Il sistema fa un controllo sull'inventario</li><li>Se necessario il sistema aggiorna l'inventario</li><li>il familiare non vede la notifica della ricetta</li></ol>|
|**Post condizioni** <ol><li>Al familiare viene ripetuta la notifica ogni 5 minuti finché non la visulizza</li><li>Il familiare decide se esportare la ricetta in pdf o mandarla via mail alla farmacia</li><li>Si passa al caso d'uso in cui viene effettuata la prenotazione dei medicinali</li></ol>|

## **Diagramma delle classi**

![DC](UML/ClassDiagram1.jpg)

## **Test di livello zero**
#### I Test di livello zero vengono effettuati sul prodotto finale per verificarne la corretta funzionalità e la corrispondenza di quanto richiesto dal committente. Tali test coincidono, generalmente, con i casi d'uso e quindi generalmete chi effettua questi test non ha bisogno di conoscere il codice che c'è dietro. 

| Test : Creazione/Aggiornamento di una ricetta | 
| :----------- |
| Il medico crea/aggiorna una ricetta |
| Risultato atteso : La nuova ricetta viene caricata correttamente sul server |

| Test : Assunzione dei medicinali non completa | 
| :----------- |
| Il paziente non assume tutti/o parte dei medicinali|
| Risultato atteso : Al familiare viene notificata la mancata assunzione del paziente. L'assunzione dei medicinali non verrà registrate finché non saranno assunti tutti i medicinali |

| Test : Rifornimento medicinali  | 
| :----------- |
| Il familiare ricarica l'inventario con tutti i medicinali mancanti |
| Risultato atteso : Al server viene notificato il corretto rifornimento dei medicinali ed al familiare arriva una notifica di conferma |

| Test : Rifornimento parziale dei medicinali | 
| :----------- |
| Il familiare dimentica qualche medicinale nella ricarica dell'inventario |
| Risultato atteso : Al server viene comunicata l'errato rifornimento e l'utente verrá notificato tramite applicazione |

| Test : Rifornimento errato di medicinali | 
| :----------- |
| Il familiare ricarica l'inventario con il medicinale sbagliato |
| Risultato atteso : L'hardware non apre i cassetti e l'utente verrá notificato tramite applicazione|

| Test : Manutenzione dell'hardware | 
| :----------- |
| L'hardware notifica una manutenzione |
| Risultato atteso : Uno dei tecnici disponibili viene notificato della necessaria manutenzione|

| Test : Medicinali mancanti da parte della farmacia per un rifornimento | 
| :----------- |
| Il familiare ha bisogno di medicinali che mancano alla farmacia che ha come preferita |
| Risultato atteso : Viene mostrato un elenco delle farmacie più vicine che hanno disponibile quel medicinale |

## **Sequence diagram**

### *Rifornimento medicinali*

![sd rifornimento medicinale](UML/Rifornimentomedicinali.jpg)

## **Diagramma delle classi di secondo livello**

![CD2](UML/ClassDiagram2.jpg)

## **ER Diagram**

![erd](UML/ERDDiagram1.jpg)

## **Component Diagram**

![compd](UML/ComponentDiagram1.jpg)

