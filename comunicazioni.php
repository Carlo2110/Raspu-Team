<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Comunicazioni - Raspu Team FC</title>
  <link rel="stylesheet" href="style.css">
  <style>
    .btn-floating-add {
      position: fixed;
      bottom: 30px;
      right: 30px;
      width: 60px;
      height: 60px;
      background-color: var(--amaranto, #6b1d1d);
      color: var(--oro, #e5b338);
      border-radius: 50%;
      display: flex;
      justify-content: center;
      align-items: center;
      font-size: 2rem;
      text-decoration: none;
      box-shadow: 0 4px 10px rgba(0,0,0,0.3);
      border: 2px solid var(--oro, #e5b338);
      transition: transform 0.2s, background-color 0.2s;
      z-index: 1000;
    }
    .btn-floating-add:hover {
      transform: scale(1.1);
      background-color: #551414;
      color: #fff;
    }
  </style>

  <!-- TAG OPEN GRAPH PER ANTEPRIMA WHATSAPP -->
  <meta property="og:title" content="Raspu Team - Comunicazioni Ufficiali" />
  <meta property="og:description" content="L'archivio completo di tutti i comunicati ufficiali, le notizie e gli aggiornamenti del Raspu Team." />
  <meta property="og:image" content="https://rasputeam.altervista.org/img/stemma.jpg" />
  <meta property="og:image:secure_url" content="https://rasputeam.altervista.org/img/stemma.jpg" />
  <meta property="og:image:type" content="image/jpeg" />
  <meta property="og:image:width" content="1024" />
  <meta property="og:image:height" content="1024" />
  <meta property="og:url" content="https://rasputeam.altervista.org/comunicazioni.php" />
  <meta property="og:type" content="website" />

</head>
<body>

  <?php include 'header.php'; ?>

  <div class="container">
    <div class="main-layout" style="grid-template-columns: 1fr;">
      <main class="main-content">
        <h2>UFFICIO STAMPA & COMUNICATI</h2>
        
        <div id="lista-comunicati" style="margin-top: 20px; display: flex; flex-direction: column; gap: 20px;">
          <!-- I comunicati vengono generati automaticamente da script.js -->
        </div>
      </main>
    </div>
  </div>

  <!-- PULSANTE FLOTTANTE VISIBILE SOLO SE LOGGATO COME PRESIDENTE -->
  <?php if (isset($_SESSION['user'])): ?>
      <a href="nuovo_comunicato.php" class="btn-floating-add" title="Aggiungi nuovo comunicato">+</a>
  <?php endif; ?>

  <script src="script.js"></script>
</body>
</html>