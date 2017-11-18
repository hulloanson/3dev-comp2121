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
      //
      header('Location: ' . web('/'));
    }
    if ($user instanceof User) {
      echo 'Logged in! Welcome, ' . $user->name;
      return;
    } else if (isset($_COOKIE['SNACKSESS'])) {
      Auth::session_login($_COOKIE['SNACKSESS']);
      echo 'Welcome back, ' . $user->name;
      return;
    } else {
      // Find user
//      if ($_SERVER['REQUEST_METHOD'] !== 'POST') throw new \Exception('wrong request method');
      $login = $_GET['login'];
      $password = $_GET['password'];
//      $login = $_POST['login'];
//      $password = $_POST['password'];
      Auth::login($login, $password);
    }
  }
}