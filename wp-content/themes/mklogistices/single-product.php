<?php
get_header();

/**
 * woocommerce_before_main_content hook.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 */
do_action('woocommerce_before_main_content');

while ( have_posts() ) {

  the_post();

  the_content_blocks();

}

get_footer();

