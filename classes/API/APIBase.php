<?php
/**
 * Created by: ycl
 * Date: 10/11/2017
 * Time: 1:16 AM
 */
namespace API;

class APIBase
{
  function indexAction() {
    echo 'This is the parent API page. Please override.';
  }
}