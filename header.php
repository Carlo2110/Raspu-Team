<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$current_page = basename($_SERVER['PHP_SELF']);
// Controlliamo se siamo in una pagina di transizione (login riuscito o logout)
$is_transition_page = ($current_page == 'logout.php') || ($current_page == 'admin.php' && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user']));
?>
<header>
  <div class="header-container">
    <img src="img/stemma.png" alt="Logo Raspu Team" class="logo-header">
    <div class="header-text">
      <h1>RASPU TEAM</h1>
      <p class="tagline">Sito Ufficiale • Fondato nel 2021 • Lega Terronica NEFALL</p>
    </div>
  </div>

  <!-- Menu utente / Pulsante login in alto a destra -->
  <div class="header-right-section" style="display: none;">
      <?php if (!$is_transition_page): ?>
          <?php if (isset($_SESSION['user'])): ?>
              <!-- SE SEI LOGGATO -->
              <div class="user-profile-container">
                  <img src="img/presidente.jpg" alt="Foto Profilo" class="profile-img-circle" id="profileImgBtn" onclick="toggleUserDropdown(event)">
                  
                  <div class="user-dropdown-menu" id="userDropdownMenu">
                      <div class="dropdown-header-info">
                          <strong>Carlo Maria Piccolo</strong><br>
                          <small>Presidente</small>
                      </div>
                      
                      <a href="logout.php" class="dropdown-logout">Esci</a>
                  </div>
              </div>
          <?php else: ?>
              <!-- SE NON SEI LOGGATO -->
              <a href="admin.php" class="area-presidente-destra">Area Presidente</a>
          <?php endif; ?>
      <?php endif; ?>
  </div>
</header>

<nav>
  <ul>
    <li><a href="index.php" class="<?php echo ($current_page == 'index.php') ? 'active' : ''; ?>">Home</a></li>
    <li><a href="rosa.php" class="<?php echo ($current_page == 'rosa.php' || strpos($current_page, 'rosa') !== false) ? 'active' : ''; ?>">La squadra</a></li>
    <li><a href="comunicazioni.php" class="<?php echo ($current_page == 'comunicazioni.php' || strpos($current_page, 'comunicato') !== false) ? 'active' : ''; ?>">Comunicazioni</a></li>
    <li><a href="palmares.php" class="<?php echo ($current_page == 'palmares.php') ? 'active' : ''; ?>">Palmarès</a></li>
  </ul>
</nav>

<!-- FUNZIONE GLOBALE INLINE -->
<script>
function toggleUserDropdown(event) {
    event.stopPropagation();
    const dropdownMenu = document.getElementById('userDropdownMenu');
    if (dropdownMenu) {
        dropdownMenu.classList.toggle('active');
    }
}

document.addEventListener('click', function(event) {
    const dropdownMenu = document.getElementById('userDropdownMenu');
    const profileBtn = document.getElementById('profileImgBtn');
    if (dropdownMenu && profileBtn) {
        if (!dropdownMenu.contains(event.target) && event.target !== profileBtn) {
            dropdownMenu.classList.remove('active');
        }
    }
});

// Script anti-flicker per mostrare il blocco solo a caricamento ultimato (e mai nelle pagine di transizione)
document.addEventListener("DOMContentLoaded", function() {
    const rightSection = document.querySelector('.header-right-section');
    const isTransition = <?php echo $is_transition_page ? 'true' : 'false'; ?>;
    
    if (rightSection && !isTransition) {
        setTimeout(function() {
            rightSection.style.display = 'block';
            rightSection.classList.add('loaded');
        }, 50);
    }
});
</script>