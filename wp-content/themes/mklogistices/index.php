<?php
get_header();

while ( have_posts() ) {
  the_post();

  the_component('top-bar');
}

get_footer();
