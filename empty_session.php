<?php

  // ouverture du cookie $_SESSION
  session_start();

  setcookie (session_id(), "", time() - 3600);
  session_destroy();
  session_write_close();

 ?>
