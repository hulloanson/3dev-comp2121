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
    global $user;
    if (Auth::logged_in()) {
//      http_redirect();
      // TODO: decide what to do when logged inn
    }
    if ($user instanceof User) {
      echo 'Logged in! Welcome, ' . $user->name;
      exit;
    } else if (isset($_COOKIE['PHPSESSID']) && Auth::session_login($_COOKIE['PHPSESSID']))  {

    } else {
      // Find user
      if ($_SERVER['REQUEST_METHOD'] !== 'POST') throw new \Exception('wrong request method');
      $login = $_POST['login'];
      $password = $_POST['password'];
      Auth::login($login, $password);
    }
  }
}