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
        $testoFormattato .= "<p><i>Il presidente</i></p><p><i>Carlo Maria Piccolo</i></p>";

        $giorniMese = [
            1 => 'Gennaio', 2 => 'Febbraio', 3 => 'Marzo', 4 => 'Aprile', 
            5 => 'Maggio', 6 => 'Giugno', 7 => 'Luglio', 8 => 'Agosto', 
            9 => 'Settembre', 10 => 'Ottobre', 11 => 'Novembre', 12 => 'Dicembre'
        ];
        $dataOggi = date('j') . ' ' . $giorniMese[(int)date('n')] . ' ' . date('Y') . ' • ' . date('H:i');

        $jsonPath = 'comunicati.json';
        
        if (file_exists($jsonPath)) {
            $jsonContent = file_get_contents($jsonPath);
            $comunicati = json_decode($jsonContent, true) ?? [];

            // Calcola il nuovo ID massimo
            $maxId = 0;
            foreach ($comunicati as $c) {
                if (isset($c['id']) && is_numeric($c['id'])) {
                    $maxId = max($maxId, intval($c['id']));
                }
            }
            $nuovoId = (string)($maxId + 1);

            // Crea il nuovo elemento
            $nuovoElemento = [
                "id" => $nuovoId,
                "titolo" => $titolo,
                "estratto" => $estratto,
                "testo" => $testoFormattato,
                "data" => $dataOggi
            ];

            // Inserisce il nuovo comunicato in cima alla lista
            array_unshift($comunicati, $nuovoElemento);

            // Salva nel file JSON
            file_put_contents($jsonPath, json_encode($comunicati, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        }
    }
}

header("Location: comunicazioni.php");
exit;
?>