<?php

function get_config($ns, $name = '')
{
  $config_file = APP_ROOT . "/config/${ns}.php";
  if (!is_file($config_file)) return null;
  $config = require $config_file;
  if (empty($name)) return $config;
  if (!isset($config[$name])) return null;
  return $config[$name];
}
