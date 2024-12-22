<?php
get_header();
the_component('full-width-media', array(
  'hide_content' => get_field('404_hide_content', 'option'),
  'media_type' => get_field('404_media_type', 'option'),
  'dimension_mobile' => get_field('404_dimension_mobile', 'option'),
  'image' => get_field('404_image', 'option'),
  'video' => get_field('404_video', 'option'),
  'text_color' => get_field('404_text_color', 'option'),
  'cta_colour' => get_field('404_cta_color', 'option'),
  'heading' => get_field('404_heading', 'option'),
  'description' => get_field('404_description', 'option'),
  'ctas' => get_field('404_ctas', 'option'),
  'content_hidden' => get_field('404_content_hidden', 'option'),
  'bottom_spacing' => get_field('404_bottom_spacing', 'option'),
  'colour_choices' => get_field('404_colour_choices', 'option'),
  'text_align' => get_field('404_text_align', 'option'),
  'content_heading' => get_field('404_content_heading', 'option'),
  'content_description' => get_field('404_content_description', 'option'),
  'content_ctas' => get_field('404_content_ctas', 'option'),
  'index' => 1
));

get_footer();
?>
