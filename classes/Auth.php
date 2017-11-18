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
    if (($incomingUser = User::search([ 'email' => $email ], true)) === null) {
      throw new \Exception('user not found');
    }
    if (password_verify($password, $incomingUser->password)) {
      throw new \Exception('password mismatch');
    }
    global $user;
    $user = $incomingUser;
    // Assign a session
    $session_id = (new Session([
      'user_id' => $user->id
    ]))->save();
    setcookie('SNACKSESS', $session_id);
  }

  public static function session_login($session_id) {
    global $user;
    if (($session = Session::find($session_id)) === null) throw new \Exception('session not found');
    if (!($user = $session->user) instanceof User) throw new \Exception('missing user in session');
    if (($session->expired())) throw new \Exception('session expired');
    $user = $session->user;
    return true;
  }

  public static function init_session() {
    session_start();
  }
}