<?php
get_header();

while ( have_posts() ) {

  the_post();

  echo '<section class="py-10 lg:py-20">';
    echo '<div class="container wysiwyg">';
      the_content_blocks();
    echo '</div>';
  echo '</section>';
}

get_footer();

