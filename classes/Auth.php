<?php
/**
 * Created by: ycl
 * Date: 16/11/2017
 * Time: 10:50 AM
 */

class Auth
{
  public static function logged_in() {
    global $user;
    return $user !== null;
  }

  public static function login($email, $password) {
    if (self::logged_in()) return;
    if (($user = User::search([ 'email' => $email ], true) === null)) {
      throw new \Exception('user not found');
    }
    if (password_verify($password, $user->password)) {
      throw new \Exception('password mismatch');
    }
  }

  public static function session_login($session_id) {
    if (($session = Session::find($session_id)) === null) return false;
    return $session->user;
  }

  public static function init_session() {
    session_start();
  }
}