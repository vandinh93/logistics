<?php
$logo = get_field('logo', 'option');
$cta = get_field('header_cta', 'option');
$contact = get_field('header_contact', 'option');
$mega_menu = get_field('mega_menu', 'option');
$current_link = get_permalink();
?>
<header class="header py-5">
  <div class="container">
    <div class="lg:flex lg:items-center">
      <button class="header__hamburger js-toggle-mobile-nav translate-y-[3px] lg:hidden" aria-expanded="false">
        <span class="header__hamburger--inner [body.is-open-menu_&]:hidden"><?= _get_svg('hamburger') ?></span>
        <span class="hidden translate-x-[-3px] translate-y-[1px] [body.is-open-menu_&]:block"><?= _get_svg('close') ?></span>
        <span class="sr-only">Menu</span>
      </button>

      <a
        class="relative z-10 header__logo-link lg:mr-10"
        href="<?php echo home_url('/'); ?>"
        title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"
        rel="home"
        aria-label="<?php _e('Go to homepage', 'mklogistics'); ?>"
      >
        <?php if ( !empty($logo) ) : ?>
          <img class="w-[100px] lg:w-[120px]" src="<?= $logo['url'] ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
        <?php else: ?>
          <span><?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?></span>
        <?php endif; ?>
      </a>
      <div class="lg:flex lg:justify-end lg:flex-1">
        <ul class="flex flex-col list-style-none text-fs-16 font-arial lg:flex-row">
          <li>
            <a class="px-5 font-bold" href="#">Dịch vụ</a>
          </li>
          <li>
            <a class="px-5 font-bold" href="#">Bảng giá</a>
          </li>
          <li>
            <a class="px-5 font-bold" href="#">Hướng Dẫn</a>
          </li>
          <li>
            <a class="px-5 font-bold" href="#">Chính sách</a>
          </li>
          <li>
            <a class="px-5 font-bold" href="#">Chia sẻ kinh nghiệm</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</header>
