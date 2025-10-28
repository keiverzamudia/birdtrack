<?php
session_start();

if(empty($_SESSION["usuario"])) {
  header('Location:?url=login');
  exit;
}

if(isset($_POST['logout'])) {
  session_destroy();
  header('Location:?url=login');
  exit;
}
