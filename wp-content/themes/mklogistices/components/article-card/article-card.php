<?php
  $image       = ! empty( $image ) ? $image : array();
  $title       = ! empty( $title ) ? $title : '';
  $description = ! empty( $description ) ? $description : '';
  $cta         = ! empty( $cta ) ? $cta : array();
?>

<?php if ( ! empty( $image ) || ! empty( $title ) || ! empty( $description ) ) : ?>
  <article class="flex flex-col gap-2.5 items-center sm:w-1/2 sm:px-3 md:w-1/3 md::px-5 xl:w-1/5 lx:px-6">
    <?php
      if ( ! empty( $image ) ) :
        the_component(
          'image',
          array(
            'class' => 'aspect-[170/150] w-full',
            'image' => $image,
            'alt'   => $title,
            'cover' => true,
          ),
        );
      endif;
    ?>

    <div class="flex flex-col justify-between gap-2.5 flex-1">
      <div class="flex flex-col items-center gap-2.5">
        <?php if ( ! empty( $title ) ) : ?>
          <h3 class="text-fs-14 lg:text-base font-bold"><?php echo esc_html( $title ); ?></h3>
        <?php endif; ?>
        <?php if ( ! empty( $description ) ) : ?>
          <div class="text-fs-14 lg:text-base line-clamp-3"><?php echo esc_html( $description ); ?></div>
        <?php endif; ?>
      </div>

      <?php if ( ! empty( $cta ) ) : ?>
        <a class="w-fit whitespace-nowrap bg-yellow px-10 py-3 rounded-100 font-bold text-white transition-all duration-300 hover:bg-yellow/80" href="<?php echo esc_url( $cta['url'] ); ?>"><?php echo esc_html( $cta['title'] ); ?></a>
      <?php endif; ?>
    </div>
  </article>
<?php endif; ?>
