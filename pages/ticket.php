<?php 
  session_start();
  if (!isset($_SESSION['uid'])) {
    header('Location: page.php');
  }
  require_once(__DIR__ . '/../database/connection.php');
  require_once(__DIR__ . '/../database/departments.php');
  require_once(__DIR__ . '/../templates/ticket.tpl.php');
?>
<!DOCTYPE html>
<html>
<head>
  <title>Enviar Ticket</title>
  <link rel="stylesheet" href="styles2.css">
</head>
<body>
  <header>
    <h1>Enviar Ticket</h1>
  </header>
  <main>
    <?php drawTicketForm(null, true); ?>
  </main>
  <footer>
    <p>Algum footer que queiramos</p>
  </footer>
</body>
</html>
