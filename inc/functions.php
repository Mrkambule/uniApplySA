<?php
function e($str){ return htmlspecialchars($str ?? '', ENT_QUOTES, 'UTF-8'); }

function provinces(): array {
    return ['Eastern Cape','Free State','Gauteng','KwaZulu-Natal','Limpopo','Mpumalanga','Northern Cape','North West','Western Cape'];
}

function merit_types(): array {
    return ['Need-based','Merit-based','Both'];
}

function password_hash_strong($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}
