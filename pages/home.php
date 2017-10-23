<?php
enqueue_style('style', 'all');
enqueue_script('home');
?>
This is the home page. Testing PDOHelper too.
<pre>
<?php
try {
  \PDOHelper::exec('INSERT INTO `snacks`.`user` (password, email) VALUES (:pw, :email)', [
      ':pw' => password_hash('shit', PASSWORD_DEFAULT),
      ':email' => 'test@gmail.com'
  ]);
  var_dump(\PDOHelper::fetch('select * from `snacks`.user;'));
} catch(\Exception $e) {
  var_dump($e);
}
?>
</pre>

