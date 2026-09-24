<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>La Squadra - Raspu Team FC</title>
  <link rel="stylesheet" href="style.css">

<!-- TAG OPEN GRAPH PER ANTEPRIMA WHATSAPP -->
  <meta property="og:title" content="Raspu Team - La Squadra" />
  <meta property="og:description" content="La sezione ufficiale del Raspu Team: scopri la squadra, i ruoli e la rosa dei giocatori di ogni stagione." />
  <meta property="og:image" content="https://rasputeam.altervista.org/img/stemma.jpg" />
  <meta property="og:image:secure_url" content="https://rasputeam.altervista.org/img/stemma.jpg" />
  <meta property="og:image:type" content="image/jpeg" />
  <meta property="og:image:width" content="1024" />
  <meta property="og:image:height" content="1024" />
  <meta property="og:url" content="https://rasputeam.altervista.org/rosa.php" />
  <meta property="og:type" content="website" />

</head>
<body>

  <?php include 'header.php'; ?>

  <div class="container">
    <div class="main-layout" style="grid-template-columns: 1fr;">
      <main class="main-content">
        
        <h2>ARCHIVIO ROSE</h2>
        <p style="margin: 5px 0 20px 0; color: #555; font-size: 0.95rem;">
          Seleziona la stagione per consultare la rosa ufficiale dei calciatori, i reparti e i costi del Raspu Team.
        </p>

        <div style="margin-top: 20px; display: flex; flex-direction: column; gap: 20px;">
          <!-- Stagione 2026/2027 -->
          <a href="rosa_2026-27.php" style="text-decoration: none;">
            <article class="card-sidebar archivio-card" style="padding: 20px; border-left: 5px solid var(--oro); display: flex; justify-content: space-between; align-items: center;">
              <div>
                <small style="color: var(--amaranto); font-weight: bold; text-transform: uppercase;">Stagione Corrente</small>
                <h3 style="margin: 5px 0 8px 0; font-size: 1.5rem; color: var(--amaranto);">Stagione 2026/2027</h3>
                <p style="font-weight: normal; margin-bottom: 0; line-height: 1.5; color: #333;">
                  Rosa titolare, reparti aggiornati, dettagli dei crediti spesi e movimenti di mercato.
                </p>
              </div>
              <span style="font-size: 1.5rem; color: var(--amaranto); font-weight: bold; padding-left: 15px;">→</span>
            </article>
          </a>
        </div>

      </main>
    </div>
  </div>

</body>
</html>