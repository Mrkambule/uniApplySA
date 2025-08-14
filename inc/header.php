<?php
if (session_status() === PHP_SESSION_NONE) session_start();
?><!doctype html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<title><?= e(APP_NAME) ?></title>
<link rel="stylesheet" href="<?= BASE_URL ?>/assets/style.css"/>
<script defer src="<?= BASE_URL ?>/assets/scripts.js"></script>
</head>
<body>
<?php include __DIR__ . '/nav.php'; ?>
<main class="container">
