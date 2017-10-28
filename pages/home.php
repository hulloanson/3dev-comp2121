<?php
enqueue_style( 'style', 'all' );
enqueue_script( 'home' );
?>
This is the home page. Testing PDOHelper too.
<pre>
<?php
$obj = new stdClass;
$obj->product_id = 1;
$str = "product";
echo $obj->{"${str}_id"};
?>
</pre>

