<?php
$logo         = get_field('logo', 'option');
$main_menu    = get_field('main_menu', 'option');
$current_link = get_permalink();
?>
<header class="header py-5" data-module="header">
  <div class="container">
    <div class="flex items-center max-lg:justify-between">
      <a
        class="relative z-[99999] w-[100px] lg:w-[120px]"
        href="<?php echo home_url('/'); ?>"
        title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"
        rel="home"
        aria-label="<?php _e('Go to homepage', 'mklogistics'); ?>"
      >
        <?php
        if ( !empty($logo) ) :
          the_component(
            'image',
            array(
              'class' => 'aspect-[100/56] w-[100px] lg:w-[120px]',
              'image' => $logo,
              'alt'   => get_bloginfo( 'name', 'display' ),
              'cover' => true,
            )
          );
        else: ?>
          <span><?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?></span>
        <?php endif; ?>
      </a>
      <div class="header__nav js-header-nav lg:items-center">
        <div class="header__nav-inner js-header-nav-inner">
          <?php if (!empty($main_menu)) : ?>
            <ul class="header__nav-items">
              <?php foreach ($main_menu as $menu_item) :
              $has_sub_menu = $menu_item['has_sub_menu'] ?? '';
              $link = $menu_item['link'] ?? '';
              $title = $menu_item['title'] ?? '';
              $sub_menu = $menu_item['sub_menu'] ?? '';
              ?>
                <li class="header__nav-item <?php if (!empty($has_sub_menu) && !empty($title)) : ?> js-nav-parent-item header__nav-item-has-child<?php endif; ?>">
                  <?php if (empty($has_sub_menu) && !empty($link)) : ?>
                    <div class="js-nav-item header__nav-item-link">
                      <a href="<?= $link['url'] ?>" target="<?= $link['target'] ?>"
                          class="header__nav-title header__link<?php if ($current_link == $link['url']) : echo ' is-current'; endif; ?>">
                        <?= $link['title'] ?>
                      </a>
                    </div>
                  <?php endif ?>

                  <?php if (!empty($has_sub_menu) && !empty($title)) : ?>
                    <div class="js-nav-item header__nav-item-link">
                      <button type="button" class="header__nav-title header__link js-nav-item-link" aria-expanded="false">
                        <?= $title ?>
                        <span class="header__nav-arrow"><?= _get_svg('arrow-right') ?></span>
                      </button>
                    </div>

                    <?php if (!empty($sub_menu)) : ?>
                      <div class="header__nav-item-content js-nav-item-content">
                        <div class="header__nav-item-content-inner">
                          <ul class="flex flex-col gap-3 lg:gap-4">
                            <?php foreach ($sub_menu as $link) :
                              $_link = $link['link'];
                              if (!empty($_link) && !empty($_link['title'])) :
                                ?>
                                <li class="">
                                  <a href="<?= $_link['url'] ?>"
                                    target="<?= $_link['target'] ?>"
                                    class="text-black text-fs-14 uppercase font-medium lg:hover:underline lg:hover:underline-offset-2 <?php if ($current_link == $_link['url']) : echo ' is-current'; endif; ?>"
                                  >
                                    <?= $_link['title'] ?>
                                  </a>
                                </li>
                              <?php endif; endforeach; ?>
                          </ul>
                        </div>
                      </div>
                    <?php endif ?>
                  <?php endif ?>
                </li>
              <?php endforeach; ?>
            </ul>
          <?php endif; ?>
        </div>

        <div class="header__nav-register max-lg:px-5 max-lg:pt-5 lg:ml-10 lg:relative lg:top-px">
          <ul class="flex gap-2.5 text-fs-14">
            <li>
              <a class="flex items-center gap-2 header__link" href="#">
                <i class="far fa-user-circle"></i> Đăng nhập
              </a>
            </li>
            <span>/</span>
            <li>
              <a class="header__link" href="#">Đăng ký</a>
            </li>
          </ul>
        </div>
      </div>

      <button class="header__hamburger js-toggle-mobile-nav translate-y-[3px] lg:hidden" aria-expanded="false">
        <span class="header__hamburger--inner [body.is-open-menu_&]:hidden"><?= _get_svg('hamburger') ?></span>
        <span class="hidden translate-x-[-3px] translate-y-[1px] [body.is-open-menu_&]:block"><?= _get_svg('close') ?></span>
        <span class="sr-only">Menu</span>
      </button>
    </div>
  </div>
</header>
