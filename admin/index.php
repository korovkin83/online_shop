<?php
if (isset($_COOKIE['admin_id'], $_COOKIE['login'], $_COOKIE['pass']))   {
    header('Location: users.php?page=lists');
} else {
      header('Location: login.php');
}
