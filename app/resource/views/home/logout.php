<?php
   // session_destroy();
   unset($_SESSION['user']['id_user']);
   // header('Location: login');
   header('Location: /home');
?>