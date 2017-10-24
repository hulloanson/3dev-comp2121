<?php

class ShoppingCart extends Model
{
  protected $user;
  protected $items;
  protected $table = 'shopping_cart';

  public function load()
  {
    $sql = 'SELECT * FROM ' . $this->table . ' WHERE `user_id` = ' . $this->user->id;
  }
}
