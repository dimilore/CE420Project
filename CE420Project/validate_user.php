<?php
  session_start();
  if (!$_SESSION['signed_in'] || $_SESSION['role']!="U") {
    $_SESSION['flash_error'] = "Please log in :)";
    header("Location: index.php");
    exit; // IMPORTANT: Be sure to exit here!
  }
?>