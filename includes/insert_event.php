<?php

  require_once 'DB.connect.php';

  $db = new Dbh();
  // $db->connect();
  $db->addEvent();

  echo "<script>location.href='../index.php'</script>";
 ?>
