<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" >
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet">
    <link rel="preload" as="font" href="<?= get_bloginfo('template_directory') . '/src/fonts/GTSuperDisplay-Regular.woff2' ?>" type="font/woff2" crossorigin>
    <link rel="preload" as="font" href="<?= get_bloginfo('template_directory') . '/src/fonts/GTSuperDisplay-Regular.woff' ?>" type="font/woff" crossorigin>
    <link rel="preload" as="font" href="<?= get_bloginfo('template_directory') . '/src/fonts/GTSuperDisplay-RegularItalic.woff2' ?>" type="font/woff2" crossorigin>
    <link rel="preload" as="font" href="<?= get_bloginfo('template_directory') . '/src/fonts/GTSuperDisplay-RegularItalic.woff' ?>" type="font/woff" crossorigin>
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
  <div id="fb-root"></div>
  <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v21.0&appId=225630991176433"></script>
  <a class="skip_link" id="skip_to_content" href="#main_content"><span class="button__text">Skip to Main Content</span></a>
  <?php the_component('header'); ?>
  <main class="main js-main bg-gray" id="main_content">
  <?php
    if ( is_single() ) {
      the_component(
        'top-bar',
        array(
          'text' => get_field( 'topbar_text', 'option' )
        )
      );

      the_component(
        'hero',
        array(
          'background'  => get_field( 'hero_background', 'option' ),
          'title'       => get_field( 'hero_title', 'option' ),
          'description' => get_field( 'hero_description', 'option' ),
        )
      );

      the_component( 'breadcrumbs' );
    }
  ?>
