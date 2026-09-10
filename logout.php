<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Distrugge la sessione e pulisce tutto
$_SESSION = array();
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
session_destroy();
?>
<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Logout - Raspu Team</title>
  <link rel="stylesheet" href="style.css">
  <!-- Reindirizzamento automatico dopo 3 secondi -->
  <meta http-equiv="refresh" content="3;url=index.php">
</head>
<body>

  <?php include 'header.php'; ?>

  <div class="container" style="max-width: 420px; margin: 60px auto; background: var(--bianco-sporco, #f4eee1); padding: 30px; border-radius: 8px; box-shadow: 0 4px 20px rgba(0,0,0,0.4); border: 2px solid var(--amaranto, #6b1d1d); text-align: center; color: #000;">
    <h2 style="color: var(--amaranto, #6b1d1d); margin-top: 0;">Arrivederci, Presidente!</h2>
    <p style="font-size: 1.1rem; line-height: 1.6; margin-bottom: 20px;">Sessione chiusa correttamente. A presto!</p>
    <div style="border: 4px solid #f3f3f3; border-top: 4px solid var(--amaranto, #6b1d1d); border-radius: 50%; width: 30px; height: 30px; animation: spin 1s linear infinite; margin: 0 auto;"></div>
    <style>
      @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
    </style>
  </div>

  <script src="script.js"></script>
</body>
</html>