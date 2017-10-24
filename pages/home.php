<?php
enqueue_style( 'style', 'all' );
enqueue_script( 'home' );
?>
This is the home page. Testing PDOHelper too.
<pre>
<?php
$user           = new User;
$user->email    = 'shit@gmail.com';
$user->password = 'shit';
var_dump($user->save());
$user2 = new User;
$user2->email = 'shit@gmail.com';
$user2->password = 'oi';
var_dump($user2->save());
//$user->id = $id;
//$user->email = 'hoho@gmail.com';
?>
</pre>

