<?php
session_start();

// Sicurezza: se non sei loggato come presidente, via da qui
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

$jsonFile = 'partite.json';
$successoAction = false; // Flag per capire se mostrare il pop-up di successo

if (!file_exists($jsonFile)) {
    die("Errore critico: il file partite.json non esiste.");
}

$dataJson = file_get_contents($jsonFile);
$partite = json_decode($dataJson, true);

// Trova la giornata attualmente attiva
$indiceAttivo = null;
foreach ($partite as $index => $giornata) {
    if ($giornata['stato'] === 'attiva') {
        $indiceAttivo = $index;
        break;
    }
}

// Gestione dell'invio del form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $azione = $_POST['azione'] ?? '';

    if ($indiceAttivo !== null) {
        if ($azione === 'concludi') {
            $golCasa = trim($_POST['gol_casa'] ?? '');
            $golOspiti = trim($_POST['gol_ospiti'] ?? '');

            if ($golCasa !== '' && $golOspiti !== '' && is_numeric($golCasa) && is_numeric($golOspiti)) {
                $partite[$indiceAttivo]['risultato'] = $golCasa . '-' . $golOspiti;
                $partite[$indiceAttivo]['stato'] = 'conclusa';

                if (isset($partite[$indiceAttivo + 1])) {
                    $partite[$indiceAttivo + 1]['stato'] = 'attiva';
                }

                file_put_contents($jsonFile, json_encode($partite, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
                $successoAction = true; // Attiva il pop-up di successo
            }
        } elseif ($azione === 'rimanda') {
            $partite[$indiceAttivo]['risultato'] = 'RIMANDATA';
            $partite[$indiceAttivo]['stato'] = 'rimandata';

            if (isset($partite[$indiceAttivo + 1])) {
                $partite[$indiceAttivo + 1]['stato'] = 'attiva';
            }

            file_put_contents($jsonFile, json_encode($partite, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            $successoAction = true; // Attiva il pop-up di successo
        }
    }
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestione Partite - Raspu Team</title>
  <link rel="stylesheet" href="style.css">
  <style>
    .gestione-container {
      max-width: 600px;
      margin: 40px auto;
      background: #fff;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      color: #333;
    }
    .gestione-container h2 {
      margin-bottom: 20px;
      color: #8B0000;
      border-bottom: 2px solid #d4af37;
      padding-bottom: 10px;
    }
    .match-box-active {
      background: #f9f4f0;
      border: 1px solid #d4c5b9;
      padding: 20px;
      border-radius: 6px;
      margin-bottom: 20px;
    }
    .form-group {
      margin-bottom: 15px;
    }
    .form-group label {
      display: block;
      font-weight: bold;
      margin-bottom: 5px;
    }
    .punteggio-inputs {
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .punteggio-inputs input {
      width: 70px;
      padding: 8px;
      text-align: center;
      font-size: 18px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    .btn-salva {
      background: #28a745;
      color: white;
      border: none;
      padding: 10px 20px;
      font-size: 16px;
      font-weight: bold;
      border-radius: 4px;
      cursor: pointer;
    }
    .btn-salva:hover { background: #218838; }
    .btn-rinvia {
      background: #dc3545;
      color: white;
      border: none;
      padding: 10px 20px;
      font-size: 16px;
      font-weight: bold;
      border-radius: 4px;
      cursor: pointer;
      margin-left: 10px;
    }
    .btn-rinvia:hover { background: #c82333; }
    .btn-ritorno {
      display: inline-block;
      margin-top: 20px;
      color: #8B0000;
      font-weight: bold;
      text-decoration: none;
    }
    .btn-ritorno:hover { text-decoration: underline; }

    /* Stili Modale Personalizzato */
    .modal-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.7);
      display: flex;
      justify-content: center;
      align-items: center;
      z-index: 1000;
    }
    .modal-box {
      background: var(--bianco-sporco, #f4eee1);
      color: #000;
      padding: 30px;
      border-radius: 8px;
      max-width: 450px;
      width: 90%;
      text-align: center;
      box-shadow: 0 5px 20px rgba(0,0,0,0.5);
      border: 2px solid var(--amaranto, #6b1d1d);
    }
    .modal-box h3 {
      color: var(--amaranto, #6b1d1d);
      margin-top: 0;
      margin-bottom: 15px;
    }
    .modal-box p {
      margin-bottom: 0;
      font-size: 1rem;
      line-height: 1.5;
    }
    .modal-buttons {
      display: flex;
      justify-content: center;
      gap: 15px;
    }
    .btn-modal-annulla {
      background-color: #666;
      color: #fff;
      border: none;
      padding: 8px 16px;
      border-radius: 4px;
      font-weight: bold;
      cursor: pointer;
    }
    .btn-modal-annulla:hover {
      background-color: #444;
    }
    .btn-modal-conferma {
      background-color: var(--amaranto, #6b1d1d);
      color: #fff;
      border: none;
      padding: 8px 16px;
      border-radius: 4px;
      font-weight: bold;
      cursor: pointer;
    }
    .btn-modal-conferma:hover {
      background-color: #440f0f;
    }
  </style>
</head>
<body>

  <?php include 'header.php'; ?>

  <div class="gestione-container">
    <h2>Gestione Risultati Campionato</h2>

    <?php if ($indiceAttivo !== null): ?>
      <?php $match = $partite[$indiceAttivo]; ?>
      <div class="match-box-active">
        <h3><?php echo htmlspecialchars($match['giornata']); ?></h3>
        <p><strong>Incontro:</strong> <?php echo htmlspecialchars($match['casa']); ?> vs <?php echo htmlspecialchars($match['fuori']); ?></p>

        <form id="formGestione" method="POST" style="margin-top: 20px;">
          <input type="hidden" name="azione" id="inputAzione" value="">
          
          <div class="form-group">
            <label>Inserisci Risultato Finale:</label>
            <div class="punteggio-inputs">
              <span><?php echo htmlspecialchars($match['casa']); ?></span>
              <input type="number" id="golCasa" name="gol_casa" min="0">
              <span>-</span>
              <input type="number" id="golOspiti" name="gol_ospiti" min="0">
              <span><?php echo htmlspecialchars($match['fuori']); ?></span>
            </div>
          </div>

          <div style="margin-top: 20px;">
            <button type="button" id="btnApriSalva" class="btn-salva">Salva Risultato & Avanza</button>
            <button type="button" id="btnApriRinvia" class="btn-rinvia">Segna come Rimandata</button>
          </div>
        </form>
      </div>
    <?php else: ?>
      <p style="font-style: italic; color: #666;">Tutte le partite del calendario risultano concluse o non ci sono match attivi al momento.</p>
    <?php endif; ?>

    <a href="index.php" class="btn-ritorno">← Torna alla Home</a>
  </div>

  <!-- MODALE UNICA DI CONFERMA / AVVISO -->
  <div id="modalConferma" class="modal-overlay" style="display: none;">
    <div class="modal-box">
      <h3 id="modalTitolo">CONFERMA</h3>
      <p id="modalTesto">Sei sicuro di procedere?</p>
      <div class="modal-buttons" id="modalButtonsContainer" style="margin-top: 25px;">
        <button type="button" id="btnAnnullaModale" class="btn-modal-annulla">Annulla</button>
        <button type="button" id="btnConfermaModale" class="btn-modal-conferma">Conferma</button>
      </div>
    </div>
  </div>

  <!-- MODALE DI SUCCESSO (AUTOMATICA DOPO IL SALVATAGGIO) -->
  <div id="modalSuccesso" class="modal-overlay" style="display: <?php echo $successoAction ? 'flex' : 'none'; ?>;">
    <div class="modal-box">
      <h3 style="color: #28a745;">SUCCESSO!</h3>
      <p>Modifica salvata con successo. Reindirizzamento in corso...</p>
    </div>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const modal = document.getElementById('modalConferma');
      const modalTitolo = document.getElementById('modalTitolo');
      const modalTesto = document.getElementById('modalTesto');
      const btnAnnulla = document.getElementById('btnAnnullaModale');
      const btnConferma = document.getElementById('btnConfermaModale');
      const buttonsContainer = document.getElementById('modalButtonsContainer');
      
      const btnSalva = document.getElementById('btnApriSalva');
      const btnRinvia = document.getElementById('btnApriRinvia');
      const form = document.getElementById('formGestione');
      const inputAzione = document.getElementById('inputAzione');

      // Se PHP ha salvato con successo, aspetta esattamente 2 secondi prima del reindirizzamento
      const isSuccess = <?php echo $successoAction ? 'true' : 'false'; ?>;
      if (isSuccess) {
        setTimeout(function() {
          window.location.href = 'index.php';
        }, 2000);
      }

      if (btnSalva && modal) {
        btnSalva.addEventListener('click', function() {
          const golC = document.getElementById('golCasa').value.trim();
          const golO = document.getElementById('golOspiti').value.trim();

          if (golC === '' || golO === '' || isNaN(golC) || isNaN(golO)) {
            modalTitolo.textContent = "ATTENZIONE";
            modalTesto.textContent = "Inserisci dei punteggi numerici validi in entrambi i campi prima di procedere al salvataggio.";
            btnAnnulla.style.display = 'none';
            btnConferma.textContent = "Ho capito";
            
            btnConferma.onclick = function() {
              modal.style.display = 'none';
              btnAnnulla.style.display = 'inline-block';
              btnConferma.textContent = "Conferma";
              btnConferma.onclick = function() { form.submit(); };
            };
            
            modal.style.display = 'flex';
            return;
          }

          inputAzione.name = 'azione';
          inputAzione.value = 'concludi';

          modalTitolo.textContent = "CONFERMA RISULTATO";
          modalTesto.textContent = "Sei sicuro di voler salvare questo risultato e far avanzare automaticamente il calendario?";
          btnAnnulla.style.display = 'inline-block';
          btnConferma.textContent = "Conferma";
          btnConferma.onclick = function() { form.submit(); };
          modal.style.display = 'flex';
        });
      }

      if (btnRinvia && modal) {
        btnRinvia.addEventListener('click', function() {
          inputAzione.name = 'azione';
          inputAzione.value = 'rimanda';

          modalTitolo.textContent = "CONFERMA RINVIO";
          modalTesto.textContent = "Sei sicuro di voler segnare questa partita come rimandata e far avanzare il calendario?";
          btnAnnulla.style.display = 'inline-block';
          btnConferma.textContent = "Conferma";
          btnConferma.onclick = function() { form.submit(); };
          modal.style.display = 'flex';
        });
      }

      if (btnAnnulla && modal) {
        btnAnnulla.addEventListener('click', function() {
          modal.style.display = 'none';
        });
      }

      window.addEventListener('click', function(e) {
        if (e.target === modal) {
          modal.style.display = 'none';
          btnAnnulla.style.display = 'inline-block';
          btnConferma.textContent = "Conferma";
          btnConferma.onclick = function() { form.submit(); };
        }
      });
    });
  </script>
</body>
</html>