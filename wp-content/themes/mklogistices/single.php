<?php
get_header();

while ( have_posts() ) {

  the_post();

  echo '<section class="py-10 lg:py-20">';
    echo '<div class="container !max-w-[1200px] wysiwyg">';
      the_content_blocks();
    echo '</div>';
  echo '</section>';
}

get_footer();

