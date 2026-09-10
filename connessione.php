<?php
$host = "localhost";
$db   = "rasputeam"; // <--- Metti il prefisso my_
$user = "root";    // <--- Il tuo utente AlterVista
$pass = "";             // <--- Lascia vuoto
$port = 3306;

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;port=$port;charset=utf8mb4", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    die("Errore di connessione al database: " . $e->getMessage());
}
?>