<?php
  $background  = ! empty( $background ) ? $background : array();
  $title       = ! empty( $title ) ? $title : '';
  $api_url     = ! empty( $api_url ) ? $api_url : '';
?>

<?php if ( ! empty( $subtitle ) || ! empty( $title ) || ! empty( $api_url ) ) : ?>
  <section
    class="search-code"
    data-module="search-code"
    data-api-url="<?php echo esc_attr( $api_url ); ?>"
  >
    <div
      class="py-10 !bg-cover !bg-fixed !bg-center !bg-no-repeat lg:min-h-[550px] lg:py-20 xl:min-h-[600px]"
      <?php if ( ! empty( $background ) && ! empty( $background['url'] ) ) : ?>
        style="background: linear-gradient(rgba(0,123,255,0.2), rgba(0,123,255,0.2)), url(<?php echo esc_url( $background['url'] ); ?>) center / cover"
      <?php endif; ?>
    >
      <div class="container">
        <div class="flex h-[500px] items-center justify-center">
          <div class="flex flex-col items-center text-center gap-4 lg:gap-6">
            <?php if ( ! empty( $title ) ) : ?>
              <h1 class="hero__title"><?php echo esc_html( $title ); ?></h1>
            <?php endif; ?>

            <?php if ( ! empty( $subtitle ) ) : ?>
              <h2 class="hero__title"><?php echo esc_html( $subtitle ); ?></h2>
            <?php endif; ?>

            <?php if ( ! empty( $description ) ) : ?>
              <div class="text-white text-fs-16 lg:text-fs-20"><?php echo wp_kses_post( $description ); ?></div>
            <?php endif; ?>

            <div class="flex flex-col items-center gap-4 w-full lg:gap-6">
              <form class="js-form-tracking relative max-w-[400px] w-full">
                <input type="text" class="js-input-tracking w-full h-[62px] px-5 py-3 bg-white text-black text-fs-16 border-0 rounded-100 focus:outline-0" placeholder="Nhập mã vận đơn...">
                <button class="js-fetch-button absolute right-5 bottom-0 top-0 my-auto flex items-center justify-center bg-orange text-white rounded-full w-[38px] h-[38px]"><i class="fa fa-search"></i></button>
              </form>
              <p class="js-loading loading text-fs-16"><span class="spinner"></span> Đang tìm dữ liệu...</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container overflow-hidden">
      <div class="js-result my-10 hidden lg:my-20">
        <h3 class="text-fs-24 text-black mb-5 lg:text-fs-32">Danh sách mã vận đơn đã tìm kiếm</h3>
        <p class="js-no-result text-fs-16 text-black">Không có mã vận đơn phù hợp với kết quả tìm kiếm.</p>
        <div class="overflow-x-auto w-full js-table">
          <table class="min-w-[800px] text-center">
            <thead>
              <tr>
                <th>Ngày</th>
                <th>Trạng Thái</th>
                <th>Mã Vận Đơn</th>
                <th>Tên Khách</th>
                <th>LINE</th>
              </tr>
            </thead>
            <tbody class="js-table-body">
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
<?php endif; ?>
