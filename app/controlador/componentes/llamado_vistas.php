<?php


if (file_exists("app/vista/$this->url.php")) {
  require_once "app/vista/$this->url.php";
} else {
  echo "La ruta no existe";
}