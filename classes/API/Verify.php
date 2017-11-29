<?php
/**
 * Created by: ycl
 * Date: 11/29/17
 * Time: 9:12 PM
 */

namespace API;


class Verify extends APIBase
{
  function indexAction()
  {
    http_send_status(404);
  }

  function username() {
    try {
      if (!isset($_POST['username'])) {
        throw new \Exception('invalid data');
      }
      if (!empty(\User::search(['username' => $_POST['username']]))) throw new \Exception('dup');
      self::sendOK();
    } catch (\Exception $e) {
      self::sendError($e->getMessage());
    }
  }
}