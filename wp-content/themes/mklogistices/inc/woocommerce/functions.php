<?php
/**
 * Woocommerce theme functions
 *
 * @package mklogistics
 */

/** Woocommerce ***************************************************************/

/**
 * Before shop content
 */
function sls_shop_before_content() {
  do_action( 'sls_shop_before_content' ); ?>
  <div class="container">
  <?php
}

/**
 * After shop content
 */
function sls_shop_after_content() { ?>
  </div><!-- end:container -->
  <?php
  do_action( 'sls_shop_after_content' );
}
