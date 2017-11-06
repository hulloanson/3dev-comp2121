<?php

class User extends Model
{
  protected $cart = [];
  protected $wishlist = [];

  public static $has_many = [
    'sales' => 'Sales',
    'cart' => 'ShoppingCart'
  ];

  public function __set($name, $value)
  {
    if ($name === 'password') $value = password_hash($value, PASSWORD_DEFAULT);
    parent::__set($name, $value);
  }

  protected function pre_save()
  {
    if ($this->email && !$this->id) {
      if (self::email_dup($this->email))
        throw new \Exception('new user dup email');
    }
  }

  public static function email_dup($email)
  {
    return !empty(self::search((['email' => $email])));
  }

  public function get_cart()
  {
    // TODO: User model: implement get_cart
    if (!$this->id)
      throw new \Exception('no user');
    return ShoppingCart::search(['user_id' => $this->id]);
  }

  public function add_to_cart($product_id, $qty) {
    $cart =  new ShoppingCart();
    $cart->user_id = $this->id;
    $cart->product_id = $product_id;
    $cart->qty = $qty;
    $cart->save();
  }

  public function get_wishlist()
  {
    // TODO: User model: implement get_wishlist
    if (!$this->id)
      throw new \Exception('no user');
    return WishList::search(['user_id' => $this->id]);
  }
}
