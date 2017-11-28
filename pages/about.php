<?php
/**
 * Created by: ycl
 * Date: 18/10/2017
 * Time: 10:20 PM
 */
?>
<div data-am-widget="slider" class="am-slider am-slider-default" data-am-slider='{}' >
  <ul class="am-slides">
    <li><img src="<?= image('banner1.png') ?>"> </li>
    <li><img src="<?= image('banner2.png') ?>"> </li>
  </ul>
</div>
<div class="am-tabs qiehuan" data-am-tabs>

  <ul class="am-tabs-nav am-nav am-nav-tabs">
    <li class="am-active"><a href="#tab1">Introduction</a></li>
    <li><a href="#tab2">Comment</a></li>
  </ul>
  <div class="am-tabs-bd">
    <div class="am-tab-panel am-fade am-in am-active" id="tab1">
      WhatSnacks is a online gift store that specializes in vintage snacks for elders.</br>
      We offer a wide array of childhood snacks, especially those re-creations from decades past.
<!--      <iframe src="map.html " width="100%" height="100%"></iframe>-->
<!--      TODO: google map, or not-->
    </div>
    <div class="am-tab-panel am-fade" id="tab2">
      <input type="text" placeholder="Full Name" class="tab-input" />
      <input type="text" placeholder="Phone Number" class="tab-input" />
      <textarea placeholder="Comment on WhatSnacks" class="tab-input"></textarea>
      <button type="button" class="tab-btn">Submission</button>
    </div>

  </div>
</div>

