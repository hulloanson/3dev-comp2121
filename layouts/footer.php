</div>
<!--<br>This is the footer-->
<div data-am-widget="navbar" class="am-navbar am-cf am-navbar-default footer "  id="">
  <ul class="am-navbar-nav am-cf am-avg-sm-4">
    <li>
      <a href="<?= web('/') ?>" class="">
        <span class=""><img src="<?= image('nav.png') ?>"/></span>
        <span class="am-navbar-label">Home Page</span>
      </a>
    </li>
    <li>
<!--      TODO: create cart page-->
      <a href="<?= web('/cart') ?>" class="">
        <span class=""><img src="<?= image('nav2.png') ?>"/></span>
        <span class="am-navbar-label">Shopping Cart</span>
      </a>
    </li>
    <li>
<!--      TODO: complete about us page-->
      <a href="<?= web('/about') ?>" class="">
        <span class=""><img src="<?= image('nav3.png') ?>"/></span>
        <span class="am-navbar-label">About Us</span>
      </a>
    </li>
    <li >
      <a href="<?= web('/account') ?>" class="">
        <span class=""><img src="<?= image('nav4.png') ?>"/></span>
        <span class="am-navbar-label">My Account</span>
      </a>
    </li>

  </ul>
</div>
<?= $scripts ?>
</body>
</html>