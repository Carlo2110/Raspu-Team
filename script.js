/**
 * 1. ARCHIVIO COMUNICATI (Caricato da file JSON esterno)
 */
let comunicati = [];

async function caricaComunicatiDaJson() {
  try {
    const response = await fetch('comunicati.json');
    if (!response.ok) throw new Error('Errore nel caricamento del file JSON');
    const dati = await response.json();
    
    // Filtriamo i comunicati escludendo l'id "0" per la pubblicazione pubblica,
    // ma tenendo l'array completo o filtrato a seconda delle necessità.
    // Qui filtriamo per mostrare solo dall'1 in poi nelle viste pubbliche.
    comunicati = dati;

    // Una volta caricati i dati, avviamo le funzioni dipendenti
    aggiornaWidgetMatch();
    caricaUltimoComunicatoHome();
    caricaListaComunicati();
    caricaSingoloComunicato();
  } catch (error) {
    console.error("Impossibile caricare i comunicati:", error);
  }
}

/**
 * 2. CALENDARIO COMPLETO SERIE A (Date ufficiali da documento)
 */
const calendarioRaspu = [
  { giornata: "1ª Giornata", casa: "RASPU TEAM", fuori: "Lecce Bombo", risultato: "3-2", dataLimite: "2026-08-23" },
  { giornata: "2ª Giornata", casa: "LSB", fuori: "RASPU TEAM", risultato: "4-3", dataLimite: "2026-08-30" },
  { giornata: "3ª Giornata", casa: "Real Madrink", fuori: "RASPU TEAM", risultato: "3-3", dataLimite: "2026-09-07" },
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

function caricaUltimoComunicatoHome() {
  const elemTitolo = document.getElementById("home-comunicato-titolo");
  const elemEstratto = document.getElementById("home-comunicato-estratto");
  const elemLink = document.getElementById("home-comunicato-link");
  const elemData = document.getElementById("home-comunicato-data");

  // Filtriamo i pubblicabili (id > "0")
  const pubblicati = comunicati.filter(c => c.id !== "0");

  if (elemTitolo && pubblicati.length > 0) {
    const ultimo = pubblicati[0];
    elemTitolo.textContent = ultimo.titolo;
    elemEstratto.textContent = ultimo.estratto;
    elemLink.href = `comunicato.php?id=${ultimo.id}`;
    elemData.textContent = ultimo.data;
  }
}

function caricaListaComunicati() {
  const container = document.getElementById("lista-comunicati");
  if (!container) return;

  container.innerHTML = "";
  // Filtriamo i pubblicabili (id > "0")
  const pubblicati = comunicati.filter(c => c.id !== "0");

  pubblicati.forEach(c => {
    const html = `
      <article class="card-sidebar" style="padding: 15px;">
        <small style="color: var(--amaranto); font-weight: bold;">COMUNICATO N. ${c.id} • ${c.data}</small>
        <h3 style="margin: 5px 0 10px 0;">${c.titolo}</h3>
        <p style="font-weight: normal; margin-bottom: 10px;">${c.estratto}</p>
        <a href="comunicato.php?id=${c.id}" class="read-more">Leggi il comunicato completo →</a>
      </article>
    `;
    container.innerHTML += html;
  });
}

function caricaSingoloComunicato() {
  const elemTitolo = document.getElementById("comunicato-titolo");
  const elemData = document.getElementById("comunicato-data");
  const elemTesto = document.getElementById("comunicato-testo");

  if (!elemTitolo) return;

  const params = new URLSearchParams(window.location.search);
  const id = params.get('id') || "1";
  
  // Cerchiamo nell'elenco generale (se qualcuno avesse il link diretto, altrimenti fallback sul primo pubblicabile)
  const pubblicati = comunicati.filter(c => c.id !== "0");
  const articolo = comunicati.find(c => c.id === id) || pubblicati[0] || comunicati[0];

  elemTitolo.innerHTML = articolo.titolo;
  elemData.textContent = `Pubblicato il ${articolo.data}`;
  elemTesto.innerHTML = articolo.testo;
}

/**
 * 4. AVVIO AUTOMATICO ALLA CARICA DELLA PAGINA
 */
document.addEventListener("DOMContentLoaded", () => {
  caricaComunicatiDaJson();
});