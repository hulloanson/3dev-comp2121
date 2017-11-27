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
  <form method="GET" action="<?= web('/api/login') ?>">
    <label>
      Phone: <input type="text" name="login">
    </label>
    <label>
      Password: <input type="password" name="password">
    </label>
    <input type="submit">
  </form>
</div>
