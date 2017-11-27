<?php


class Session extends Model {
  public static $belongs_to = [
    'user' => 'User'
  ];
  protected function pre_save()
  {
    // Add a sha-256 generated ID
    $this->id = random_bytes(128);
  }

  public function expired() {
    if ($this->started === null) throw new \Exception('session start date not set');
    return (new \DateTime($this->started))->diff(new \DateTime())->days >= 7;
  }
}