<?php
  get_header();

  while ( have_posts() ) {

    the_post();

    the_component('page-builder');

  }

  get_footer();
?>
