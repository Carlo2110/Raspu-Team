<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Controllo di sicurezza: se non sei loggato come presidente, vieni rispedito alla home
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nuovo Comunicato - Raspu Team FC</title>
  <link rel="stylesheet" href="style.css">
  <style>
    .form-container {
      background-color: var(--container-bg, #fdfbf7);
      border: 2px solid var(--amaranto, #6b1d1d);
      border-radius: 8px;
      padding: 30px;
      max-width: 800px;
      margin: 40px auto;
      box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }
    .form-group {
      margin-bottom: 20px;
    }
    .form-group label {
      display: block;
      font-weight: bold;
      color: var(--amaranto, #6b1d1d);
      margin-bottom: 8px;
    }
    .form-group input[type="text"],
    .form-group textarea {
      width: 100%;
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-family: inherit;
      font-size: 1rem;
      box-sizing: border-box;
    }
    .form-group textarea {
      resize: vertical;
      min-height: 150px;
    }
    .firma-box {
      background: #f4eee1;
      padding: 15px;
      border-left: 4px solid var(--amaranto, #6b1d1d);
      font-style: italic;
      margin-bottom: 20px;
      color: #333;
    }
    .btn-pubblica {
      background-color: var(--amaranto, #6b1d1d);
      color: var(--oro, #e5b338);
      border: 2px solid var(--oro, #e5b338);
      padding: 12px 25px;
      font-size: 1.1rem;
      font-weight: bold;
      border-radius: 4px;
      cursor: pointer;
      transition: background-color 0.2s, transform 0.1s;
      display: inline-block;
    }
    .btn-pubblica:hover {
      background-color: #551414;
      transform: scale(1.02);
    }
    .btn-indietro {
      display: inline-block;
      margin-top: 15px;
      color: var(--amaranto, #6b1d1d);
      text-decoration: none;
      font-weight: bold;
    }
    .btn-indietro:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <?php include 'header.php'; ?>

  <div class="container">
    <div class="form-container">
      <h2>PUBBLICA NUOVO COMUNICATO</h2>
      <p style="margin-bottom: 20px; color: #555;">Compila i campi sottostanti per emettere un nuovo comunicato ufficiale della presidenza.</p>

      <form action="salva_comunicato.php" method="POST">
        
        <div class="form-group">
          <label for="titolo">Titolo del Comunicato:</label>
          <input type="text" id="titolo" name="titolo" placeholder="Es. COMUNICATO UFFICIALE: ..." required>
        </div>

        <div class="form-group">
          <label for="estratto">Estratto (Anteprima breve per la Home e la lista):</label>
          <textarea id="estratto" name="estratto" rows="3" placeholder="Breve riassunto che apparirà nelle anteprime..." required></textarea>
        </div>

        <div class="form-group">
          <label for="testo">Contenuto Principale:</label>
          <textarea id="testo" name="testo" rows="8" placeholder="Scrivi qui il corpo del comunicato..." required></textarea>
        </div>

        <div class="firma-box">
          <p>La firma verrà aggiunta automaticamente alla fine:</p>
          <p><b>Il presidente</b><br><b>Carlo Maria Piccolo</b></p>
        </div>

        <button type="submit" class="btn-pubblica">Pubblica Comunicato</button>
      </form>

      <div>
        <a href="comunicazioni.php" class="btn-indietro">← Annulla e torna alle comunicazioni</a>
      </div>
    </div>
  </div>

  <script src="script.js"></script>
</body>
</html>