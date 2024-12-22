<?php if ((!empty($title) || !empty($description)) && !empty($image)) :
  $bottom_spacing = (!empty($add_bottom_spacing)) ? ' mb-[60px] lg:mb-[120px]' : '';

  $class_wrapper = "";
  $class_content = "";
  $class_title = "";
  $class_image = "";

  if (!empty($image_position)) {
    if ($image_position === 'left') {
      $class_wrapper = "flex-col lg:flex-row";
    } else {
      $class_wrapper = "flex-col-reverse lg:flex-row";
    }
  }

  if (!empty($title_highlight_color)) {
    if ($title_highlight_color === 'onyx') {
      $class_title = "[&_em]:text-cinder";
    } else {
      $class_title = "[&_em]:text-green";
    }
  }

  if (!empty($image_dimension)) {
    if ($image_dimension === '169') {
      $class_image = "relative w-full aspect-[375/210] md:aspect-[768/432] lg:w-[63.8%] xl:aspect-[1234/694]";
      $class_content = "lg:w-[36.2%]";
      $class_wrapper = $class_wrapper . " gap-[60px] md:gap-[52px] lg:gap-0";

      if ($image_position === 'left') {
        $class_content = $class_content . " lg:pl-16 lg:pr-12 xl:pl-20 xl:pr-16 3xl:pl-[147px] 3xl:pr-24";
      } else {
        $class_content = $class_content . " lg:pr-16 lg:pl-12 xl:pr-20 xl:pl-16 3xl:pr-[157px] 3xl:pl-24";
      }
    } else {
      $class_image = "relative w-full aspect-[375/281] md:aspect-[768/576] lg:w-[49%] xl:aspect-[940/705]";
      $class_content .= "lg:w-[51%]";
      $class_wrapper = $class_wrapper . " gap-[60px] md:gap-[52px] lg:gap-0";

      if ($image_position === 'left') {
        $class_content = $class_content . " lg:pl-12 lg:pr-16 xl:pl-16 xl:pr-20 3xl:pl-[188px] 3xl:pr-[243px]";
      } else {
        $class_content = $class_content . " lg:pl-16 lg:pr-12 xl:pr-16 xl:pl-20 3xl:pr-[188px] 3xl:pl-[243px]";
      }
    }
  }
?>
<!--Text and Image module start -->
<section class="image-and-text<?= $bottom_spacing; ?>">
  <div class="flex lg:items-center lg:gap-0 <?= $class_wrapper ?>">
    <?php if (!empty($image) && !empty($image_position) && $image_position === 'left') :
      the_component('image', array(
        'attributes' => 'data-animation="fade-up"',
        'class' => $class_image,
        'image' => $image,
        'sizes' => '(min-width: 1024px) 50vw, 100vw',
        'alt' => !empty($image['alt']) ? $image['alt'] : '',
        'cover' => true
      ));
    endif; ?>
    <div class="lg-max:max-w-[550px] lg-max:px-5 lg-max:mx-auto lg:mx-0 lg:px-0 <?= $class_content ?>">
      <?php if (!empty($title)) : ?>
        <h2 class="mb-6 font-heading text-fs-34 text-cinder md:mb-[34px] md:text-fs-44 3xl:text-fs-48 3xl:[&_em]:text-fs-54 lg:mb-9 <?= $class_title; ?>" data-animation="fade-up"><?= $title ?></h2>
      <?php endif; ?>
      <?php if (!empty($description)) : ?>
        <div class="wysiwyg text-cinder" data-animation="fade-up">
          <?= $description ?>
        </div>
      <?php endif; ?>
      <?php if (!empty($ctas)) : ?>
        <div class="flex flex-wrap gap-1 mt-6 md:gap-2">
          <?php foreach ($ctas as $cta) :
            if (!empty($cta['cta_link']) && !empty($cta['cta_link']['title'])) :
              the_component( 'button', array(
                'class' => 'btn--green',
                'text'  => $cta['cta_link']['title'],
                'link'  => $cta['cta_link']['url'],
                'target' => $cta['cta_link']['target'],
                'attrs' => 'data-animation="fade-up"',
              ) );
            endif;
          endforeach; ?>
        </div>
      <?php endif; ?>
    </div>
    <?php if (!empty($image) && !empty($image_position) && $image_position === 'right') :
      the_component('image', array(
        'attributes' => 'data-animation="fade-up"',
        'class' => $class_image,
        'image' => $image,
        'sizes' => '(min-width: 1024px) 50vw, 100vw',
        'alt' => !empty($image['alt']) ? $image['alt'] : '',
        'cover' => true
      ));
    endif; ?>
  </div>
</section>
<!--Text and Image module end -->
<?php endif; ?>
