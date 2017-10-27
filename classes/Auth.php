<?php
/**
 * Created by: ycl
 * Date: 23/10/2017
 * Time: 4:42 AM
 */

class Auth
{
  public function login($email, $password) {
    if (($user = User::search([ 'email' => $email ], true) === null)) return false;
    return password_verify($password, $user->password) ? $user : false;
  }

  public function session_login($session_id) {
    if (($session = Session::find($session_id)) === null)
      return false;
    return $session->user;
  }
}