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
  <body <?php body_class('flex flex-col [&.is-active-slideout]:overflow-hidden'); ?> style="overflow: hidden" data-barba="wrapper">
  <a class="skip_link" id="skip_to_content" href="#main_content"><span class="button__text">Skip to Main Content</span></a>
  <?php wp_body_open(); ?>
  <div class="loading js-loading" style="position: fixed; top: 0; left: 0; right: 0; bottom: 0; z-index: 9999;">
    <div class="loading-panel js-loading-panel" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; z-index: 1; background-color: #162E26; overflow: hidden; display: flex; align-items: center; justify-content: center;">
      <svg xmlns="http://www.w3.org/2000/svg" width="71" height="64" viewBox="0 0 71 64" fill="none">
        <path d="M0 63.5937V37.0862H5.98272V63.5937H0Z" fill="white"/>
        <path d="M12.9152 63.5937V37.0862H22.5243C30.4888 37.0862 35.8359 42.1707 35.8359 50.3592C35.8359 58.5478 30.4888 63.5949 22.488 63.5949H12.9164L12.9152 63.5937ZM22.2621 58.0223C26.338 58.0223 29.6659 55.6673 29.6659 50.3581C29.6659 45.0489 26.338 42.6564 22.2621 42.6564H18.8218V58.0223H22.2621Z" fill="white"/>
        <path d="M48.7645 58.2096L46.8577 63.5937H40.6514L50.6351 37.0862H57.477L67.3483 63.5937H60.9172L59.0104 58.2096H48.7645ZM50.7088 52.8254H57.1399L53.9618 43.6654L50.7088 52.8254Z" fill="white"/>
        <path d="M38.6564 14.6203H37.8347V63.5937H38.6564V14.6203Z" fill="white"/>
        <path d="M70.0632 0H69.3479V63.5937H70.0632V0Z" fill="white"/>
        <path d="M9.85591 27.898H9.03418V63.5937H9.85591V27.898Z" fill="white"/>
      </svg>
    </div>
  </div>
  <?php the_component('header'); ?>
  <main class="main js-main bg-gray" id="main_content" data-barba="container" >
