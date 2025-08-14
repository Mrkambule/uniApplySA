<?php
if (session_status() === PHP_SESSION_NONE) session_start();
function csrf_token() {
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf'];
}
function csrf_field() {
    echo '<input type="hidden" name="csrf" value="' . htmlspecialchars(csrf_token()) . '">';
}
function csrf_validate() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!isset($_POST['csrf']) || !hash_equals($_SESSION['csrf'] ?? '', $_POST['csrf'])) {
            http_response_code(400);
            die('Invalid CSRF token');
        }
    }
}
