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
    $jsonPath = 'comunicati.json';
    
    if (file_exists($jsonPath)) {
        $jsonContent = file_get_contents($jsonPath);
        $comunicati = json_decode($jsonContent, true);
        
        if (is_array($comunicati)) {
            // Filtriamo l'array escludendo il comunicato con l'id da eliminare
            $comunicatiAggiornati = array_values(array_filter($comunicati, function($c) use ($idDaEliminare) {
                return $c['id'] !== $idDaEliminare;
            }));
            
            // Salviamo il file JSON aggiornato (mantenendo una formattazione pulita)
            file_put_contents($jsonPath, json_encode($comunicatiAggiornati, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        }
    }
}

// Torna alla lista delle comunicazioni
header("Location: comunicazioni.php");
exit;
?>