<?php

const url_regex = '/^https?:\/\/(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&\/\/=]*)$/';

/**
 * Add scripts to global $res variable
 * @param string[] ...$scripts
 */
function enqueue_script(...$scripts)
{
  global $res;
  if (!isset($res['scripts'])) {
    $res['scripts'] = [];
  }
  foreach ($scripts as $script) {
    if (preg_match(url_regex, $script)) {
      $res['scripts'][] = $script;
    } else {
      $res['scripts'][] = script($script);
    }
  }
}

/**
 * Add stylesheets to global $res variable
 * @param string[] ...$styles
 */
function enqueue_style(...$styles)
{
  global $res;
  if (!isset($res['styles'])) {
    $res['styles'] = [];
  }
  foreach ($styles as $style) {
    if (preg_match(url_regex, $style)) {
      $res['styles'][] = $style;
    } else {
      $res['styles'][] = style($style);
    }
  }
}

//function redirect($url) {
//  header("Location:")
//}
