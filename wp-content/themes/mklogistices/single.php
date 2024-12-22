<?php
get_header();

while ( have_posts() ) {

  the_post();

  the_content_blocks();

}

get_footer();

