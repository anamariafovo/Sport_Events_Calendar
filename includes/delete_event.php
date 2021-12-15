<?php

  require_once 'DB.connect.php';

  $db = new Dbh();
  // $db->connect();
  $db->deleteEvent();

  echo "<script>location.href='../index.php'</script>";

?>
