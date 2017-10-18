<?php
/**
 * Created by: ycl
 * Date: 18/10/2017
 * Time: 7:00 PM
 */
define('DEBUG', true);
if (DEBUG) {
  error_reporting(E_ERROR);
  ini_set('error_reporting', E_ERROR);
}

/* App Router */
define('APP_ROOT', __DIR__);

require_once APP_ROOT . '/system/load.php';

require_once APP_ROOT . '/config/load.php';

global $CONFIG;

define('PAGE_DIR', path_join(APP_ROOT, $CONFIG['page_dir']));

try {
  require_once from_root('/layouts/header.php');

  $page = page((isset($_REQUEST['page']) && $_REQUEST['page']
    ? $_REQUEST['page'] : 'home'));

  if (!is_file($page)) $page = get_404();

  require_once $page;

  require_once APP_ROOT . '/layouts/footer.php';

} catch (\Exception $e) {
  var_export($e->getTraceAsString());
}

