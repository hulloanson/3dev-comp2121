<?php
/**
 * Created by: ycl
 * Date: 26/10/2017
 * Time: 7:15 PM
 */

class Bundle extends Product
{
  protected static $has_many = [
    'items' => 'BundleItem'
  ];
}