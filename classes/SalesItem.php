<?php
/**
 * Created by: ycl
 * Date: 28/10/2017
 * Time: 8:55 PM
 */

class SalesItem extends Model
{
  protected static $belongs_to = [
    'sales' => 'Sales'
  ];
}