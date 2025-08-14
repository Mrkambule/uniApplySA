<?php
require_once __DIR__ . '/../inc/db.php';
require_once __DIR__ . '/../inc/auth.php';
require_once __DIR__ . '/../inc/functions.php';
include __DIR__ . '/../inc/header.php';
?>
<h1>Chatbot Assistant</h1>
<p>Ask a question (e.g., "What documents do I need?" or "When do UCT applications open?").</p>
<form id="bot-form" class="card">
  <input class="input" name="q" placeholder="Type your question..." autocomplete="off"/>
  <button class="btn" type="submit">Ask</button>
</form>
<div id="bot-log" style="max-height:400px;overflow:auto"></div>
<?php include __DIR__ . '/../inc/footer.php'; ?>
