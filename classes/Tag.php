<?php
/**
 * Created by: ycl
 * Date: 11/30/17
 * Time: 12:10 AM
 */

class Tag extends Model
{
  protected static $has_many_through = [
    'products' => [
      'through' => 'product_tag',
      'model' => 'Product'
    ]
  ];
}