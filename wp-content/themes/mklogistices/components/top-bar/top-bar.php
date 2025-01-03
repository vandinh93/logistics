<?php
  $text = ! empty( $text ) ? $text : '';

  if ( ! empty( $text ) ) :
?>
  <section class="bg-gray">
    <div class="container py-3">
      <div class="flex items-center justify-center gap-2">
        <div class="animation-pulse rounded-full"><i class="fas fa-bullhorn text-fs-18 lg:text-fs-25 text-green"></i></div>
        <div class="text-fs-12 md:text-fs-14 lg:text-base text-black"><?php echo wp_kses_post( $text ); ?></div>
      </div>
    </div>
  </section>
<?php endif; ?>
