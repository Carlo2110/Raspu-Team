<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

date_default_timezone_set('Europe/Rome');

if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titolo = trim($_POST['titolo'] ?? '');
    $estratto = trim($_POST['estratto'] ?? '');
    $testoInput = trim($_POST['testo'] ?? '');

    if (!empty($titolo) && !empty($estratto) && !empty($testoInput)) {
        
        // Divide il testo riga per riga e racchiude ogni riga in un tag <p><strong>...</strong></p> con i <br> ordinati
        $righe = explode("\n", str_replace(["\r\n", "\r"], "\n", $testoInput));
        $testoFormattato = "";
        
        foreach ($righe as $index => $riga) {
            $rigaPulita = trim($riga);
            if (!empty($rigaPulita)) {
                $testoFormattato .= "<p><strong>" . htmlspecialchars($rigaPulita, ENT_QUOTES, 'UTF-8') . "</strong></p>\n      <br>\n      ";
            } else {
                $testoFormattato .= "<br>\n      ";
            }
        }
        
        // Aggiunge la firma istituzionale in fondo
        $testoFormattato .= "<p><i>Il presidente</i></p>\n      <p><i>Carlo Maria Piccolo</i></p>";

        $giorniMese = [
            1 => 'Gennaio', 2 => 'Febbraio', 3 => 'Marzo', 4 => 'Aprile', 
            5 => 'Maggio', 6 => 'Giugno', 7 => 'Luglio', 8 => 'Agosto', 
            9 => 'Settembre', 10 => 'Ottobre', 11 => 'Novembre', 12 => 'Dicembre'
        ];
        $dataOggi = date('j') . ' ' . $giorniMese[(int)date('n')] . ' ' . date('Y') . ' • ' . date('H:i');

        $scriptPath = 'script.js';
        
        if (file_exists($scriptPath)) {
            $scriptContent = file_get_contents($scriptPath);

            preg_match('/const\s+comunicati\s*=\s*\[(.*?)\];/s', $scriptContent, $matches);
            
            if (!empty($matches[1])) {
                preg_match_all('/id:\s*"(\d+)"/', $matches[1], $idMatches);
                $maxId = 0;
                if (!empty($idMatches[1])) {
                    $maxId = max(array_map('intval', $idMatches[1]));
                }
                $nuovoId = (string)($maxId + 1);

                $nuovoElementoJS = "  {\n" .
                    "    id: \"" . $nuovoId . "\",\n" .
                    "    titolo: " . json_encode($titolo) . ",\n" .
                    "    estratto: " . json_encode($estratto) . ",\n" .
                    "    testo: `\n      " . $testoFormattato . "\n    `,\n" .
                    "    data: \"" . $dataOggi . "\"\n" .
                    "  },\n";

                $vecchioArrayBody = $matches[1];
                $nuovoArrayBody = "\n" . $nuovoElementoJS . ltrim($vecchioArrayBody);

                $nuovoScriptContent = str_replace($matches[1], $nuovoArrayBody, $scriptContent);
                
                file_put_contents($scriptPath, $nuovoScriptContent);
            }
        }
    }
}

header("Location: comunicazioni.php");
exit;
?>