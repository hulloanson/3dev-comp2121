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

  function email() {
//    if (isset($_POST['email']))
  }
}