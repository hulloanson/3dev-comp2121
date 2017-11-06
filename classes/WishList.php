<?php
/**
 * Created by: ycl
 * Date: 25/10/2017
 * Time: 10:16 AM
 */

class WishList extends Model
{
  public static $belongs_to = [
    'user' => 'User'
  ];
}