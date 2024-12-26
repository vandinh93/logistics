<?php

function svg($data=false,$echo=true,$inline=false,$responsive=true){
  if ($inline):
    $return = _structure_svg($data,$responsive);
  else:
    $return = _get_svg($data);
  endif;

  if ($echo)
    echo $return;

  return $return;
}

function _structure_svg($data,$responsive){
  $return = '';
  $yes = preg_match('/viewBox="(.[^"]*)"/',$data,$matches);
  if ($yes):
    $vb = $matches[1];
    $nums = explode(' ',$vb);
    $aspect = 100*(int) $nums[3] / (int) $nums[2];

    if ($responsive):
      $return = "<div class='u-svg' style='padding-top:{$aspect}%'>{$data}</div>";
    else:
      $return = "<div class='u-svg' style='height:50px'>{$data}</div>";
    endif;
  endif;
  return $return;
}

function _get_svg($name){
  $dir  = TEMPLATEPATH.'/assets/svg/';
  $path = $dir.$name.'.svg';

  if ( $name && file_exists($path) ){
    $svg = file_get_contents($path);

    return $svg;
  }
  return '';
}

function _get_icon($name, $class = ''){
  $dir  = get_template_directory_uri().'/assets/icon/';
  $path = $dir.$name.'.png';
  $img = '<img class="' . $class . '" src="' . $path . '" alt="Icon" />';
  return $img;
}

function _get_file_icon( $extension ) {
  $icons = get_field( 'file_type_icons', 'option' ) ?: array();
  $found = wp_list_filter(
    $icons,
    array(
      'file_extension' => $extension,
    )
  );

  if ( ! empty( $found ) ) {
    return $found[0]['icon'];
  }

  return false;
}

// Allow SVG
add_filter('wp_check_filetype_and_ext', function ($data, $file, $filename, $mimes) {
  global $wp_version;
  if ($wp_version !== '4.7.1') {
    return $data;
  }

  $filetype = wp_check_filetype($filename, $mimes);

  return [
    'ext' => $filetype['ext'],
    'type' => $filetype['type'],
    'proper_filename' => $data['proper_filename']
  ];
}, 10, 4);

function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}

add_filter('upload_mimes', 'cc_mime_types');
