<?php
/**
 * Created by: ycl
 * Date: 28/10/2017
 * Time: 8:38 PM
 */

class Sales extends Model
{
  public static $belongs_to = [
    'user' => 'User'
  ];

  public static $has_many = [
    'items' => 'SalesItem'
  ];
}