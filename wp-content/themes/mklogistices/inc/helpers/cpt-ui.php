<?php
/**
 * Saves post type and taxonomy data to JSON files in the theme directory.
 * Ref: https://docs.pluginize.com/article/84-save-cptui-settings-data-to-file
 * @param array $data Array of post type data that was just saved.
 */
function pluginize_local_cptui_data($data = array()) {
  $theme_dir = get_stylesheet_directory();
  // Create our directory if it doesn't exist.
  if (!is_dir($theme_dir .= '/cptui_data')) {
    mkdir($theme_dir, 0755);
  }

  if (array_key_exists('cpt_custom_post_type', $data)) {
    // Fetch all of our post types and encode into JSON.
    $cptui_post_types = get_option('cptui_post_types', array());
    $content = json_encode($cptui_post_types, JSON_PRETTY_PRINT);
    // Save the encoded JSON to a primary file holding all of them.
    file_put_contents($theme_dir . '/cptui_post_type_data.json', $content);
  }

  if (array_key_exists('cpt_custom_tax', $data)) {
    // Fetch all of our taxonomies and encode into JSON.
    $cptui_taxonomies = get_option('cptui_taxonomies', array());
    $content = json_encode($cptui_taxonomies, JSON_PRETTY_PRINT);
    // Save the encoded JSON to a primary file holding all of them.
    file_put_contents($theme_dir . '/cptui_taxonomy_data.json', $content);
  }
}

add_action('cptui_after_update_post_type', 'pluginize_local_cptui_data');
add_action('cptui_after_update_taxonomy', 'pluginize_local_cptui_data');

/* Filter CPT via Custom Taxonomy */
function filter_backend_by_taxonomies( $post_type, $which ) {
  // CPTS has filters
  $cpts = array( 'download' );

  // Apply this to a specific CPT
  if ( !in_array($post_type, $cpts) ) return;

  // A list of custom taxonomy slugs to filter by
  $taxonomies = array( 'download_category' );

  foreach ( $taxonomies as $taxonomy_slug ) {
    // Retrieve taxonomy data
    $taxonomy_obj = get_taxonomy( $taxonomy_slug );
    $taxonomy_name = $taxonomy_obj->labels->name;

    // Retrieve taxonomy terms
    $terms = get_terms( $taxonomy_slug );

    // Display filter HTML
    echo "<select name='{$taxonomy_slug}' id='{$taxonomy_slug}' class='postform'>";
    echo '<option value="">' . sprintf( esc_html__( 'Show All %s', 'mklogistics' ), $taxonomy_name ) . '</option>';
    foreach ( $terms as $term ) {
      printf(
        '<option value="%1$s" %2$s>%3$s (%4$s)</option>',
        $term->slug,
        ( ( isset( $_GET[$taxonomy_slug] ) && ( $_GET[$taxonomy_slug] == $term->slug ) ) ? ' selected="selected"' : '' ),
        $term->name,
        $term->count
      );
    }
    echo '</select>';
  }
}
add_action( 'restrict_manage_posts', 'filter_backend_by_taxonomies' , 99, 2);
