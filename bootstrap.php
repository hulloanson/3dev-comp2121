<?php
register_shutdown_function( function() {
  $error = error_get_last();
  if( $error !== NULL) {
    echo 'Hell!';
  }
});

/* Constants */
define('APP_ROOT', __DIR__);

spl_autoload_register(function ($class) {
  include "classes/${class}.php";
});

