<?php
/**
 * Woocommerce theme hooks
 *
 * @package mklogistics
 */

add_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);

add_action( 'woocommerce_before_main_content',      'sls_shop_before_content',  10 );
add_action( 'woocommerce_after_main_content',       'sls_shop_after_content',   10 );
