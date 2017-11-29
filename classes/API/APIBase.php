<?php
/**
 * Created by: ycl
 * Date: 10/11/2017
 * Time: 1:16 AM
 */
namespace API;

class APIBase
{
  // TODO: redirect to 404 when action not found. Do the same with pages.
  function indexAction() {
    echo 'This is the parent API page. Please override.';
  }

  protected static function sendJson($data) {
    header('Content-Type: Application/JSON');
    echo json_encode($data);
    exit;
  }

  protected static function sendOK($data = null) {
    $json_res = ['result' => 'OK'];
    if ($data !== null) {
      $json_res['data'] = $data;
    }
    self::sendJson($json_res);
  }
}