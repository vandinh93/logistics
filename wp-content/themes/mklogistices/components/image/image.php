<?php
$module = 'data-module="image"';
if (!empty($cover)) {
  $class .= ' image--cover';
}
if (!empty($contain)) {
  $class .= ' image--contain';
}
if (!empty($top)) {
  $class .= ' image--top';
}
if (empty($sizes)) {
  $sizes = '';
}
if (empty($size)) {
  $size = '';
}
if (empty($attributes)) {
  $attributes = '';
}
if (!isset($use_srcset)) {
  $use_srcset = true;
}
if (empty($alt) && !empty($image['alt'])) {
  $alt = $image['alt'];
}
if (!empty($trigger)) {
  $attributes .= ' data-trigger="'. $trigger .'"';
}
if (empty($image_attr)) {
  $image_attr = '';
}
if (empty($first_image_blur)) {
  $first_image_blur = false;
} else {
  $class .= ' image--blur';
}
?>
<div class="js-wrap image <?= $class ?>" <?= $module; ?> <?= $attributes; ?>>
  <?php
  if (!empty($image)) {
    the_lazy_img($image, $size, 'image__img', $sizes, $alt, $image_attr, $first_image_blur);
  }

  if (!empty($content)) {
    echo $content;
  }
  ?>
</div>
