<?php
session_start();
require 'connessione.php';

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: admin.php");
    exit;
}

$errore = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'], $_POST['password'])) {
    $username = trim($_POST['username']);
    $password_inserita = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM utenti WHERE username = ?");
    $stmt->execute([$username]);
    $utenti = $stmt->fetchAll();

    if (count($utenti) > 0) {
        $utente = $utenti[0];
        if (password_verify($password_inserita, $utente['password'])) {
            $_SESSION['utente_autenticato'] = true;
            $_SESSION['username'] = $utente['username'];
            header("Location: admin.php");
            exit;
        }
    }
    $errore = "Credenziali non valide!";
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Area Presidente - Raspu Team</title>
</head>
<body>
    <div style="max-width: 400px; margin: 50px auto; font-family: sans-serif;">
        <?php if (!isset($_SESSION['utente_autenticato'])): ?>
            <h2>Area Presidente</h2>
            <?php if ($errore): ?>
                <p style="color: red;"><?php echo $errore; ?></p>
            <?php endif; ?>
            <form method="POST">
                <input type="text" name="username" placeholder="Username" required style="width: 100%; padding: 10px; margin-bottom: 10px; box-sizing: border-box;">
                <input type="password" name="password" placeholder="Password" required style="width: 100%; padding: 10px; margin-bottom: 10px; box-sizing: border-box;">
                <button type="submit" style="width: 100%; padding: 10px;">Accedi</button>
            </form>
        <?php else: ?>
            <h2>Benvenuto, Presidente!</h2>
            <p>Sei loggato correttamente.</p>
            <a href="admin.php?logout=1">Logout</a>
        <?php endif; ?>
    </div>
</body>
</html>