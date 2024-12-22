<?php
$logo = get_field('logo', 'option');
$cta = get_field('header_cta', 'option');
$contact = get_field('header_contact', 'option');
$mega_menu = get_field('mega_menu', 'option');
$current_link = get_permalink();
?>
<header class="header js-header" data-module="header" style="position: fixed;">
  <div class="container header__container">
    <div class="header__inner">
      <button class="header__hamburger js-toggle-mobile-nav translate-y-[3px]" aria-expanded="false">
        <span class="header__hamburger--inner [body.is-open-menu_&]:hidden"><?= _get_svg('hamburger') ?></span>
        <span class="hidden translate-x-[-3px] translate-y-[1px] [body.is-open-menu_&]:block"><?= _get_svg('close') ?></span>
        <span class="sr-only">Menu</span>
      </button>

      <a
        class="relative z-10 header__logo-link"
        href="<?php echo home_url('/'); ?>"
        title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"
        rel="home"
        aria-label="<?php _e('Go to homepage', 'mklogistics'); ?>"
      >
        <?php if ( !empty($logo) ) : ?>
          <img class="header__logo w-[36px] md:w-[44px] lg:w-[70px]" src="<?= $logo['url'] ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
        <?php else: ?>
          <span><?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?></span>
        <?php endif; ?>
      </a>
      <div class="header__right">
        <div class="header__nav js-header-nav">
          <div class="header__nav-inner js-header-nav-inner">
            <div class="header__nav-content">
              <?php if (!empty($mega_menu)) : ?>
                <ul class="header__nav-items">
                  <?php foreach ($mega_menu as $mega_menu_item) :
                  $has_sub_menu = $mega_menu_item['has_sub_menu'] ?? '';
                  $link = $mega_menu_item['link'] ?? '';
                  $title = $mega_menu_item['title'] ?? '';
                  $headline = $mega_menu_item['headline'] ?? '';
                  $description = $mega_menu_item['description'] ?? '';
                  $sub_menu = $mega_menu_item['sub_menu'] ?? '';
                  ?>
                    <li class="header__nav-item <?php if (!empty($has_sub_menu) && !empty($title)) : ?> js-nav-parent-item header__nav-item-has-child<?php endif; ?>">
                      <?php if (empty($has_sub_menu) && !empty($link)) : ?>
                        <div class="js-nav-item header__nav-item-link">
                          <a href="<?= $link['url'] ?>" target="<?= $link['target'] ?>"
                             class="header__nav-title <?php if ($current_link == $link['url']) : echo ' is-current'; endif; ?>">
                            <?= $link['title'] ?>
                          </a>
                        </div>

                      <?php endif ?>
                      <?php if (!empty($has_sub_menu) && !empty($title)) : ?>
                        <div class="js-nav-item header__nav-item-link">
                          <button type="button" class="header__nav-title js-nav-item-link" aria-expanded="false">
                            <?= $title ?>
                            <span class="w-[27px] h-[27px] lg:hidden"><?= _get_svg('arrow-right') ?></span>
                          </button>
                        </div>

                        <?php if (!empty($sub_menu)) : ?>
                          <div class="header__nav-item-content js-nav-item-content">
                            <div class="relative w-full lg:max-w-[380px]">
                              <button class="text-nav header__nav-item-back js-nav-item-back">
                                <?= _get_svg('arrow-left') ?>
                              </button>
                              <div class="header__nav-item-content-inner">
                                <?php if (!empty($headline)) : ?>
                                  <h2 class="mb-10 text-white text-fs-34 font-heading md:mb-[34px] lg:mb-9 lg:text-fs-54"><?= $headline ?></h2>
                                <?php endif; ?>
                                <?php if (!empty($description)) : ?>
                                  <p class="hidden mb-10 text-white text-base lg:block lg:mb-[50px] lg:text-18"><?= $description ?></p>
                                <?php endif; ?>
                                <ul class="flex flex-col gap-8 lg:gap-6">
                                  <?php foreach ($sub_menu as $link) :
                                    $_link = $link['link'];
                                    if (!empty($_link) && !empty($_link['title'])) :
                                      ?>
                                      <li class="">
                                        <a href="<?= $_link['url'] ?>"
                                           target="<?= $_link['target'] ?>"
                                           class="text-white text-base font-medium lg:text-white/60 lg:hover:text-white lg:text-fs-26 <?php if ($current_link == $_link['url']) : echo ' is-current'; endif; ?>">
                                          <?= $_link['title'] ?>
                                        </a>
                                      </li>
                                    <?php endif; endforeach; ?>
                                </ul>
                              </div>
                            </div>
                          </div>
                        <?php endif ?>
                      <?php endif ?>
                    </li>
                  <?php endforeach; ?>
                </ul>
              <?php endif; ?>

              <div class="js-header-contact header__contact">
                <?php if (!empty($contact) && !empty($contact['title'])) : ?>
                  <div>
                    <h3 class="text-fs-13 text-white"><?= $contact['title'] ?></h3>
                    <?php if (!empty($contact['content'])) : ?>
                      <div class="header__contact-content"><?= $contact['content'] ?></div>
                    <?php endif; ?>
                  </div>
                <?php endif; ?>
                <?php if (!empty($cta) && !empty($cta['title'])) :
                  the_component( 'button', array(
                    'class' => 'header__cta-mobile btn-primary lg:hidden',
                    'text'  => $cta['title'],
                    'link'  => $cta['url'],
                    'target' => $cta['target']
                  ) );
                endif; ?>
              </div>

            </div>
          </div>
        </div>

        <?php if (!empty($cta) && !empty($cta['title'])) : ?>
          <a
            href="<?= $cta['url'] ?>"
            target="<?= $cta['target'] ?>"
            class="block text-white text-fs-13 font-medium z-10 translate-y-[5px] lg:pt-[99px] lg:pb-[39px] lg:text-fs-18 lg:translate-y-0 lg:text-white/60 lg:hover:text-white">
            <?= $cta['title'] ?>
          </a>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <div class="header__overlay"></div>
</header>
