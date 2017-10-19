<?php
/**
 * Created by: ycl
 * Date: 19/10/2017
 * Time: 11:16 AM
 */

/**
 * Read configuration from /config/load.php.
 * Not intended for use except in /index.php
 * Config object available in constant CONFIG as array
 * @return mixed
 */
function get_config() {
  return require app('config/load.php');
}

