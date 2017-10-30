<?php
/**
 * Created by: ycl
 * Date: 28/10/2017
 * Time: 2:25 PM
 */

class ProductTag extends Model
{
  public static $belongs_to = [
    'product' => 'Product'
  ];
}