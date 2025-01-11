<?php
  $background  = ! empty( $background ) ? $background : array();
  $title       = ! empty( $title ) ? $title : '';
  $description = ! empty( $description ) ? $description : '';
?>

<?php if ( ! empty( $subtitle ) || ! empty( $title ) || ! empty( $description ) ) : ?>
  <section
    class="hero py-10 !bg-cover !bg-fixed !bg-center !bg-no-repeat lg:min-h-[550px] lg:py-20 xl:min-h-[600px]"
    <?php if ( ! empty( $background ) && ! empty( $background['url'] ) ) : ?>
      style="background: linear-gradient(rgba(0,123,255,0.2), rgba(0,123,255,0.2)), url(<?php echo esc_url( $background['url'] ); ?>) center / cover"
    <?php endif; ?>
    data-module="hero"
  >
    <div class="container">
      <div class="flex h-[500px] items-center justify-center">
        <form class="js-form-hero flex flex-col items-center text-center gap-4 lg:gap-6" action="/home/search" method="get" target="_blank">
          <?php if ( ! empty( $title ) ) : ?>
            <h1 class="hero__title"><?php echo esc_html( $title ); ?></h1>
          <?php endif; ?>

          <?php if ( ! empty( $subtitle ) ) : ?>
            <h2 class="hero__title"><?php echo esc_html( $subtitle ); ?></h2>
          <?php endif; ?>

          <?php if ( ! empty( $description ) ) : ?>
            <div class="text-white text-fs-16 lg:text-fs-20"><?php echo wp_kses_post( $description ); ?></div>
          <?php endif; ?>

          <div class="flex gap-4 justify-center flex-col md:flex-row lg:gap-6">
            <div class="flex gap-2 bg-white p-3 rounded-100">
              <div class="relative z-20 js-dropdown-wrap">
                <button class="js-btn-dropdown-hero hero__btn-dropdown" aria-expanded="false" type="button" data-icon="taobao">D</button>
                <ul class="js-content-dropdown-hero hero__content-dropdown">
                  <li><a class="hero__content-dropdown-item js-dropdown-item" href="#" title="taobao"><?php echo _get_icon( 'taobao', 'w-9 h-9' ); ?> Taobao</a></li>
                  <li><a class="hero__content-dropdown-item js-dropdown-item" href="#" title="tmall"><?php echo _get_icon( 'tmall', 'w-9 h-9' ); ?> Tmall</a></li>
                  <li><a class="hero__content-dropdown-item js-dropdown-item" href="#" title="1688"><?php echo _get_icon( '1688', 'w-9 h-9' ); ?> 1688</a></li>
                </ul>
              </div>
              <input class="js-keyword outline-0" name="keyword" type="text" class="border-0" placeholder="Tìm kiếm sản phẩm">
              <button type="submit" class="flex items-center justify-center bg-orange text-white rounded-full w-[38px] h-[38px]"><i class="fa fa-search"></i></button>
            </div>
            <a href="#" target="_blank" class="flex items-center justify-center h-[62px] gap-2 text-fs-18 font-bold px-3 py-1.5 bg-orange text-white rounded-md transition-colors duration-300 hover:bg-blue">
              <i class="fa fa-list-alt"></i> Tạo đơn hàng
            </a>
          </div>
        </form>
      </div>
    </div>
  </section>
<?php endif; ?>
