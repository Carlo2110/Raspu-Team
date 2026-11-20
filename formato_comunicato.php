<?php

const FIRMA_COMUNICATO = '<p><i>Il presidente</i></p><p><i>Carlo Maria Piccolo</i></p>';

function normalizzaRigheComunicato(string $testo): string
{
    return str_replace(["\r\n", "\r"], "\n", $testo);
}

function formattaTestoComunicato(string $testo): string
{
    $html = '';
    foreach (explode("\n", trim($testo)) as $riga) {
        $riga = trim($riga);
        if (!empty($riga)) {
            $html .= '<p><strong>' . htmlspecialchars($riga, ENT_QUOTES, 'UTF-8') . "</strong></p>\n      ";
        }
        $html .= "<br>\n      ";
    }

    return $html . FIRMA_COMUNICATO;
}

function testoPerEditorComunicato(array $comunicato): string
{
    if (isset($comunicato['testo_originale'])) {
        return normalizzaRigheComunicato($comunicato['testo_originale']);
    }

    $html = trim($comunicato['testo']);
    $lunghezzaFirma = strlen(FIRMA_COMUNICATO);
    if (substr($html, -$lunghezzaFirma) === FIRMA_COMUNICATO) {
        $html = substr($html, 0, -$lunghezzaFirma);
    }

    // I comunicati precedenti salvavano un <br> per ogni riga, comprese quelle vuote.
    $righe = preg_split('~<br\s*/?>~i', $html);
    $righe = array_map(static function (string $riga): string {
        return html_entity_decode(trim(strip_tags($riga)), ENT_QUOTES, 'UTF-8');
    }, $righe);

    return trim(implode("\n", $righe));
}
