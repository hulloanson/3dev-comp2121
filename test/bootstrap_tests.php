<?php

$pdo = null;

require_once '../vendor/autoload.php';

require_once '../bootstrap.php';

require_once APP_ROOT . '/config/load.php';

require_once APP_ROOT . '/system/load.php';

spl_autoload_register(function ($class) {
  include "../classes/${class}.php";
});
