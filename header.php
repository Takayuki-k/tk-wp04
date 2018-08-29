<!doctype html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="format-detection" content="telephone=no, email=no, address=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <?php if ( is_category() ):?>
    <meta name="description" content="<?php echo get_meta_description_from_category(); ?>">
  <?php endif; ?>
  <?php get_template_part("favicon"); ?>
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?> id="top-body">
  <header class="">
    <aside class="grid">
      <div class="col-7_sm-12 blog-description"><?php bloginfo('description'); ?></div>
      <div class="col-5_sm-12"><?php get_search_form(); ?></div>
    </aside>
    <h1><?php bloginfo('name'); ?></h1>
    <h2>～日記的な備忘録</h2>
    <nav><?php wp_nav_menu(); ?></nav>
  </header>
  <div id="container" class="grid">
    <main class="col-9_md-12">
