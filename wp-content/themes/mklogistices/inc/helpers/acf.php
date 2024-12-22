<?php

if( function_exists('acf_add_options_page') ) {

  acf_add_options_page(array(
    'page_title' => __('Theme Options', 'mklogistics'),
    'menu_title' => __('Theme Options', 'mklogistics'),
    'menu_slug' => 'theme-options',
    'capability' => 'edit_posts',
    'redirect' => false
  ));

};

function sls_base_populate_gf_forms_ids( $field ) {
  if ( class_exists( 'GFFormsModel' ) ) {
    $choices = [];

    foreach ( \GFFormsModel::get_forms() as $form ) {
      $choices[ $form->id ] = $form->title;
    }

    $field['choices'] = $choices;
  }

  return $field;
}
add_filter( 'acf/load_field/name=form_id', 'sls_base_populate_gf_forms_ids' );

add_filter('acfe/flexible/thumbnail/name=page_builder', 'acf_flexible_layout_thumbnail', 10, 3);

function acf_flexible_layout_thumbnail($thumbnail, $field, $layout)
{
	return get_bloginfo('template_directory') . '/assets/img/thumb/' . $layout['name'] . '.jpg';
}
