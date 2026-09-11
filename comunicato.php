<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$isLogged = isset($_SESSION['user']);
?>
<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Comunicato Ufficiale - Raspu Team</title>
  <link rel="stylesheet" href="style.css">
  <style>
    .comunicato-top-bar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 15px;
    }
    .link-indietro {
      color: var(--amaranto, #6b1d1d);
      text-decoration: none;
      font-weight: bold;
      transition: opacity 0.2s;
    }
    .link-indietro:hover {
      opacity: 0.8;
      text-decoration: underline;
    }
    .admin-buttons {
      display: flex;
      gap: 10px;
    }
    .btn-modifica, .btn-elimina {
      padding: 6px 12px;
      font-size: 0.85rem;
      font-weight: bold;
      border-radius: 4px;
      text-decoration: none;
      border: 1px solid;
      cursor: pointer;
    }
    .btn-modifica {
      background-color: #f4eee1;
      color: #6b1d1d;
      border-color: #6b1d1d;
    }
    .btn-modifica:hover {
      background-color: #e5b338;
      color: #000;
    }
    .btn-elimina {
      background-color: #6b1d1d;
      color: #fff;
      border-color: #551414;
    }
    .btn-elimina:hover {
      background-color: #440f0f;
    }
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
      margin-bottom: 25px;
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
      text-decoration: none;
    }
    .btn-modal-conferma:hover {
      background-color: #440f0f;
    }
  </style>

  <!-- TAG OPEN GRAPH PER ANTEPRIMA WHATSAPP -->
  <meta property="og:title" content="Raspu Team - Comunicato Ufficiale" />
  <meta property="og:description" content="Comunicato ufficiale diramato dalla presidenza del Raspu Team." />
  <meta property="og:image" content="https://rasputeam.altervista.org/img/stemma.jpg" />
  <meta property="og:image:secure_url" content="https://rasputeam.altervista.org/img/stemma.jpg" />
  <meta property="og:image:type" content="image/jpeg" />
  <meta property="og:image:width" content="1024" />
  <meta property="og:image:height" content="1024" />
  <meta property="og:url" content="https://rasputeam.altervista.org/comunicato.php" />
  <meta property="og:type" content="website" />
</head>
<body>

  <?php include 'header.php'; ?>

  <div class="container">
    <div class="main-layout" style="grid-template-columns: 1fr;">
      <main class="main-content">
        
        <!-- BARRA SUPERIORE (Spostata fuori dal riquadro) -->
        <div class="comunicato-top-bar">
          <a href="comunicazioni.php" class="link-indietro">← Torna a tutte le comunicazioni</a>
          
          <?php if ($isLogged): ?>
            <div class="admin-buttons">
              <a href="#" id="linkModifica" class="btn-modifica">Modifica</a>
              <a href="#" id="linkElimina" class="btn-elimina">Elimina</a>
            </div>
          <?php endif; ?>
        </div>

        <!-- RIQUADRO PRINCIPALE DEL CONTENUTO -->
        <article class="card-sidebar" style="padding: 25px;">
          <!-- STRUTTURA RICHIESTA DA SCRIPT.JS -->
          <small id="comunicato-data" style="color: var(--amaranto); font-weight: bold;"></small>
          <h1 id="comunicato-titolo" style="margin: 10px 0 20px 0; font-size: 1.8rem;"></h1>
          <div id="comunicato-testo" style="line-height: 1.6;"></div>
        </article>

      </main>
    </div>
  </div>

  <!-- MODALE DI CONFERMA ELIMINAZIONE -->
  <div id="modalElimina" class="modal-overlay" style="display: none;">
    <div class="modal-box">
      <h3>CONFERMA ELIMINAZIONE</h3>
      <p>Sei sicuro di voler eliminare definitivamente questo comunicato ufficiale? Questa operazione non può essere annullata.</p>
      <div class="modal-buttons">
        <button id="btnAnnullaModale" class="btn-modal-annulla">Annulla</button>
        <a id="btnConfermaElimina" href="#" class="btn-modal-conferma">Conferma</a>
      </div>
    </div>
  </div>

  <script src="script.js"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const urlParams = new URLSearchParams(window.location.search);
      const id = urlParams.get('id');
      
      if (id) {
        const btnMod = document.getElementById('linkModifica');
        const btnDel = document.getElementById('linkElimina');
        const modal = document.getElementById('modalElimina');
        const btnAnnullaModale = document.getElementById('btnAnnullaModale');
        const btnConfermaElimina = document.getElementById('btnConfermaElimina');

        if (btnMod) btnMod.href = 'modifica_comunicato.php?id=' + id;
        
        if (btnDel && modal) {
          btnDel.addEventListener('click', function(e) {
            e.preventDefault();
            btnConfermaElimina.href = 'elimina_comunicato.php?id=' + id;
            modal.style.display = 'flex';
          });
        }

        if (btnAnnullaModale && modal) {
          btnAnnullaModale.addEventListener('click', function() {
            modal.style.display = 'none';
          });
        }

        window.addEventListener('click', function(e) {
          if (e.target === modal) {
            modal.style.display = 'none';
          }
        });
      }
    });
  </script>
</body>
</html>