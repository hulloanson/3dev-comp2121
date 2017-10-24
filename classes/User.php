<?php 

class User extends Model {
  public function __set( $name, $value ) {
    if ($name === 'password') $value = password_hash($value, PASSWORD_DEFAULT);
    parent::__set($name, $value);
  }
  protected function pre_save() {
    if ($this->email && !$this->id) {
      if (self::email_dup($this->email))
        throw new \Exception('new user dup email');
    }
  }
  public static function email_dup($email) {
    return !empty(self::search((['email' => $email])));
  }
}
