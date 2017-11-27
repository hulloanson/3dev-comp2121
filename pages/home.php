<?php
enqueue_style('style');
enqueue_script('home');
?>
This is the home page.
<pre>
  <?php
  $session = Session::search(['user_id' => 1], true);
  $date_time = new \DateTime($session->started);
  ?>
</pre>


