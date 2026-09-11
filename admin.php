<?php
session_start();
include 'connessione.php';

$errore = "";
$loginRiuscito = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Usiamo $pdo definito in connessione.php
    $stmt = $pdo->prepare("SELECT password FROM utenti WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    // Verifichiamo l'utente e la password, ma diamo un errore generico
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $username;
        $loginRiuscito = true;
    } else {
        $errore = "Accesso negato.";
    }
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - Raspu Team</title>
  <link rel="stylesheet" href="style.css">
  <?php if ($loginRiuscito): ?>
    <meta http-equiv="refresh" content="3.5;url=index.php">
  <?php endif; ?>
</head>
<body>

  <?php include 'header.php'; ?>

  <div class="container" style="max-width: 420px; margin: 60px auto; background: var(--bianco-sporco, #f4eee1); padding: 30px; border-radius: 8px; box-shadow: 0 4px 20px rgba(0,0,0,0.4); border: 2px solid var(--amaranto, #6b1d1d); text-align: center; color: #000;">
    
    <?php if ($loginRiuscito): ?>
      <h2 style="color: var(--amaranto, #6b1d1d); margin-top: 0;">Bentornato, Presidente!</h2>
      <p style="font-size: 1.1rem; line-height: 1.6; margin-bottom: 20px;">Autenticazione effettuata con successo. Stiamo caricando la pagina per lei...</p>
      <div style="border: 4px solid #f3f3f3; border-top: 4px solid var(--amaranto, #6b1d1d); border-radius: 50%; width: 30px; height: 30px; animation: spin 1s linear infinite; margin: 0 auto;"></div>
      <style>
        @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
      </style>
    <?php else: ?>
      <h2 style="color: var(--amaranto, #6b1d1d); margin-top: 0; margin-bottom: 20px;">Area Presidente</h2>
      
      <?php if (!empty($errore)): ?>
        <p style="color: var(--amaranto, #6b1d1d); font-weight: bold; background: rgba(107, 29, 29, 0.1); padding: 10px; border-radius: 4px; margin-bottom: 15px;"><?php echo $errore; ?></p>
      <?php endif; ?>

      <form action="admin.php" method="POST">
        <div style="margin-bottom: 15px; text-align: left;">
          <label style="display: block; font-weight: bold; margin-bottom: 5px; color: var(--amaranto, #6b1d1d);">Username:</label>
          <input type="text" name="username" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; font-size: 1rem;">
        </div>
        <div style="margin-bottom: 20px; text-align: left;">
          <label style="display: block; font-weight: bold; margin-bottom: 5px; color: var(--amaranto, #6b1d1d);">Password:</label>
          <input type="password" name="password" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; font-size: 1rem;">
        </div>
        <button type="submit" style="width: 100%; padding: 12px; background: var(--amaranto, #6b1d1d); color: #fff; border: none; font-weight: bold; border-radius: 4px; cursor: pointer; font-size: 1rem;">Accedi</button>
      </form>
    <?php endif; ?>

  </div>

  <script src="script.js"></script>
</body>
</html>