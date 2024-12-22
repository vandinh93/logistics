<?php

abstract class SLS_Theme_Base {
  public $acf_json_path;

  /**
  * Constructor: Filters and Actions.
  * @return  void
  */
  public function __construct(){
    add_filter( 'acf/settings/save_json', array( &$this, 'acf_json_save_point' ) );
    add_filter( 'acf/settings/load_json', array( &$this, 'acf_json_load_point' ) );
  }

  /**
  * The path where JSON files are created when ACF field groups are saved/updated
  * @param string path of save point
  * @return string path of save point
  * @link http://www.advancedcustomfields.com/resources/local-json/
  * @link http://www.advancedcustomfields.com/resources/synchronized-json/
  */
  public function acf_json_save_point( $path ) {
    return $this->acf_json_path;
  }

  /**
  * The path where JSON files are loaded when ACF field groups are initialized
  * @param array of string paths of load point(s)
  * @return array of string paths of load point(s)
  * @link http://www.advancedcustomfields.com/resources/local-json/
  * @link http://www.advancedcustomfields.com/resources/synchronized-json/
  */
  public function acf_json_load_point($paths) {
    return array($this->acf_json_path);
  }
}
