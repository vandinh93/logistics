<?php if (!empty($heading) || !empty($content_heading) || !empty($description) || !empty($image) || !empty($video_url)) :
  $ratio = (!empty($dimension_mobile) && $dimension_mobile === '169') ? ' aspect-[375/211] md:aspect-[768/432] lg:aspect-video' : ' aspect-[375/562] md:aspect-[768/432] lg:aspect-video';
  $hide_content = !empty($hide_content) ? ' hidden lg:block' : '';
  $image_class = 'relative w-full';
  $cta_type = (!empty($cta_colour) && $cta_colour === 'white') ? ' btn--transparent-white' : ' btn--green';
  $text_color = (!empty($text_color) && $text_color === 'white') ? 'text-white' : 'text-cinder';
  $content_align = (!empty($text_align) && $text_align === 'left') ? 'text-left' : 'text-center';
  $content_cta_align = (!empty($text_align) && $text_align === 'left') ? '' : ' justify-center';
  $content_bg = (!empty($colour_choices) && $colour_choices === 'caramel') ? 'bg-gray-2' : 'bg-green';
  $content_text_color = (!empty($colour_choices) && $colour_choices === 'caramel') ? ' text-cinder' : ' text-white';
  $content_cta_type = (!empty($colour_choices) && $colour_choices === 'caramel') ? ' btn--green' : ' btn--transparent-white';
  $bottom_spacing = (!empty($bottom_spacing)) ? ' lg:mb-[60px] xl:mb-[120px]' : '';
  $index = !empty($index) ? $index : 0;
  $image_class_desktop = $image_class;
  $image_class_mobile = $image_class;

  if ( !empty($image) && !empty($image_mobile) ) {
    $image_class_desktop .= ' hidden md:block';
    $image_class_mobile .= ' md:hidden';
  }
  ?>
  <!--Full Width Media start -->
  <section class="full-width-media <?php if ($index === 1) : echo ' js-full-width-media'; endif; ?> <?= $bottom_spacing ?>" <?php if ($index === 1) : ?> data-module="full-width-media" <?php endif; ?>>
    <div class="js-fwm-media relative z-10 flex w-full max-h-screen<?= $ratio ?>" <?php if ($index === 1) : ?>style="opacity: 0"<?php else: ?>  data-animation="fade-up"<?php endif; ?>>
      <?php if (!empty($video_url) || !empty($video_url_mobile)) :
        $trigger_video = !empty($index) && $index === 1 ? 'js-video-trigger' : '';

        if (!empty($video_url)) :
          the_component('video', array(
            'trigger' => $trigger_video,
            'video_fallback' => $image,
            'video_url' => $video_url,
            'play_button' => false,
            'video_class' => !empty($video_url_mobile) ? 'hidden md:block' : ""
          ));
        endif;
        if (!empty($video_url_mobile)) :
          the_component('video', array(
            'trigger' => $trigger_video,
            'video_fallback' => $image,
            'video_url' => $video_url_mobile,
            'play_button' => false,
            'video_class' => !empty($video_url) ? 'block md:hidden' : ""
        ));
        endif;
        elseif ( (!empty($image) || !empty($image_mobile)) ) :
          if ( !empty($image) ) :
            $alt = !empty($image['alt']) ? $image['alt'] : '';
            if (!empty($index) && $index === 1) : ?>
              <div class="image relative w-full image--cover image--loaded <?= $image_class_desktop ?>">
                <?php the_lazy_img($image, '', 'js-image-desktop-trigger image__img', '', $alt, 'fetchpriority="high"', true); ?>
              </div>
            <?php else:
              the_component('image', array(
                'class' => $image_class_desktop,
                'image' => $image,
                'alt' => $alt,
                'cover' => true,
              ));
            endif;
          endif;
          if ( !empty($image_mobile) ) :
            $alt_mobile = !empty($image_mobile['alt']) ? $image_mobile['alt'] : '';
            if (!empty($index) && $index === 1) : ?>
              <div class="image relative w-full image--cover image--loaded <?= $image_class_mobile ?>">
                <?php the_lazy_img($image_mobile, '', 'js-image-mobile-trigger image__img', '', $alt_mobile, 'fetchpriority="high"', true); ?>
              </div>
            <?php else:
              the_component('image', array(
                'class' => $image_class_mobile,
                'image' => $image_mobile,
                'alt' => $alt_mobile,
                'cover' => true,
              ));
            endif;
          endif;
      endif; ?>
      <div class="js-fwm-content absolute inset-0 z-20 container lg:pt-[84px] <?= $hide_content; ?>">
        <div class="flex flex-col justify-center gap-8 max-w-[600px] h-full md:gap-[34px] lg:gap-9 <?= $text_color ?>">
          <?php if (!empty($heading)) : ?>
            <h2 class="js-fade-text font-heading text-fs-34 md:text-fs-44 3xl:text-fs-54" <?php if ($index !== 1) : ?>data-animation="fade-up"<?php endif; ?>><?= $heading ?></h2>
          <?php endif; ?>
          <?php if (!empty($description)) : ?>
            <div class="js-fade-text text-base 3xl:text-fs-18" <?php if ($index !== 1) : ?>data-animation="fade-up"<?php endif; ?>><?= $description ?></div>
          <?php endif; ?>
          <?php if (!empty($ctas)) : ?>
            <div class="flex flex-wrap gap-1 md:gap-2">
              <?php foreach ($ctas as $cta) :
                if (!empty($cta['cta_link']) && !empty($cta['cta_link']['title'])) :
                  the_component( 'button', array(
                    'class' => 'js-fade-text ' . $cta_type,
                    'text'  => $cta['cta_link']['title'],
                    'link'  => $cta['cta_link']['url'],
                    'target' => $cta['cta_link']['target'],
                    'attrs' => $index !== 1 ? 'data-animation="fade-up"' : ''
                  ) );
                endif;
              endforeach; ?>
            </div>
          <?php endif; ?>
        </div>
      </div>
      <?php the_component('lines', array(
        'class' => 'js-lines absolute inset-0 container'
      )); ?>
    </div>
    <?php if (empty($content_hidden)) : ?>
      <div class="relative z-10 flex items-center">
        <div class="js-fwm-content-bg absolute inset-0 <?= $content_bg ?>"></div>
        <div class="js-fwm-content-block relative w-full py-[60px] px-5 md:py-16 xl:py-[120px]">
          <div class="max-w-[510px] h-full lg:max-w-[625px] mx-auto <?= $content_align . $content_text_color; ?>">
            <?php if (!empty($content_heading)) : ?>
              <h2 class="js-content-fade-text font-heading text-fs-34 md:text-fs-44 3xl:text-fs-54" <?php if ($index !== 1) : ?>data-animation="fade-up"<?php endif; ?>><?= $content_heading ?></h2>
            <?php endif; ?>
            <?php if (!empty($content_description)) : ?>
              <div class="js-content-fade-text my-6 text-base 3xl:text-fs-18" <?php if ($index !== 1) : ?>data-animation="fade-up"<?php endif; ?>><?= $content_description ?></div>
            <?php endif; ?>
            <?php if (!empty($content_ctas)) : ?>
              <div class="flex flex-wrap gap-1 mt-6 <?= $content_cta_align; ?>">
                <?php foreach ($content_ctas as $cta) :
                  if (!empty($cta['cta_link']) && !empty($cta['cta_link']['title'])) :
                    the_component( 'button', array(
                      'class' => 'js-content-fade-text '. $content_cta_type,
                      'text'  => $cta['cta_link']['title'],
                      'link'  => $cta['cta_link']['url'],
                      'target' => $cta['cta_link']['target'],
                      'attrs' => $index !== 1 ? 'data-animation="fade-up"' : ''
                    ) );
                  endif;
                endforeach; ?>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    <?php endif; ?>
    <?php if ($index == 1) {
      the_component('lines', array(
        'class' => 'js-lines-fixed fixed w-full h-full top-0 left-0 z-1 transition-opacity duration-300',
        'line_class' => 'bg-dark-gray'
      ));
    } ?>
  </section>
  <!--Full Width Media end -->
<?php endif; ?>
