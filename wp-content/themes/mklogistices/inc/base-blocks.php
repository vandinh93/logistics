<?php
class SLS_Blocks_Base {

  /**
  *
  *  Add hooks
  *
  */
  public function __construct() {}

  /**
  *
  *  Equivalent to the_content() WP function
  *  Renders modules instead
  *
  */
  public function the_content($post = false){
    if(!$post) global $post;
    echo apply_filters('the_content', get_the_content($post));
  }

}
