<?php
    session_start();
    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/client.php'); 
    require_once(__DIR__ . '/../templates/profile.tpl.php');
    require_once(__DIR__ . '/../templates/common.tpl.php');


    $user_id = $_SESSION['uid'];
    $db = getDatabaseConnection();
    $curr_user = getUser($db, $user_id);

?>

<!DOCTYPE html>
<html>
<head>
  <title>Profile Page</title>
  <script src="/../javascript/scr.js" defer></script>
  <link rel="stylesheet" href="geralstyle.css">
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>
<body>
  <header>
    <?php drawHeader(0, 4, "Profile"); ?>
  </header>
  <div id="nav">
    <?php drawSideBar(); ?>
  </div>
  <div id="content">
    <?php drawProfile($curr_user); ?>
  </div>
  <div id="footer">
    <footer>
      <p>Algum footer que queiramos</p>
    </footer>
  </div>
</body>
</html>
