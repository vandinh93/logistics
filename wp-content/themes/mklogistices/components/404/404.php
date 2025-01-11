<?php
  $subtitle = get_field('404_subtitle', 'options') ? get_field('404_subtitle', 'options') : 'Error 404';
  $title = get_field('404_title', 'options') ? get_field('404_title', 'options') : 'Sorry! Page not found';
  $body = get_field('404_body', 'options') ? get_field('404_body', 'options') : "It looks like the page you're looking for doesn't exist.";
  $cta = get_field('404_cta', 'options') ? get_field('404_cta', 'options') : [];

  if ( !empty($subtitle) || !empty($title) || !empty($body) || !empty($cta) ) :
?>
  <section class="relativ pt-[56.5px] md:pt-[80.5px]">
    <div class="container py-10 lg:py-20">
      <div class="flex flex-col gap-9 pb-10 lg:pb-20">
        <?php if ( !empty($subtitle) ) : ?>
          <p class="text-black text-base lg:text-fs-18"><?= $subtitle; ?></p>
        <?php endif; ?>

        <?php if ( !empty($title) || !empty($body) ) : ?>
          <div class="flex flex-col gap-10 lg:flex-row lg:items-center lg:gap-20">
            <?php if ( !empty($title) ) : ?>
              <h2 class="text-fs-32 lg:text-fs-48 max-w-[745px] text-black tracking-[-1.5px] lg:tracking-[-2px] lg:pr-4"><?= $title; ?></h2>
            <?php endif; ?>
            <?php if ( !empty($body) ) : ?>
              <div class="text-base lg:text-fs-20 relative max-w-[391px] h-fit text-black pl-9 border-l-2 border-blue"><?= $body; ?></div>
            <?php endif; ?>
          </div>
        <?php endif; ?>

        <?php if ( !empty($cta) ) :
          the_component( 'button', array(
            'class' => 'min-w-[145px] btn--yellow text-black',
            'text'  => $cta['title'],
            'link'  => $cta['url']
          ) );
        endif; ?>
      </div>
    </div>
  </section>
<?php endif; ?>
