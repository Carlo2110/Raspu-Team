<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

date_default_timezone_set('Europe/Rome');

if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

$idDaModificare = $_GET['id'] ?? null;
if ($idDaModificare === null) {
    header("Location: comunicazioni.php");
    exit;
}

$jsonPath = 'comunicati.json';
$titoloAttuale = '';
$estrattoAttuale = '';
$testoGrezzoAttuale = '';
$dataOriginale = '';

if (file_exists($jsonPath)) {
    $jsonContent = file_get_contents($jsonPath);
    $comunicati = json_decode($jsonContent, true);
    
    if (is_array($comunicati)) {
        foreach ($comunicati as $c) {
            if ($c['id'] === $idDaModificare) {
                $titoloAttuale = $c['titolo'];
                $estrattoAttuale = $c['estratto'];
                $testoHtml = trim($c['testo']);
                $dataOriginale = $c['data'];

                // Pulisce l'HTML per rimettere il testo grezzo nella textarea
                $testoPulito = strip_tags($testoHtml, '<br>');
                $testoGrezzoAttuale = str_replace(['<br>', "\n    "], ["\n", ""], $testoPulito);
                $testoGrezzoAttuale = trim(preg_replace("/\n\s*\n/", "\n", $testoGrezzoAttuale));
                
                // Rimuove la firma fissa finale se presente
                $testoGrezzoAttuale = preg_replace('/Il presidente\s*Carlo Maria Piccolo/i', '', $testoGrezzoAttuale);
                $testoGrezzoAttuale = trim($testoGrezzoAttuale);
                break;
            }
        }
    }
}

// Se viene inviato il form di modifica
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nuovoTitolo = trim($_POST['titolo'] ?? '');
    $nuovoEstratto = trim($_POST['estratto'] ?? '');
    $nuovoTestoInput = trim($_POST['testo'] ?? '');

    if (!empty($nuovoTitolo) && !empty($nuovoEstratto) && !empty($nuovoTestoInput)) {
        
        $righe = explode("\n", str_replace(["\r\n", "\r"], "\n", $nuovoTestoInput));
        $testoFormattato = "";
        
        foreach ($righe as $riga) {
            $rigaPulita = trim($riga);
            if (!empty($rigaPulita)) {
                $testoFormattato .= "<p><strong>" . htmlspecialchars($rigaPulita, ENT_QUOTES, 'UTF-8') . "</strong></p><br>";
            } else {
                $testoFormattato .= "<br>";
            }
        }
        
        $testoFormattato .= "<p><i>Il presidente</i></p><p><i>Carlo Maria Piccolo</i></p>";

        // Aggiorna il file JSON
        if (file_exists($jsonPath)) {
            $comunicati = json_decode(file_get_contents($jsonPath), true);
            if (is_array($comunicati)) {
                foreach ($comunicati as &$c) {
                    if ($c['id'] === $idDaModificare) {
                        $c['titolo'] = $nuovoTitolo;
                        $c['estratto'] = $nuovoEstratto;
                        $c['testo'] = $testoFormattato;
                        // Mantiene la data originale o la aggiorna se preferisci
                        break;
                    }
                }
                unset($c);
                file_put_contents($jsonPath, json_encode($comunicati, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            }
        }

        header("Location: comunicato.php?id=" . $idDaModificare);
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modifica Comunicato - Raspu Team FC</title>
  <link rel="stylesheet" href="style.css">
  <style>
    .form-container {
      background: var(--bianco-sporco, #f4eee1);
      padding: 30px;
      border-radius: 8px;
      color: #000;
      max-width: 800px;
      margin: 20px auto;
      box-shadow: 0 4px 15px rgba(0,0,0,0.3);
    }
    .form-group {
      margin-bottom: 20px;
    }
    .form-group label {
      display: block;
      font-weight: bold;
      margin-bottom: 8px;
      color: var(--amaranto, #6b1d1d);
    }
    .form-group input[type="text"],
    .form-group textarea {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-family: inherit;
      font-size: 1rem;
      box-sizing: border-box;
    }
    .form-group textarea {
      height: 200px;
      resize: vertical;
    }
    .btn-salva {
      background-color: var(--amaranto, #6b1d1d);
      color: #fff;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      font-size: 1rem;
      font-weight: bold;
      cursor: pointer;
      transition: background-color 0.2s;
    }
    .btn-salva:hover {
      background-color: #440f0f;
    }
    .btn-annulla {
      background-color: #666;
      color: #fff;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      font-size: 1rem;
      font-weight: bold;
      text-decoration: none;
      margin-left: 10px;
      display: inline-block;
    }
    .btn-annulla:hover {
      background-color: #444;
    }
  </style>
</head>
<body>

  <?php include 'header.php'; ?>

  <div class="container">
    <div class="form-container">
      <h2>Modifica Comunicato Ufficiale (N. <?php echo htmlspecialchars($idDaModificare); ?>)</h2>
      <form action="modifica_comunicato.php?id=<?php echo htmlspecialchars($idDaModificare); ?>" method="POST">
        
        <div class="form-group">
          <label for="titolo">Titolo del Comunicato:</label>
          <input type="text" id="titolo" name="titolo" value="<?php echo htmlspecialchars($titoloAttuale, ENT_QUOTES, 'UTF-8'); ?>" required>
        </div>

        <div class="form-group">
          <label for="estratto">Estratto (Breve riassunto per la lista):</label>
          <input type="text" id="estratto" name="estratto" value="<?php echo htmlspecialchars($estrattoAttuale, ENT_QUOTES, 'UTF-8'); ?>" required>
        </div>

        <div class="form-group">
          <label for="testo">Testo (Ogni riga andrà a capo in automatico):</label>
          <textarea id="testo" name="testo" required><?php echo htmlspecialchars($testoGrezzoAttuale, ENT_QUOTES, 'UTF-8'); ?></textarea>
        </div>

        <div>
          <button type="submit" class="btn-salva">Salva Modifiche</button>
          <a href="comunicato.php?id=<?php echo htmlspecialchars($idDaModificare); ?>" class="btn-annulla">Annulla</a>
        </div>

      </form>
    </div>
  </div>

</body>
</html>