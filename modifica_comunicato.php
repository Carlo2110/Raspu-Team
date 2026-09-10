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

$scriptPath = 'script.js';
$titoloAttuale = '';
$estrattoAttuale = '';
$testoGrezzoAttuale = '';
$dataOriginale = '';

if (file_exists($scriptPath)) {
    $scriptContent = file_get_contents($scriptPath);
    preg_match('/const\s+comunicati\s*=\s*\[(.*?)\];/s', $scriptContent, $matches);
    
    if (!empty($matches[1])) {
        // Estrae l'oggetto corrispondente all'ID
        $pattern = '/\{\s*id:\s*"' . preg_quote($idDaModificare, '/') . '",\s*titolo:\s*(.*?),\s*estratto:\s*(.*?),\s*testo:\s*`(.*?)`,\s*data:\s*"(.*?)"\s*\}/s';
        if (preg_match($pattern, $matches[1], $comunicatoMatch)) {
            $titoloAttuale = json_decode($comunicatoMatch[1]);
            $estrattoAttuale = json_decode($comunicatoMatch[2]);
            $testoHtml = trim($comunicatoMatch[3]);
            $dataOriginale = $comunicatoMatch[4];

            // Riconverte il testo HTML formattato in testo normale pulendo anche eventuali tag residui con strip_tags
            $testoPulito = strip_tags($testoHtml, '<br>');
            $testoGrezzoAttuale = str_replace(['<br>', "\n     "], ["\n", ""], $testoPulito);
            $testoGrezzoAttuale = trim(preg_replace("/\n\s*\n/", "\n", $testoGrezzoAttuale));
            
            // Rimuove la firma fissa finale se presente per evitare duplicazioni al salvataggio
            $testoGrezzoAttuale = preg_replace('/Il presidente\s*Carlo Maria Piccolo/i', '', $testoGrezzoAttuale);
            $testoGrezzoAttuale = trim($testoGrezzoAttuale);
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
                $testoFormattato .= "<p><strong>" . htmlspecialchars($rigaPulita, ENT_QUOTES, 'UTF-8') . "</strong></p>\n     <br>\n     ";
            } else {
                $testoFormattato .= "<br>\n     ";
            }
        }
        
        $testoFormattato .= "<p><i>Il presidente</i></p>\n     <p><i>Carlo Maria Piccolo</i></p>";

        $nuovoElementoJS = "  {\n" .
            "    id: \"" . $idDaModificare . "\",\n" .
            "    titolo: " . json_encode($nuovoTitolo) . ",\n" .
            "    estratto: " . json_encode($nuovoEstratto) . ",\n" .
            "    testo: `\n     " . $testoFormattato . "\n    `,\n" .
            "    data: \"" . $dataOriginale . "\"\n" .
            "  },";

        // Sostituisce il vecchio blocco nel file script.js
        $patternBlocco = '/\s*\{\s*id:\s*"' . preg_quote($idDaModificare, '/') . '".*?\},\s*/s';
        $scriptContentNew = preg_replace($patternBlocco, "\n" . $nuovoElementoJS . "\n", $scriptContent);
        
        file_put_contents($scriptPath, $scriptContentNew);

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