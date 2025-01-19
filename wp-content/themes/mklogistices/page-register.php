<?php
  /**
   * Template Name: Đăng nhập, Đăng Ký
   */

  get_header();

  while ( have_posts() ) {
    the_post();

    echo '<section class="my-register py-20 bg-white">';
      echo '<div class="container relative">';

        if ( is_page( 'dang-ky' ) ) {
          echo '<h2 class="my-register__title">Đăng Ký</h2>';
        }
        the_content();
      echo '</div>';
    echo '</section>';
  }

  get_footer();
?>
