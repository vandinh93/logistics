<?php
/**
 * Pass arguments into a component and get returned HTML
 *
 * @param string $component_name Name of component
 * @param array $args Key-value pairs which will be extracted as variables in component templates
 * @return string
 */
function get_component( $component_name, $args = array() ) {
  ob_start();
  the_component( $component_name, $args );
  return ob_get_clean();
}

/**
 * Pass arguments into a component and render its HTML output
 * @param string $component_name Name of component
 * @param array $args Key-value pairs which will be extracted as variables in component templates
 * @return void
 */
function the_component( $component_name, $args = array() ) {
  if ( empty( $component_name ) ) {
    return;
  }

  extract( $args, EXTR_SKIP );
  $component_path = "/components/$component_name/$component_name.php";

  if (strpos($component_name, '/') !== false) {
    $component_path = "/$component_name.php";
  }

  include( TEMPLATEPATH . $component_path );
}
