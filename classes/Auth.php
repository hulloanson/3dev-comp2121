<?php
/**
 * Created by: ycl
 * Date: 23/10/2017
 * Time: 4:42 AM
 */

class Auth
{
  public function login($email, $password) {
    if (($user = User::search([ 'email' => $email ]) === null)) return false;
    return password_verify($password, $user->password) ? $user : false;
  }
}