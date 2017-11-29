<?php
/**
 * Created by: ycl
 * Date: 10/11/2017
 * Time: 1:25 AM
 */

namespace API;


use \User as User;
use \Auth as Auth;

class Login extends APIBase
{
  function indexAction()
  {
    try {
      if (\Auth::logged_in()) {
        throw new \Exception('logged in');
      }
      if (isset($_COOKIE['SNACKSESS'])) {
        Auth::session_login();
      } else {
        if (!isset($_POST['username']) || !isset($_POST['password'])) {
          throw new \Exception('invalid data');
        }
        Auth::login($_POST['username'], $_POST['password']);
      }
      global $user;
      self::sendOK([
          'username' => $user->username
      ]);
    } catch (\Exception $e) {
      self::sendError($e->getMessage());
    }
  }
}