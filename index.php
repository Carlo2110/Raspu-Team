<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Raspu Team - Sito Ufficiale</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <?php include 'header.php'; ?>

  <div class="container grid-home">
    
    <aside class="sidebar">
      
      <!-- Box Prossima Partita (Dinamico) -->
      <div class="card-sidebar match-widget">
        <div class="card-header" id="giornata-titolo">Prossimo Match</div>
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