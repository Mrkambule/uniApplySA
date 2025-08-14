<?php
if (session_status() === PHP_SESSION_NONE) session_start();

function is_logged_in(): bool {
    return isset($_SESSION['user_id']);
}
function is_admin(): bool {
    return isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1;
}
function require_login() {
    if (!is_logged_in()) {
        header('Location: ' . BASE_URL . '/login.php?next=' . urlencode($_SERVER['REQUEST_URI']));
        exit;
    }
}
function require_admin() {
    if (!is_admin()) {
        header('Location: ' . BASE_URL . '/index.php');
        exit;
    }
}
