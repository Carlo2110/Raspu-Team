<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Controllo di sicurezza rigoroso: solo il presidente loggato può eliminare
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

$idDaEliminare = $_GET['id'] ?? null;

if ($idDaEliminare !== null) {
    $scriptPath = 'script.js';
    
    if (file_exists($scriptPath)) {
        $scriptContent = file_get_contents($scriptPath);

        // Estrae l'array dei comunicati
        preg_match('/const\s+comunicati\s*=\s*\[(.*?)\];/s', $scriptContent, $matches);
        
        if (!empty($matches[1])) {
            $arrayBody = $matches[1];

            // Rimuove l'oggetto specifico corrispondente all'id tramite espressione regolare
            // Cerca il blocco { ... id: "X", ... } e lo rimuove
            $pattern = '/\s*\{\s*id:\s*" ' . preg_quote($idDaEliminare, '/') . ' ".*?\},\s*/s';
            // Gestione alternativa nel caso le virgolette dell'id siano senza spazi
            $patternAlt = '/\s*\{\s*id:\s*"' . preg_quote($idDaEliminare, '/') . '".*?\},\s*/s';
            
            $nuovoArrayBody = preg_replace($patternAlt, '', $arrayBody);

            // Sostituisce nel file script.js
            $nuovoScriptContent = str_replace($arrayBody, $nuovoArrayBody, $scriptContent);
            file_put_contents($scriptPath, $nuovoScriptContent);
        }
    }
}

// Torna alla lista delle comunicazioni
header("Location: comunicazioni.php");
exit;
?>