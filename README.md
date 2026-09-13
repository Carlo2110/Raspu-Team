# Raspu Team - Sito Ufficiale 🏆

Sito web ufficiale del **Raspu Team**, la squadra di fantacalcio gestita da Carlo Maria Piccolo, militante nella prestigiosa lega *Lega Terronica*. 

Questo repository ospita il codice sorgente della web application sviluppata per gestire il calendario della squadra, la rosa ufficiale, i trofei conquistati in bacheca e il sistema di comunicazioni ufficiali della dirigenza.

---

## 🛠️ Stack Tecnologico e Architettura

Il sito è progettato con un'architettura leggera e modulare, basata su PHP e JavaScript vanilla, senza l'utilizzo di framework pesanti o database complessi (i dati dinamici vengono gestiti tramite strutture JSON).

* **Frontend:** HTML5, CSS3 personalizzato (struttura responsive, layout a griglia).
* **Backend:** PHP (per la gestione dinamica delle pagine, inclusione dei componenti e lettura dei file di dati).
* **Logica Client-Side:** JavaScript (per la gestione del widget dinamico del calendario/prossimo match e calcoli temporali).
* **Persistenza dati:** File JSON (`comunicati.json`) per la gestione dei comunicati ufficiali in modo dinamico.

---

## 📂 Struttura del Progetto

* `index.php` — Homepage del sito, con widget del prossimo match, ultimo comunicato e accesso rapido al palmarès e alla rosa.
* `comunicato.php` — Pagina di visualizzazione del singolo comunicato ufficiale.
* `comunicazioni.php` — Archivio completo di tutti i comunicati emessi dalla società.
* `palmares.php` — Bacheca trofei e storico dei successi del Raspu Team.
* `rosa_2026-27.php` — Presentazione della rosa ufficiale e dell'11 titolare per la stagione corrente.
* `script.js` — Logica JavaScript (gestione del calendario ufficiale di Serie A/fantacalcio e aggiornamento automatico del match widget).
* `style.css` — Foglio di stile principale del sito.
* `comunicati.json` — Database in formato JSON contenente lo storico dei comunicati ufficiali.
* `header.php` — Componente PHP condiviso per la barra di navigazione superiore.

---

## 🏅 Palmarès di Rilievo

* **🏆 Coppa Italia** (Stagione 2025/2026)

---

## 🚀 Avvio Locale

Essendo un progetto basato su PHP, per testarlo in locale è sufficiente un server di sviluppo leggero (come Apache/Nginx, il server integrato di PHP o l'estensione PHP Server per VS Code):

1. Clona la repository:
   ```bash
   git clone [https://github.com/Carlo2110/raspu-team.git](https://github.com/Carlo2110/raspu-team.git)
