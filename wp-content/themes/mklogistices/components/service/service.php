<?php
  $title    = ! empty( $title ) ? $title : '';
  $services = ! empty( $services ) ? $services : array();
?>

<?php if ( ! empty( $title ) || ! empty( $services ) ) : ?>
  <section class="py-10 bg-light-blue text-black lg:py-20">
    <div class="container">
      <?php
        the_component(
          'heading',
          array(
            'is_light_blue' => true,
            'title'         => $title,
          ),
        );
      ?>

      <?php if ( ! empty( $services ) ) : ?>
        <div class="relative flex flex-wrap justify-center sm:gap-y-6 sm:-mx-3 md:gap-y-10 md:-mx-5 xl:gap-y-12 xl:-mx-6">
          <?php foreach ( $services as $item ) : ?>
            <div class="flex flex-col gap-2.5 items-center sm:w-1/2 sm:px-3 md:w-1/3 md::px-5 xl:w-1/5 lx:px-6">
              <?php
                if ( ! empty( $item['image'] ) ) :
                  the_component(
                    'image',
                    array(
                      'class' => 'aspect-[170/150] w-full',
                      'image' => $item['image'],
                      'alt'   => $item['title'],
                      'cover' => true,
                    ),
                  );
                endif;
              ?>

              <div class="flex flex-col items-center justify-between gap-2.5 flex-1">
                <div class="flex flex-col items-center gap-2.5">
                  <?php if ( ! empty( $item['title'] ) ) : ?>
                    <h3 class="text-base font-bold"><?php echo esc_html( $item['title'] ); ?></h3>
                  <?php endif; ?>
                  <?php if ( ! empty( $item['description'] ) ) : ?>
                    <div class="text-base text-center"><?php echo esc_html( $item['description'] ); ?></div>
                  <?php endif; ?>
                </div>

                <?php if ( ! empty( $item['cta'] ) ) : ?>
                  <a class="w-fit whitespace-nowrap bg-yellow px-10 py-3 rounded-100 font-bold text-white transition-all duration-300 hover:bg-yellow/80" href="<?php echo esc_url( $item['cta']['url'] ); ?>"><?php echo esc_html( $item['cta']['title'] ); ?></a>
                <?php endif; ?>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>
  </section>
<?php endif; ?>
