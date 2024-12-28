<?php
  $info_title        = ! empty( get_field( 'info_title', 'option' ) ) ? get_field( 'info_title', 'option' ) : 'Thông tin liên hệ';
  $info              = ! empty( get_field( 'info', 'option' ) ) ? get_field( 'info', 'option' ) : array();
  $service_title     = ! empty( get_field( 'service_title', 'option' ) ) ? get_field( 'service_title', 'option' ) : 'Dịch vụ';
  $service           = ! empty( get_field( 'service', 'option' ) ) ? get_field( 'service', 'option' ) : array();
  $quick_links_title = ! empty( get_field( 'quick_links_title', 'option' ) ) ? get_field( 'quick_links_title', 'option' ) : 'Liên kết nhanh';
  $quick_links       = ! empty( get_field( 'quick_links', 'option' ) ) ? get_field( 'quick_links', 'option' ) : array();
  $fanpage_title     = ! empty( get_field( 'fanpage_title', 'option' ) ) ? get_field( 'fanpage_title', 'option' ) : 'Fanpage';
  $fanpage           = ! empty( get_field( 'fanpage', 'option' ) ) ? get_field( 'fanpage', 'option' ) : array();
  $address           = ! empty( get_field( 'address', 'option' ) ) ? get_field( 'address', 'option' ) : array();
  $socials_title     = ! empty( get_field( 'socials_title', 'option' ) ) ? get_field( 'socials_title', 'option' ) : 'Socials';
  $socials           = ! empty( get_field( 'socials', 'option' ) ) ? get_field( 'socials', 'option' ) : array();
?>

<footer class="site-footer text-white bg-blue py-10 lg:py-20" data-module="footer">
  <div class="container">
    <div class="flex flex-wrap gap-y-6 md:gap-y-10 pb-8 mb-8 border-b border-white/10">
      <div class="w-full md:w-1/2 md:pr-5 lg:w-1/4 xl:pr-8">
        <div class="flex flex-col">
          <?php if ( $info_title ) : ?>
            <h3 class="text-fs-18 font-body font-bold mb-3 lg:text-fs-20"><?php echo esc_html( $info_title ); ?></h3>
          <?php endif; ?>

          <?php if ( $info ) : ?>
            <ul class="flex flex-col gap-3">
              <?php if ( $info['address'] ) : ?>
                <li class="flex items-center gap-3">
                  <span class="flex items-center justify-center w-8 h-8 lg:w-10 lg:h-10 rounded-full bg-yellow"><?php echo _get_icon('location', 'w-4 h-4 lg:w-5 lg:h-5'); ?></span>
                  <span class="flex-1"><?php echo esc_html( $info['address'] ); ?></span>
                </li>
              <?php endif; ?>

              <?php if ( $info['email'] ) : ?>
                <li class="flex items-center gap-3">
                  <span class="flex items-center justify-center w-8 h-8 lg:w-10 lg:h-10 rounded-full bg-yellow"><?php echo _get_icon('email', 'w-4 h-4 lg:w-5 lg:h-5'); ?></span>
                  <span class="flex-1"><a class="footer__link" href="mailto:<?php echo esc_html( $info['email'] ); ?>"><?php echo esc_html( $info['email'] ); ?></a></span>
                </li>
              <?php endif; ?>

              <?php if ( $info['phone'] ) : ?>
                <li class="flex items-center gap-3">
                  <span class="flex items-center justify-center w-8 h-8 lg:w-10 lg:h-10 rounded-full bg-yellow"><?php echo _get_icon('phone', 'w-4 h-4 lg:w-5 lg:h-5'); ?></span>
                  <span class="flex-1"><?php echo wp_kses_post( $info['phone'] ); ?></span>
                </li>
              <?php endif; ?>
            </ul>
          <?php endif; ?>
        </div>
      </div>

      <?php if ( ! empty( $service ) ) : ?>
        <div class="w-full md:w-1/2 lg:pr-5 lg:w-1/4 xl:pr-8">
          <div class="flex flex-col">
            <?php if ( $service_title ) : ?>
              <h3 class="text-fs-18 font-body font-bold mb-3 lg:text-fs-20"><?php echo esc_html( $service_title ); ?></h3>
            <?php endif; ?>

            <ul class="flex flex-col gap-3">
              <?php foreach ( $service as $item ) : ?>
                <li>
                  <a class="footer__link" href="<?php echo esc_attr( $item['link']['url'] ); ?>" target="<?php echo esc_attr( $item['link']['target'] ); ?>"><?php echo esc_html( $item['link']['title'] ); ?></a>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
      <?php endif; ?>

      <?php if ( ! empty( $quick_links ) ) : ?>
        <div class="w-full md:w-1/2 md:pr-5 lg:w-1/4 xl:pr-8">
          <div class="flex flex-col">
            <?php if ( $quick_links_title ) : ?>
              <h3 class="text-fs-18 font-body font-bold mb-3 lg:text-fs-20"><?php echo esc_html( $quick_links_title ); ?></h3>
            <?php endif; ?>

            <ul class="flex flex-col gap-3">
              <?php foreach ( $quick_links as $item ) : ?>
                <li>
                  <a class="footer__link" href="<?php echo esc_attr( $item['link']['url'] ); ?>" target="<?php echo esc_attr( $item['link']['target'] ); ?>"><?php echo esc_html( $item['link']['title'] ); ?></a>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
      <?php endif; ?>

      <?php if ( ! empty( $fanpage ) ) : ?>
        <div class="w-full md:w-1/2 lg:w-1/4">
          <div class="flex flex-col">
            <?php if ( $fanpage_title ) : ?>
              <h3 class="text-fs-18 font-body font-bold mb-3 lg:text-fs-20"><?php echo esc_html( $fanpage_title ); ?></h3>
            <?php endif; ?>

            <div class="[&_*]:!w-full overflow-hidden"><?php echo wp_kses_post( $fanpage ); ?></div>
          </div>
        </div>
      <?php endif; ?>
    </div>

    <div class="flex flex-wrap gap-y-4 py-4">
      <?php foreach ( $address as $item ) : ?>
        <div class="flex gap-3 w-full md:w-1/2 md:pr-5 lg:w-1/4 xl:pr-8">
          <p class="flex items-center justify-center w-8 h-8 lg:w-10 lg:h-10 rounded-full bg-yellow"><?php echo _get_icon('location', 'w-4 h-4 lg:w-5 lg:h-5'); ?></p>
          <div class="flex flex-col flex-1">
            <?php if ( ! empty( $item['title'] ) ) : ?>
              <p class="font-bold text-yellow"><?php echo esc_html( $item['title'] ); ?></p>
            <?php endif; ?>
            <?php if ( ! empty( $item['description'] ) ) : ?>
              <p><?php echo esc_html( $item['description'] ); ?></p>
            <?php endif; ?>
          </div>
        </div>
      <?php endforeach; ?>

      <?php if ( ! empty( $socials ) ) : ?>
        <div class="w-full md:w-1/2 md:pr-5 lg:w-1/4 xl:pr-8">
          <?php if ( $socials_title ) : ?>
            <h4 class="text-fs-18 mb-3 lg:text-fs-20 font-bold"><?php echo esc_html( $socials_title ); ?></h4>
          <?php endif; ?>

          <div class="flex gap-2.5">
            <?php
              foreach ( $socials as $social ) :
                $icon = ! empty( $social['icon'] ) ? $social['icon'] : array();
                $link = ! empty( $social['link'] ) ? $social['link'] : '';
              ?>
              <a href="<?php echo esc_url( $link ); ?>" target="_blank">
                <?php
                  the_component(
                    'image',
                    array(
                      'class' => 'aspect-square w-6 lg:w-8',
                      'image' => $icon,
                      'alt'   => $icon['alt'],
                      'cover' => true,
                    )
                  );
                ?>
              </a>
            <?php endforeach; ?>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>
</footer>
