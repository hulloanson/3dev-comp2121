<?php

class ShoppingCart extends Model
{
  public static $belongs_to = [
    'user' => 'User'
  ];
}
