<?php
  get_header();

  while ( have_posts() ) {

    the_post();

    the_component('page-builder');

    if ( !is_front_page() ) {
      echo '<section class="py-10 lg:py-20">';
        echo '<div class="container wysiwyg">';
          the_content();
        echo '</div>';
      echo '</section>';
    }
  }

  get_footer();
?>
