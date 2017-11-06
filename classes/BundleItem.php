<?php
/**
 * Created by: ycl
 * Date: 28/10/2017
 * Time: 8:57 PM
 */

class BundleItem extends Model
{
  public static $belongs_to = [
    'bundle' => 'Bundle'
  ];
}