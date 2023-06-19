<?php
   // session_destroy();
   unset($_SESSION['user']);
   unset($_SESSION['customer']);
   header('Location: /home');
?>