<?php
register_shutdown_function( function() {
  $error = error_get_last();
  if( $error !== NULL) {
    echo 'Hell!';
  }
});

/* Constants */
define('APP_ROOT', __DIR__);

require_once APP_ROOT . '/vendor/autoload.php';

spl_autoload_register(function ($class) {
//  throw new Exception('Holy yeah!' . var_export($class, true));
  $class_path = preg_replace('/(\\\)/', '/', ucwords($class, '\\'));
  include_once "classes/${class_path}.php";
});

