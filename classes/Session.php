<?php


class Session extends Model {
  public static $belongs_to = [
    'user' => 'User'
  ];
  public function expired() {
    if (!$this->started) throw new \Exception('Incomplete instance of ' . static::class);
  }
}