<?php
$inModifica = isset($idDaModificare);
$urlComunicato = $inModifica ? 'comunicato.php?id=' . rawurlencode($idDaModificare) : 'comunicazioni.php';
$urlSalvataggio = $inModifica ? 'modifica_comunicato.php?id=' . rawurlencode($idDaModificare) : 'salva_comunicato.php';
?>
<div class="container">
  <div class="comunicato-form">
    <?php if ($inModifica): ?>
      <h2>Modifica Comunicato Ufficiale (N. <?= htmlspecialchars($idDaModificare, ENT_QUOTES, 'UTF-8') ?>)</h2>
    <?php else: ?>
      <h2>PUBBLICA NUOVO COMUNICATO</h2>
      <p style="margin-bottom: 20px; color: #555;">Compila i campi sottostanti per emettere un nuovo comunicato ufficiale della presidenza.</p>
    <?php endif; ?>

    <form action="<?= $urlSalvataggio ?>" method="POST">
      <div class="form-group">
        <label for="titolo">Titolo del Comunicato:</label>
        <input type="text" id="titolo" name="titolo" placeholder="Es. COMUNICATO UFFICIALE: ..." value="<?= htmlspecialchars($titoloAttuale ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
      </div>

      <div class="form-group">
        <label for="estratto">Estratto (Anteprima breve per la Home e la lista):</label>
        <textarea id="estratto" name="estratto" rows="3" placeholder="Breve riassunto che apparirà nelle anteprime..." required><?=
          "\n" . htmlspecialchars($estrattoAttuale ?? '', ENT_QUOTES, 'UTF-8')
        ?></textarea>
      </div>

      <div class="form-group">
        <label for="testo">Contenuto Principale:</label>
        <textarea id="testo" name="testo" rows="8" placeholder="Scrivi qui il corpo del comunicato..." required><?=
          "\n" . htmlspecialchars($testoGrezzoAttuale ?? '', ENT_QUOTES, 'UTF-8')
        ?></textarea>
      </div>

      <div class="firma-box">
        <p>La firma verrà aggiunta automaticamente alla fine:</p>
        <p><b>Il presidente</b><br><b>Carlo Maria Piccolo</b></p>
      </div>

      <button type="submit" class="btn-pubblica"><?= $inModifica ? 'Salva Modifiche' : 'Pubblica Comunicato' ?></button>
    </form>

    <div>
      <a href="<?= $urlComunicato ?>" class="btn-indietro"><?= $inModifica ? 'Annulla' : '← Annulla e torna alle comunicazioni' ?></a>
    </div>
  </div>
</div>
