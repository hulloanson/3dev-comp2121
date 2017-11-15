<?php
/**
 * Created by: ycl
 * Date: 10/11/2017
 * Time: 1:25 AM
 */

namespace API;


use \User as User;

class Login extends APIBase
{
  function indexAction()
  {
    // Find user
    $login = $_POST['login'];
    $password = $_POST['password'];
  }
}