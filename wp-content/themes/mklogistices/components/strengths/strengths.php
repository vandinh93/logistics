<?php
  $title   = ! empty( $title ) ? $title : '';
  $image   = ! empty( $image ) ? $image : array();
  $content_left = ! empty( $content_left ) ? $content_left : array();
  $content_right = ! empty( $content_right ) ? $content_right : array();
?>

<?php if ( ! empty( $title ) || ! empty( $image ) || ! empty( $content_left ) || ! empty( $content_right ) ) : ?>
  <section class="py-10 bg-white text-black lg:py-20">
    <div class="container">
      <?php
        the_component(
          'heading',
          array(
            'is_white' => true,
            'title'    => $title,
          ),
        );
      ?>

      <?php if ( ! empty( $image ) || ! empty( $content_left ) || ! empty( $content_right ) ) : ?>
        <div class="flex flex-col md:flex-row md:items-center md:-mx-3">
          <?php if ( ! empty( $content_left ) ) : ?>
            <div class="md:w-1/3 md:px-3">
              <?php
              foreach ( $content_left as $item ) :
                $_title       = ! empty( $item['title'] ) ? $item['title'] : '';
                $_description = ! empty( $item['description'] ) ? $item['description'] : '';

                if ( ! empty( $_title ) || ! empty( $_description ) ) :
                ?>
                  <div class="flex items-center md:flex-row-reverse py-3">
                    <div class="w-[52px] xl:w-[66px]">
                      <?php echo _get_icon( 'check', 'w-[52px] xl:w-[66px] h-[52px] xl:h-[66px]' ); ?>
                    </div>
                    <div class="flex flex-col px-2 flex-1">
                      <h3 class="text-base font-bold mb-1 xl:text-fs-18"><?php echo esc_html( $_title ); ?></h3>
                      <p class="text-fs-14 md:pl-3 md:text-right md:mb-4 xl:text-base"><?php echo wp_kses_post( $_description ); ?></p>
                    </div>
                  </div>
                <?php
                endif;
              endforeach;
              ?>
            </div>
          <?php endif; ?>

          <?php
          if ( ! empty( $image ) ) :
            the_component(
              'image',
              array(
                'class' => 'aspect-square md:w-1/3 md:px-3',
                'image' => $image,
                'alt'   => $image['alt'],
                'cover' => true,
              )
            );
          endif;
          ?>

          <?php if ( ! empty( $content_right ) ) : ?>
            <div class="md:w-1/3 md:px-3">
              <?php
              foreach ( $content_right as $item ) :
                $_title       = ! empty( $item['title'] ) ? $item['title'] : '';
                $_description = ! empty( $item['description'] ) ? $item['description'] : '';

                if ( ! empty( $_title ) || ! empty( $_description ) ) :
                ?>
                  <div class="flex items-center py-3">
                    <div class="w-[52px] xl:w-[66px]">
                      <?php echo _get_icon( 'check', 'w-[52px] xl:w-[66px] h-[52px] xl:h-[66px]' ); ?>
                    </div>
                    <div class="flex flex-col px-2 flex-1">
                      <h3 class="text-base font-bold mb-1 xl:text-fs-18"><?php echo esc_html( $_title ); ?></h3>
                      <p class="text-fs-14 md:pl-3 md:text-right md:mb-4 xl:text-base"><?php echo wp_kses_post( $_description ); ?></p>
                    </div>
                  </div>
                <?php
                endif;
              endforeach;
              ?>
            </div>
          <?php endif; ?>
        </div>
      <?php endif; ?>
    </div>
  </section>
<?php endif; ?>
