<?php

include_once( __DIR__ . '/base-blocks.php' );

class SLS_Blocks extends SLS_Blocks_Base {
  /**
  *
  *  Add hooks
  *
  */
  public function __construct() {

    $this->excluded_page_ids = array();

    parent::__construct();

  }

}
