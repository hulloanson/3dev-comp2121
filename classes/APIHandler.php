<?php
/**
 * Created by: ycl
 * Date: 10/11/2017
 * Time: 1:05 AM
 */

class APIHandler
{
  function handle() {
    global $req;
    if (count($req) < 2 ) {
      echo 'This is the api page';
      exit;
    } else {
      $handler_class = 'API\\' . hyphen_to_camel($req[1]);
      $handler_action = (isset($req[2]) ? hyphen_to_camel($req[2]) : 'index') . 'Action';
      (new $handler_class)->$handler_action();
    }
  }
}