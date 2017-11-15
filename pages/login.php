<?php
/**
 * Created by: ycl
 * Date: 10/11/2017
 * Time: 12:54 AM
 */
enqueue_style('login');

?>

<div>
  <h1>Login Page</h1>
  <form method="POST" action="<?= web('/api') ?>">
    <label>
      Phone: <input type="text" name="phone">
    </label>
    <label>
      Password: <input type="password" name="password">
    </label>
  </form>
</div>
