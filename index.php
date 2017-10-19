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
  ini_set('display_errors', 'Off');
}

/* App Router */

require_once 'bootstrap.php';

require_once APP_ROOT . '/config/load.php';

require_once APP_ROOT . '/system/load.php';

try {
  /**
   * @var array $req An array representing a GET request.
   * @var array $req[0] Page
   * @var array $req[1] Action on the specified page
   * @var array $req[2] Data on the action
   */
  $req = isset($_REQUEST['param']) ? explode('/', $_REQUEST['param']) : [];

  $res = [];
  (new View)->render();
//  (new View)->render(empty($req) ? 'home' : $req[0]);

} catch (\Exception $e) {
  var_export($e->getTraceAsString());
}

