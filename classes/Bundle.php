<?php
/**
 * Created by: ycl
 * Date: 26/10/2017
 * Time: 7:15 PM
 */

class Bundle extends Product
{
  public static $has_many = [
    'items' => 'BundleItem'
  ];
}