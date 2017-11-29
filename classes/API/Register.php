<?php
/**
 * Created by: ycl
 * Date: 11/29/17
 * Time: 5:30 PM
 */

namespace API;


class Register extends APIBase
{
  function indexAction() {
    try {
      if (\Auth::logged_in()) {
        throw new \Exception('logged in');
      }
      if (!isset($_POST['username']) || !isset($_POST['password'])) {
        throw new \Exception('invalid data');
      }
      $username = $_POST['username'];
      $password = $_POST['password'];
      \Auth::register($username, $password);
      \Auth::login($username, $password);
      self::sendOK([
          'username' => $username
      ]);
    } catch (\Exception $e) {
      self::sendJson([
          'err' => $e->getMessage()
      ]);
    }
  }
}