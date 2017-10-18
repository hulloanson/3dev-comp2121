<?php
function from_root($path) {
  return path_join(APP_ROOT, $path);
}

function path_join() {
  $paths = array();

  foreach (func_get_args() as $arg) {
    if ($arg !== '') { $paths[] = $arg; }
  }

  return preg_replace('#/+#','/',join('/', $paths));
}

function page($page_name) {
  return path_join(PAGE_DIR, $page_name) . '.php';
}