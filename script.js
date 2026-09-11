/**
 * 1. ARCHIVIO COMUNICATI E PARTITE (Caricati da file JSON esterni)
 */
let comunicati = [];
let calendarioRaspu = [];

async function caricaDatiDaJson() {
  try {
    // Carichiamo in parallelo o sequenza i dati
    const [resComunicati, resPartite] = await Promise.all([
      fetch('comunicati.json'),
      fetch('partite.json')
    ]);

    if (!resComunicati.ok || !resPartite.ok) throw new Error('Errore nel caricamento dei file JSON');
    
    comunicati = await resComunicati.json();
    calendarioRaspu = await resPartite.json();

    // Avviamo le funzioni dipendenti
    aggiornaWidgetMatch();
    caricaUltimoComunicatoHome();
    caricaListaComunicati();
    caricaSingoloComunicato();
  } catch (error) {
    console.error("Impossibile caricare i dati JSON:", error);
  }
}

/**
 * 2. LOGICA WIDGET MATCH (Basata sullo stato gestito manualmente)
 */
function aggiornaWidgetMatch() {
  if (calendarioRaspu.length === 0) return;

  // Cerchiamo la giornata attiva
  let indexCorrente = calendarioRaspu.findIndex(m => m.stato === "attiva");
  
  // Fallback di sicurezza se non trova "attiva", prende l'ultima o la prima
  if (indexCorrente === -1) indexCorrente = 0;

  const matchCorrente = calendarioRaspu[indexCorrente];
  
  // Cerchiamo l'ultimo match concluso o rimandato immediatamente precedente a questo
  let matchPrecedente = null;
  for (let i = indexCorrente - 1; i >= 0; i--) {
    if (calendarioRaspu[i].stato === "conclusa" || calendarioRaspu[i].stato === "rimandata") {
      matchPrecedente = calendarioRaspu[i];
      break;
    }
  }

  const elemTitolo = document.getElementById("giornata-titolo");
  const elemCasa = document.querySelector(".team-home");
  const elemFuori = document.querySelector(".team-away");
  const elemData = document.getElementById("match-data");

  if (elemTitolo) elemTitolo.textContent = matchCorrente.giornata;
  if (elemCasa) elemCasa.textContent = matchCorrente.casa.toUpperCase();
  if (elemFuori) elemFuori.textContent = matchCorrente.fuori.toUpperCase();

  if (elemData) {
    if (matchPrecedente) {
      if (matchPrecedente.stato === "rimandata") {
        // Se la partita precedente risulta rimandata
        elemData.textContent = `Ultimo turno: ${matchPrecedente.casa} - ${matchPrecedente.fuori} non calcolata`;
      } else if (matchPrecedente.risultato && matchPrecedente.risultato !== "-") {
        // Caso normale con l'ultimo risultato concluso
        elemData.textContent = `Ultimo turno: ${matchPrecedente.casa} ${matchPrecedente.risultato} ${matchPrecedente.fuori}`;
      } else {
        elemData.textContent = `Ultimo turno: ${matchPrecedente.casa} - ${matchPrecedente.fuori}`;
      }
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
  
  const pubblicati = comunicati.filter(c => c.id !== "0");
  const articolo = comunicati.find(c => c.id === id) || pubblicati[0] || comunicati[0];

  elemTitolo.innerHTML = articolo.titolo;
  elemData.textContent = `Pubblicato il ${articolo.data}`;
  elemTesto.innerHTML = articolo.testo;
}

/**
 * 3. AVVIO AUTOMATICO ALLA CARICA DELLA PAGINA
 */
document.addEventListener("DOMContentLoaded", () => {
  caricaDatiDaJson();
});