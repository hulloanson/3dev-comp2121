<?php
enqueue_style( 'style', 'all' );
enqueue_script( 'home' );
?>
This is the home page. Testing PDOHelper too.
<pre>
<?php
//$session  = new Session();
//$session->id = random_bytes(128);
//$session->user_id = 1;
//$session = $session->save();
$user = User::find(1);
var_dump($user);
foreach ($user as $key => $value) {
  echo "Key: ${key}, Value: ${value}<br>";
}
?>
</pre>

