<?php
  $title            = ! empty( $title ) ? $title : '';
  $background_color = ! empty( $background_color ) ? $background_color : 'white';
  $description      = ! empty( $description ) ? $description : '';
  $content          = ! empty( $content ) ? $content : array();
  $classes          = implode(
    ' ',
    array(
      'py-10 lg:py-20',
      'white' === $background_color ? 'bg-white text-black' : '',
      'blue' === $background_color ? 'bg-blue text-white border-b border-white' : '',
      'light-blue' === $background_color ? 'bg-light-blue text-black' : '',
    )
  );
  $classes_inner   = implode(
    ' ',
    array(
      'blue' === $background_color ? 'after:bg-white' : 'after:bg-black',
    )
  );
  $classes_heading  = implode(
    ' ',
    array(
      'white' === $background_color ? 'bg-white' : '',
      'blue' === $background_color ? 'bg-blue' : '',
      'light-blue' === $background_color ? 'bg-light-blue' : '',
    )
  );
?>

<?php if ( ! empty( $title ) || ! empty( $description ) || ! empty( $content ) ) : ?>
  <section class="<?php echo esc_attr( $classes ); ?>">
    <div class="container">
      <?php
        the_component(
          'heading',
          array(
            'class_title' => $classes_heading,
            'title'       => $title,
            'description' => $description,
          ),
        );
      ?>

      <?php if ( ! empty( $content ) ) : ?>
        <div class="relative flex justify-center gap-y-6 max-lg:flex-wrap -mx-2.5 lg:flex-row lg:-mx-5 xl:-mx-10 after:absolute after:left-0 after:right-0 after:top-[52%] after:z-10 after:h-px after:bg-green-2 after:hidden lg:after:block">
          <?php foreach ( $content as $key => $item ) : ?>
            <div class="flex flex-col gap-1 items-center px-2.5 w-full sm:w-1/2 lg:w-auto lg:px-5 xl:px-10 xl:flex-1">
              <?php
                if ( ! empty( $item['image'] ) ) :
                  the_component(
                    'image',
                    array(
                      'class' => 'aspect-square w-20',
                      'image' => $item['image'],
                      'alt'   => $item['text']
                    ),
                  );
                endif;
              ?>
              <span class="relative z-20 bg-green-2 px-3 py-2.5 rounded-full text-white text-fs-12-12"><?php echo $key + 1; ?></span>
              <?php if ( ! empty( $item['text'] ) ) : ?>
                <h3 class="text-fs-16 text-center px-3 max-w-[200px] lg:text-fs-18"><?php echo esc_html( $item['text'] ); ?></h3>
              <?php endif; ?>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>
  </section>
<?php endif; ?>
