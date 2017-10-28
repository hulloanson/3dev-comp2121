<?php

class ShoppingCart extends Model
{
  protected static $belongs_to = [
    'user' => 'User'
  ];
}
