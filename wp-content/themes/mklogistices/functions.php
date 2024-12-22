<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) )
  exit;

add_action( 'admin_notices', 'sls_base_plugin_dependencies' );

function sls_base_plugin_dependencies() {
  if( ! function_exists('get_field') )
    echo '<div class="error"><p>' . __( 'Warning: The theme needs Plugin Advanced Custom Fields PRO to function.', 'mklogistics' ) . '</p></div>';
}

// Backend only
require_once( __DIR__ . '/inc/helpers/blocks.php' );
require_once( __DIR__ . '/inc/theme-init.php' );
include "inc/inc.vite.php";

// Global helpers
require_once( __DIR__ . '/inc/helpers/scripts.php' );
require_once( __DIR__ . '/inc/helpers/components.php' );
require_once( __DIR__ . '/inc/helpers/media.php' );
require_once( __DIR__ . '/inc/helpers/acf.php' );
require_once( __DIR__ . '/inc/helpers/cpt-ui.php' );
require_once( __DIR__ . '/inc/helpers/utils.php' );
require_once( __DIR__ . '/inc/helpers/gravity-form.php' );

// Custom Woocommerce templates
require_once( __DIR__ . '/inc/woocommerce/functions.php' );
require_once( __DIR__ . '/inc/woocommerce/hooks.php' );

add_action( 'init', 'register_acf_blocks', 5 );
function register_acf_blocks() {
  register_block_type( __DIR__ . '/components/hero' );
}
