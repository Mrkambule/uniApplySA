<?php
require_once __DIR__ . '/../public/config.php'; 

require_once __DIR__ . '/../inc/auth.php';
session_destroy();
header('Location: ' . (BASE_URL . '/'));
