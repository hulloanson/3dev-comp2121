<?php
/**
 * Created by: ycl
 * Date: 18/10/2017
 * Time: 7:00 PM
 */
//phpinfo();
//exit;

define('DEBUG', true);
if (!DEBUG) {
  error_reporting(E_ERROR);
  ini_set('display_errors', 'On');
}

/* App Router */
require_once 'bootstrap_webroot.php';
require_once 'bootstrap.php';

require_once APP_ROOT . '/config/load.php';

require_once APP_ROOT . '/system/load.php';

try {
  // Explode params by slash
  /**
   * @var array $req An array representing a GET request.
   * @var array $req[0] Page
   * @var array $req[1] Action on the specified page
   * @var array $req[2] Data on the action
   */
  $req = isset($_REQUEST['param']) ? preg_split('/\\//', $_REQUEST['param'], -1,  PREG_SPLIT_NO_EMPTY) : [];
  $res = [];
  // Load user, if any
  // TODO: load user as top-level object on start
  $user = null;
  if (isset($req[0]) && strtolower($req[0]) == 'api') {
    (new APIHandler)->handle();
  } else {
    (new View)->render();
  }
} catch (\Exception $e) {
//  var_export($e->getTraceAsString());
  throw $e;
}

