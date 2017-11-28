<?php
enqueue_style('style');
enqueue_style('home');
enqueue_script('home');
?>
<div data-am-widget="slider" class="am-slider am-slider-default" data-am-slider='{}' >
  <ul class="am-slides">
    <li><img src="<?= image('banner.png') ?>"> </li>
    <li><img src="<?= image('banner1.png') ?>"> </li>
  </ul>
</div>
<ul class="nav">
  <li>
    <a href="<?= web('recommends') ?>">
      <img src="<?= image('icon.jpg') ?>" />
      <p class='nav-title'>Recommended</p>
    </a>
  </li>
  <li>
    <a href="<?= web('hot') ?>">
      <img src="<?= image('icon1.jpg') ?>" />
      <p class='nav-title'>Hottest</p>
    </a>
  </li>
  <li>
    <a href="<?= web('account/collection') ?>">
      <img src="<?= image('icon2.jpg') ?>" />
      <p class='nav-title'>Collection</p>
    </a>
  </li>
  <li>
    <a href="<?= web('account/coupons') ?>">
      <img src="<?= image('icon3.jpg') ?>" />
      <p class='nav-title'>Coupon</p>
    </a>
  </li>
</ul>
<div data-am-widget="titlebar" class="am-titlebar am-titlebar-default title" >
  <h2 class="am-titlebar-title ">   Limited Time Offer! </h2>
  <nav class="am-titlebar-nav">
    <a href="#more" class="">more &raquo;</a>
  </nav>
</div>
<ul data-am-widget="gallery" class="am-gallery am-avg-sm-2 am-avg-md-3 am-avg-lg-4 am-gallery-default product">
  <li class="am-gallery-item am-padding-sm" >
    <div>
      <a href="detail.html" class="">
        <img src="<?= image('p.png') ?>"  alt=""/>
        <h3 class="am-gallery-title">Hawthorn Ice-sugar Gourd</h3>
        <div class="am-gallery-desc">
          <em>$8</em><i class="am-icon-cart-plus"></i>
        </div>
      </a>
    </div>
  </li>
  <li class="am-gallery-item am-padding-sm" >
    <div>
      <a href="detail.html" class="">
        <img src="<?= image('p1.png') ?>"  alt=""/>
        <h3 class="am-gallery-title">"Fuji Lollipops</h3>
        <div class="am-gallery-desc">
          <em>$3</em><i class="am-icon-cart-plus"></i>
        </div>
      </a>
    </div>
  </li>
  <li class="am-gallery-item am-padding-sm" >
    <div>
      <a href="detail.html" class="">
        <img src="<?= image('p2.png') ?>"  alt=""/>
        <h3 class="am-gallery-title">White Rabbit Toffee</h3>
        <div class="am-gallery-desc">
          <em>$3</em><i class="am-icon-cart-plus"></i>
        </div>
      </a>
    </div>
  </li>
  <li class="am-gallery-item am-padding-sm" >
    <div>
      <a href="detail.html" class="">
        <img src="<?= image('p3.png') ?>"  alt=""/>
        <h3 class="am-gallery-title">Persimmon Cake</h3>
        <div class="am-gallery-desc">
          <em>$5</em><i class="am-icon-cart-plus"></i>
        </div>
      </a>
    </div>
  </li>
</ul>
