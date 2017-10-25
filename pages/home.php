<?php
enqueue_style( 'style', 'all' );
enqueue_script( 'home' );
?>
This is the home page. Testing PDOHelper too.
<pre>
<?php
$user           = new User;
$user->email    = 'mam@gmail.com';
$user->password = 'shit';
var_dump($user->save());
//$user->id = $id;
//$user->email = 'hoho@gmail.com';
?>
</pre>

