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
  function indexAction()
  {
    echo 'This is the parent API page. Please override.';
  }

  protected static function sendJson($data, $err)
  {
    header('Content-Type: Application/JSON');
    $response = ['result' => $err ? 'err' : 'ok'];
    if ($data !== null) {
      $response['data'] = $data;
    }
    echo json_encode($response);
    exit;
  }

  protected static function sendOK($data = null)
  {
    self::sendJson($data, false);
  }

  protected static function sendError($data = null)
  {
    self::sendJson($data, true);
  }
}