/**
 * 1. ARCHIVIO COMUNICATI
 * Per aggiungere un nuovo comunicato, incollalo IN CIMA a questa lista.
 */
const comunicati = [
  /*{
    id: "3",
    titolo: "COMUNICATO UFFICIALE: LA MIA PIDANZATA ",
    estratto: "Il Raspu Team commenta le mosse di riparazione, saluta Cuffy, Casadei e Cutrone e accoglie Lulli, Nico Gonzalez e Gnonto...",
    testo: `
      <p></p>
      <br>
      <p></p>
      <br>
      <p></p>
      <br>
      <p></p>
      <br>
      <p></p>
      <br>
      <p><i>Il presidente</i></p>
      <p><i>Carlo Maria Piccolo</i></p>
    `,
    data: "4 Settembre 2026 • 00:45"
  },*/

  /*
  //Comunicato scherzoso, per la mia fidanzata
  {
    id: "3",
    titolo: "COMUNICATO UFFICIALE: LA MIA PIDANZATA È LA PIÙ BELLA DEL MONDO",
    estratto: "Il Raspu Team vuole togliere ogni dubbio, e affermare che la sua pidanzata...",
    testo: `
      <p>Il RASPU TEAM vuole togliere ogni dubbio, e affermare che la sua pidanzata è la più bella del mondo.</p>
      <br>
      <p>Oggi, come ieri e come sarà per sempre, è importante ricordare che Tina Ghidoni è la miglior fidanzata del mondo, nonchè la più bella.</p>
      <br>
      <p>Questo comunicato è rivolto a tutti i tifosi del Raspu Team, che condividono la stessa passione e il medesimo orgoglio per la nostra squadra e per la mia pidanzata con la pisellina storta.</p>
      <br>
      <p>Inoltre vogliamo raggiungere ogni donna per far capire che io sono occupato e di proprietà di Tina Ghidoni.</p>
      <br>
      <p>Ti amo tanto pisellina! Sei speciale e unica! E RICORDA PER CHE SQUADRA TIFI (scusami ancora per Malen...)</p>
      <br>
      <p><i>Il presidente</i></p>
      <p><i>Carlo Maria Piccolo</i></p>
    `,
    data: "5 Settembre 2026 • 14:45"
  },*/

  {
    id: "2",
    titolo: "COMUNICATO UFFICIALE: ASTA DI RIPARAZIONE",
    estratto: "Il Raspu Team commenta le mosse di riparazione, saluta Cuffy, Casadei e Cutrone e accoglie Lulli, Nico Gonzalez e Gnonto...",
    testo: `
      <p>Il Raspu Team FC interviene pubblicamente per esprimere il proprio sconcerto di fronte ad alcune mosse a dir poco terribili registrate in questa sessione di riparazione.</p>
      <br>
      <p>La società si augura vivamente che gli altri presidenti e allenatori possano ritrovare il senno e un minimo di lucidità da qui fino a gennaio, evitando ulteriori scempi calcistici.</p>
      <br>
      <p>Ci teniamo inoltre a ringraziare di cuore <b>Norton-Cuffy</b>, <b>Casadei</b> e <b>Cutrone</b> per l'impegno e la dedizione mostrati in queste prime due giornate, augurando loro il meglio per il prosieguo della carriera.</p>
      <br>
      <p>Al contempo, diamo un caloroso benvenuto ai nuovi acquisti <b>Lulli</b>, <b>Nico Gonzalez</b> e <b>Gnonto</b>, pronti a dare battaglia con la nostra maglia.</p>
      <br>
      <p>Si ricorda infine che il club resta aperto e disponibile per valutare eventuali scambi e trattative con chiunque voglia intavolare un discorso serio.</p>
      <br>
      <p><i>Il presidente</i></p>
      <p><i>Carlo Maria Piccolo</i></p>
    `,
    data: "4 Settembre 2026 • 00:45"
  },
  {
    id: "1",
    titolo: "LANCIO DEL SITO WEB UFFICIALE",
    estratto: "Il Raspu Team è lieto di annunciare il lancio del suo sito web ufficiale...",
    testo: `
      <p>Il Raspu Team è lieto di annunciare il lancio del suo sito web ufficiale, che rappresenta un nuovo passo nell'evoluzione della società e nella comunicazione con i propri tifosi.</p>
      <br>
      <p>Il nuovo sito offre un'esperienza utente migliorata e mette a disposizione informazioni aggiornate sulle attività della società, i risultati delle partite e le ultime notizie del mondo del calcio.</p>
      <br>
      <p><i>Il presidente</i></p>
      <p><i>Carlo Maria Piccolo</i></p>
    `,
    data: "3 Settembre 2026 • 20:30"
  }
];

/**
 * 2. CALENDARIO COMPLETO SERIE A (Date ufficiali da documento)
 */
const calendarioRaspu = [
  { giornata: "1ª Giornata", casa: "RASPU TEAM", fuori: "Lecce Bombo", risultato: "3-2", dataLimite: "2026-08-23" },
  { giornata: "2ª Giornata", casa: "LSB", fuori: "RASPU TEAM", risultato: "4-3", dataLimite: "2026-08-30" },
  { giornata: "3ª Giornata", casa: "Real Madrink", fuori: "RASPU TEAM", risultato: "-", dataLimite: "2026-09-07" },
  { giornata: "4ª Giornata", casa: "RASPU TEAM", fuori: "VIRTUAL PONTE", risultato: "-", dataLimite: "2026-09-14" },
  { giornata: "5ª Giornata", casa: "KDA Commando", fuori: "RASPU TEAM", risultato: "-", dataLimite: "2026-09-20" },
  { giornata: "6ª Giornata", casa: "RASPU TEAM", fuori: "One Pisa", risultato: "-", dataLimite: "2026-10-12" },
  { giornata: "7ª Giornata", casa: "Nu Genoa", fuori: "RASPU TEAM", risultato: "-", dataLimite: "2026-10-19" },
  { giornata: "8ª Giornata", casa: "RASPU TEAM", fuori: "Real Madrink", risultato: "-", dataLimite: "2026-10-25" },
  { giornata: "9ª Giornata", casa: "VIRTUAL PONTE", fuori: "RASPU TEAM", risultato: "-", dataLimite: "2026-10-29" },
  { giornata: "10ª Giornata", casa: "RASPU TEAM", fuori: "Nu Genoa", risultato: "-", dataLimite: "2026-11-02" },
  { giornata: "11ª Giornata", casa: "One Pisa", fuori: "RASPU TEAM", risultato: "-", dataLimite: "2026-11-08" },
  { giornata: "12ª Giornata", casa: "RASPU TEAM", fuori: "KDA Commando", risultato: "-", dataLimite: "2026-11-23" },
  { giornata: "13ª Giornata", casa: "RASPU TEAM", fuori: "LSB", risultato: "-", dataLimite: "2026-11-29" },
  { giornata: "14ª Giornata", casa: "Lecce Bombo", fuori: "RASPU TEAM", risultato: "-", dataLimite: "2026-12-06" },
  { giornata: "15ª Giornata", casa: "RASPU TEAM", fuori: "LSB", risultato: "-", dataLimite: "2026-12-13" },
  { giornata: "16ª Giornata", casa: "Lecce Bombo", fuori: "RASPU TEAM", risultato: "-", dataLimite: "2026-12-20" },
  { giornata: "17ª Giornata", casa: "RASPU TEAM", fuori: "KDA Commando", risultato: "-", dataLimite: "2027-01-03" },
  { giornata: "18ª Giornata", casa: "Nu Genoa", fuori: "RASPU TEAM", risultato: "-", dataLimite: "2027-01-06" },
  { giornata: "19ª Giornata", casa: "RASPU TEAM", fuori: "Real Madrink", risultato: "-", dataLimite: "2027-01-10" },
  { giornata: "20ª Giornata", casa: "RASPU TEAM", fuori: "VIRTUAL PONTE", risultato: "-", dataLimite: "2027-01-17" },
  { giornata: "21ª Giornata", casa: "One Pisa", fuori: "RASPU TEAM", risultato: "-", dataLimite: "2027-01-24" },
  { giornata: "22ª Giornata", casa: "KDA Commando", fuori: "RASPU TEAM", risultato: "-", dataLimite: "2027-01-31" },
  { giornata: "23ª Giornata", casa: "RASPU TEAM", fuori: "Nu Genoa", risultato: "-", dataLimite: "2027-02-07" },
  { giornata: "24ª Giornata", casa: "VIRTUAL PONTE", fuori: "RASPU TEAM", risultato: "-", dataLimite: "2027-02-14" },
  { giornata: "25ª Giornata", casa: "Real Madrink", fuori: "RASPU TEAM", risultato: "-", dataLimite: "2027-02-21" },
  { giornata: "26ª Giornata", casa: "RASPU TEAM", fuori: "Lecce Bombo", risultato: "-", dataLimite: "2027-02-28" },
  { giornata: "27ª Giornata", casa: "LSB", fuori: "RASPU TEAM", risultato: "-", dataLimite: "2027-03-07" },
  { giornata: "28ª Giornata", casa: "RASPU TEAM", fuori: "One Pisa", risultato: "-", dataLimite: "2027-03-14" },
  { giornata: "29ª Giornata", casa: "Real Madrink", fuori: "RASPU TEAM", risultato: "-", dataLimite: "2027-03-21" },
  { giornata: "30ª Giornata", casa: "RASPU TEAM", fuori: "LSB", risultato: "-", dataLimite: "2027-04-04" },
  { giornata: "31ª Giornata", casa: "RASPU TEAM", fuori: "VIRTUAL PONTE", risultato: "-", dataLimite: "2027-04-11" },
  { giornata: "32ª Giornata", casa: "Nu Genoa", fuori: "RASPU TEAM", risultato: "-", dataLimite: "2027-04-18" },
  { giornata: "33ª Giornata", casa: "RASPU TEAM", fuori: "KDA Commando", risultato: "-", dataLimite: "2027-04-25" },
  { giornata: "34ª Giornata", casa: "Lecce Bombo", fuori: "RASPU TEAM", risultato: "-", dataLimite: "2027-05-02" },
  { giornata: "35ª Giornata", casa: "RASPU TEAM", fuori: "One Pisa", risultato: "-", dataLimite: "2027-05-09" },
  { giornata: "36ª Giornata", casa: "RASPU TEAM", fuori: "Nu Genoa", risultato: "-", dataLimite: "2027-05-16" },
  { giornata: "37ª Giornata", casa: "LSB", fuori: "RASPU TEAM", risultato: "-", dataLimite: "2027-05-23" },
  { giornata: "38ª Giornata", casa: "KDA Commando", fuori: "RASPU TEAM", risultato: "-", dataLimite: "2027-05-30" }
];

/**
 * 3. FUNZIONI LOGICHE
 */

// Aggiorna il widget del match in Home
function aggiornaWidgetMatch() {
  const oggi = new Date();
  
  let indexCorrente = calendarioRaspu.findIndex(m => new Date(m.dataLimite + "T23:59:59") >= oggi);

  if (indexCorrente === -1) {
    indexCorrente = calendarioRaspu.length - 1;
  }

  const matchCorrente = calendarioRaspu[indexCorrente];
  const matchPrecedente = indexCorrente > 0 ? calendarioRaspu[indexCorrente - 1] : null;

  const elemTitolo = document.getElementById("giornata-titolo");
  const elemCasa = document.querySelector(".team-home");
  const elemFuori = document.querySelector(".team-away");
  const elemData = document.getElementById("match-data");

  if (elemTitolo) elemTitolo.textContent = matchCorrente.giornata;
  if (elemCasa) elemCasa.textContent = matchCorrente.casa.toUpperCase();
  if (elemFuori) elemFuori.textContent = matchCorrente.fuori.toUpperCase();

  if (elemData) {
    if (matchPrecedente && matchPrecedente.risultato && matchPrecedente.risultato !== "-") {
      elemData.textContent = `Ultimo turno: ${matchPrecedente.casa} ${matchPrecedente.risultato} ${matchPrecedente.fuori}`;
    } else {
      const eInCasa = matchCorrente.casa.toUpperCase() === "RASPU TEAM";
      elemData.textContent = eInCasa ? "Partita in Casa" : "Partita in Trasferta";
    }
  }
}

// Carica l'ultimo comunicato nella Home Page
function caricaUltimoComunicatoHome() {
  const elemTitolo = document.getElementById("home-comunicato-titolo");
  const elemEstratto = document.getElementById("home-comunicato-estratto");
  const elemLink = document.getElementById("home-comunicato-link");
  const elemData = document.getElementById("home-comunicato-data");

  if (elemTitolo && comunicati.length > 0) {
    const ultimo = comunicati[0];
    elemTitolo.textContent = ultimo.titolo;
    elemEstratto.textContent = ultimo.estratto;
    elemLink.href = `comunicato.html?id=${ultimo.id}`;
    elemData.textContent = ultimo.data;
  }
}

// Carica l'elenco dei comunicati (in comunicazioni.html)
function caricaListaComunicati() {
  const container = document.getElementById("lista-comunicati");
  if (!container) return;

  container.innerHTML = "";
  comunicati.forEach(c => {
    const html = `
      <article class="card-sidebar" style="padding: 15px;">
        <small style="color: var(--amaranto); font-weight: bold;">COMUNICATO N. ${c.id} • ${c.data}</small>
        <h3 style="margin: 5px 0 10px 0;">${c.titolo}</h3>
        <p style="font-weight: normal; margin-bottom: 10px;">${c.estratto}</p>
        <a href="comunicato.html?id=${c.id}" class="read-more">Leggi il comunicato completo →</a>
      </article>
    `;
    container.innerHTML += html;
  });
}

// Carica il singolo comunicato (in comunicato.html)
function caricaSingoloComunicato() {
  const elemTitolo = document.getElementById("comunicato-titolo");
  const elemData = document.getElementById("comunicato-data");
  const elemTesto = document.getElementById("comunicato-testo");

  if (!elemTitolo) return;

  const params = new URLSearchParams(window.location.search);
  const id = params.get('id') || "1";
  const articolo = comunicati.find(c => c.id === id) || comunicati[0];

  elemTitolo.innerHTML = articolo.titolo;
  elemData.textContent = `Pubblicato il ${articolo.data}`;
  elemTesto.innerHTML = articolo.testo;
}

/**
 * 4. AVVIO AUTOMATICO ALLA CARICA DELLA PAGINA
 */
document.addEventListener("DOMContentLoaded", () => {
  aggiornaWidgetMatch();
  caricaUltimoComunicatoHome();
  caricaListaComunicati();
  caricaSingoloComunicato();
});