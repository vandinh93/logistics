<?php
  $class         = ! empty( $class ) ? $class : '';
  $title         = ! empty( $title ) ? $title : '';
  $is_white      = ! empty( $is_white ) ? $is_white : false;
  $is_blue       = ! empty( $is_blue ) ? $is_blue : false;
  $is_light_blue = ! empty( $is_light_blue ) ? $is_light_blue : false;
  $class_title   = ! empty( $class_title ) ? $class_title : '';
  $description   = ! empty( $description ) ? $description : '';
  $classes       = implode(
    ' ',
    array(
      'relative flex flex-col items-center gap-2 mb-8 lg:mb-14 after:absolute after:left-0 after:right-0 after:top-4 after:z-10 after:h-px',
      $is_blue ? 'after:bg-blue' : 'after:bg-black',
      $class,
    )
  );
  $classes_title = implode(
    ' ',
    array(
      'relative z-20 font-bold text-fs-24 lg:text-fs-30 text-center uppercase px-4',
      $is_white ? 'bg-white' : '',
      $is_light_blue ? 'bg-light-blue' : '',
      $is_blue ? 'bg-blue' : '',
    )
  );
?>

<?php if ( ! empty( $title ) || ! empty( $description ) ) : ?>
  <div class="<?php echo esc_attr( $classes ); ?>">
    <?php if ( ! empty( $title ) ) : ?>
      <h2 class="<?php echo esc_attr( $classes_title ); ?>"><?php echo esc_html( $title ); ?></h2>
    <?php endif; ?>
    <?php if ( ! empty( $description ) ) : ?>
      <div class="text-fs-16 text-center lg:text-fs-18"><?php echo wp_kses_post( $description ); ?></div>
    <?php endif; ?>
  </div>
<?php endif; ?>
