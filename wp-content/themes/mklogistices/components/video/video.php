<?php
  $video_class = !empty($video_class) ? $video_class : 'absolute top-0 left-0 w-full h-full';
  $video_url = !empty($video_url) ? $video_url : '';
  $video_fallback = !empty($video_fallback) ? $video_fallback : '';
  $image_class = !empty($image_class) ? $image_class : '';
?>
<div
  class="<?= $video_class; ?>"
  data-module="video"
>
  <?php if ($video_fallback) :
    the_component('image', array(
      'trigger' => !empty($trigger) ? $trigger : '',
      'class' => 'video__image-fallback' . $image_class,
      'image' => $video_fallback,
      'alt' => !empty($video_fallback['alt']) ? $video_fallback['alt'] : '',
      'cover' => true
    ));
  endif; ?>
  <video
    class="js-video video__wrapper"
    preload
    muted
    loop
    playsinline
    <?php if (empty($play_button)) : ?>autoplay<?php endif;?>
  >
    <source src="<?= $video_url; ?>" type="video/mp4">
    Your browser does not support the video tag.
  </video>
  <?php if (!empty($play_button)) : ?>
    <button type="button" class="js-play-button video__button" aria-label="<?php _e( 'Play/Pause Video' ); ?>">
      <div class="video__play-button"><?= _get_svg('icon_play'); ?></div>
      <div class="video__pause-button"><?= _get_svg('icon_pause'); ?></div>
    </button>
  <?php endif; ?>
</div>
