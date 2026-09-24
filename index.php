<?php
session_start();
?>
<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Raspu Team - Sito Ufficiale</title>

<!-- TAG OPEN GRAPH PER ANTEPRIMA WHATSAPP -->
  <meta property="og:title" content="Raspu Team - Sito Ufficiale" />
  <meta property="og:description" content="Benvenuto nel sito ufficiale del Raspu Team." />
  <meta property="og:image" content="https://rasputeam.altervista.org/img/stemma.jpg" />
  <meta property="og:image:secure_url" content="https://rasputeam.altervista.org/img/stemma.jpg" />
  <meta property="og:image:type" content="image/jpeg" />
  <meta property="og:image:width" content="1024" />
  <meta property="og:image:height" content="1024" />
  <meta property="og:url" content="https://rasputeam.altervista.org/" />
  <meta property="og:type" content="website" />

  <link rel="stylesheet" href="style.css">
</head>
<body>

  <?php include 'header.php'; ?>

  <div class="container grid-home">
    
    <aside class="sidebar">
      
      <!-- Box Prossima Partita (Dinamico) -->
      <div class="card-sidebar match-widget">
        <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
          <span id="giornata-titolo">Prossimo Match</span>
          <?php if (isset($_SESSION['user'])): ?>
            <a href="gestione_partita.php" style="background: #28a745; color: white; text-decoration: none; padding: 1px 4px; font-size: 8px; font-weight: bold; border-radius: 2px; text-align: center; line-height: 1; display: inline-block;">aggiorna<br>risultato</a>
          <?php endif; ?>
        </div>
        <div class="card-body match-body">
          <div class="match-teams">
            <span class="team-home">RASPU TEAM</span>
            <span class="vs">VS</span>
            <span class="team-away">CARICAMENTO...</span>
          </div>
          <small class="match-date" id="match-data">Calcolo in corso...</small>
        </div>
      </div>

      <!-- Box Ultimo Comunicato (Dinamico) -->
      <div class="card-sidebar">
        <div class="card-header">Ultimo Comunicato</div>
        <div class="card-body">
          <h4 id="home-comunicato-titolo">Caricamento...</h4>
          <p id="home-comunicato-estratto" class="testo-comunicato"></p>
          <a id="home-comunicato-link" href="#" class="read-more">Leggi tutto →</a>
          <small id="home-comunicato-data" class="date-tag"></small>
        </div>
      </div>

      <!-- Box Mini Palmarès -->
      <div class="card-sidebar mini-palmares">
        <div class="card-header">
          <a href="palmares.php" style="color: inherit; text-decoration: none;" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">Bacheca Rapida</a>
        </div>
        <div class="card-body trophy-list">
          <div class="trophy-item">🏆 <span>Coppa Italia (2025/26)</span></div>
        </div>
      </div>

    </aside>

    <main class="hero-section">
      
      <section class="squad-section">
        <h2>LA ROSA TITOLARE</h2>
        <a href="rosa_2026-27.php" style="text-decoration: none; display: block;">
          <div class="squad-image-wrapper">
            <img src="img/titolari.png" alt="11 Titolari Raspu Team" class="img-titolari">
            <div class="image-overlay">L'11 Titolare per la Stagione 2026/2027</div>
          </div>
        </a>
      </section>

      <section class="about-section">
        <img src="img/stemma.png" alt="Stemma Raspu Team" class="logo-main">
        <h3>CON LO SPIRITO E LA PASSIONE</h3>
        <p class="motto" style="font-weight: normal !important; font-style: italic;">"Dalla fondazione alla, un giorno, conquista della lega."</p>
      </section>

    </main>
  </div>

  <script src="script.js"></script>
</body>
</html>