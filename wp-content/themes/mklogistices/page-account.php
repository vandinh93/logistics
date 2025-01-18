<?php
  /**
   * Template Name: My Account
   */

  get_header();

  while ( have_posts() ) {
    the_post();

    echo '<section class="my-account py-20 bg-white">';
      echo '<div class="container">';
        the_content();
      echo '</div>';
    echo '</section>';
  }

  get_footer();
?>
