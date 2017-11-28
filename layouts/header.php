<?php
global $user;
$greetings = ($user === null ? '<a href="' . web('login') .'">Not logged in</a>' :
    ($user->name ? 'Welcome, ' . $user->name . '!' : 'err: No Name')
);
?>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta lang="en-GB">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>WhatSnacks</title>
  <!-- Latest compiled and minified CSS -->
<!--  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">-->

  <!-- Latest compiled and minified JavaScript -->
<!--  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>-->

  <script src="<?= script('jquery.min') ?>"></script>
  <script src="<?= script('amazeui.min') ?>"></script>

  <link rel="stylesheet" href="<?= style('all')?>">
  <link rel="stylesheet" href="<?= style('header') ?>">
  <link rel="stylesheet" href="<?= style('font-awesome')?>">
  <link rel="stylesheet" href="<?= style('amazeui.min')?>">
  <link rel="stylesheet" href="<?= style('style')?>">

  <?php echo $styles; ?>
</head>
<body>
<!--<header>-->
<!--  <span class="title">Snacks in Time</span>-->
<!--  <span >--><?//= $greetings?><!--</span>-->
<!--</header>-->
<header data-am-widget="header" class="am-header  am-header-default am-header-fixed header">
  <div class="am-header-left am-header-nav">
    <a href="#left-link" class="">
      <i class="am-header-icon am-icon-angle-left"></i>
    </a>
  </div>
  <h1 class="am-header-title"> <a href="<?= web('/') ?>" class="" style="color: #333;">WhatSnacks</a></h1>
  <div class="am-header-right am-header-nav">
    <a href="#right-link" class=""> </a>
  </div>
</header>
<div class="snacks-content">
