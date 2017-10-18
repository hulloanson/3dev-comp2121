<?php
/**
 * Created by: ycl
 * Date: 18/10/2017
 * Time: 7:45 PM
 */

function get_404() {
  http_response_code(404);
  return page('404');
}