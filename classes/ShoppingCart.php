<?php

class ShoppingCart extends Model
{
  protected $user;
  protected $items;
  protected $table = 'shopping_cart';

  public function add($item)
  {
    $sql = 'INSERT INTO ' .   . ' (`user_id`, `product_id`, `qty`) VALUES (?, ?, ?)';
  }

  public function remove($item)
  {

  }

  public function load()
  {
    $sql = 'SELECT * FROM ' . $this->table . ' WHERE `user_id` = ' . $this->user->id;
  }
}
