<?php
  $logo = get_field('footer_logo', 'options');
  $contact = get_field('footer_contact', 'options');
  $address = get_field('footer_address', 'options');
  $footer_privacy_policy = get_field('footer_privacy_policy', 'options');
  $footer_terms_conditions = get_field('footer_terms_conditions', 'options');
  $footer_copyrights_text = get_field('footer_copyrights_text', 'options');
?>
<footer class="footer w-full bg-black-2 z-0 overflow-hidden" data-module="footer">
  <div class="js-footer-content container mx-auto py-10 md:px-10 md:py-12 lg:p-24 lg:pt-[96px]">
    <div class="flex flex-col gap-10 pb-10 mb-10 font-body border-b border-white border-opacity-20 md:gap-12 md:pb-12 md:mb-12 lg:flex-row lg:items-start lg:gap-0 lg:pb-[106px] lg:mb-24">
      <?php if (!empty($logo)) : ?>
        <a
          href="<?php echo home_url('/'); ?>"
          title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"
          rel="home"
          aria-label="<?php _e('Go to homepage', 'mklogistics'); ?>"
        >
          <?php
            the_component('image', array(
              'class' => 'w-[40px] md:w-[60px]',
              'image' => $logo,
              'alt' => $logo['alt'] ?? ''
            ));
          ?>
        </a>
      <?php endif; ?>

      <?php if (has_nav_menu('footer-menu')) : ?>
        <div class="footer-menu__nav grow grow-0 shrink-0 lg:ml-auto lg:px-[15px] lg:basis-7/12">
          <?php
            wp_nav_menu(array('theme_location' => 'footer-menu'));
          ?>
        </div>
      <?php endif; ?>
    </div>
    <div class="w-full pb-10 mb-10 border-b border-white border-opacity-20 md:pb-12 md:mb-12 lg:pb-[95px] lg:mb-[98px]">
      <div class="flex flex-col flex-wrap gap-10 text-white -mx-[15px] md:gap-12 lg:flex-row lg:justify-end lg:items-start lg:gap-0">
        <?php if (!empty($contact)) : ?>
          <div class="flex flex-col items-start gap-3.5 grow-0 shrink-0 px-[15px] lg:basis-1/4 lg:gap-6">
            <p class="text-fs-13 font-body 4lg:text-fs-18">
              <?php _e('Contact', 'mklogistics'); ?>
            </p>
            <div class="flex flex-col items-start font-heading">
              <?php if (!empty($contact['phone_number'])) : ?>
                <p class="text-fs-20 md:text-fs-31 4lg:text-fs-45">
                  <?= $contact['phone_number'] ?>
                </p>
              <?php endif; ?>
              <?php if (!empty($contact['email'])) : ?>
                <?php if (!empty($contact['email']['url']) && !empty($contact['email']['title'])) : ?>
                  <a href="<?= $contact['email']['url'] ?>" target="<?= $contact['email']['target'] ?>" class="text-fs-20 text-white md:text-fs-31 4lg:text-fs-45 lg:opacity-60 lg:hover:opacity-100">
                    <?= $contact['email']['title'] ?>
                  </a>
                <?php endif; ?>
              <?php endif; ?>
              <?php if (!empty($contact['social'])) : ?>
                <?php if (!empty($contact['social']['url']) && !empty($contact['social']['title'])) : ?>
                  <a href="<?= $contact['social']['url'] ?>" target="<?= $contact['social']['target'] ?>" class="text-fs-20 text-white md:text-fs-31 4lg:text-fs-45 lg:opacity-60 lg:hover:opacity-100">
                    <?= $contact['social']['title'] ?>
                  </a>
                <?php endif; ?>
              <?php endif; ?>
            </div>
          </div>
        <?php endif; ?>
        <?php if (!empty($address)) : ?>
          <div class="flex flex-col items-start gap-3.5 grow-0 shrink-0 px-[15px] lg:basis-1/4 lg:ml-[8.333333%] lg:gap-6">
            <p class="text-fs-13 font-body 4lg:text-fs-18">
              <?php _e('Address', 'mklogistics'); ?>
            </p>
            <div class="max-w-[405px] font-heading text-fs-20 md:text-fs-31 4lg:text-fs-45">
              <p>
                <?= $address ?>
              </p>
            </div>
          </div>
        <?php endif; ?>
      </div>
    </div>
    <div class="flex flex-col gap-5 text-white lg:flex-row lg:justify-between lg:items-end">
      <?php if ( !empty($footer_privacy_policy) || !empty($footer_terms_conditions) || !empty($footer_copyrights_text) ) : ?>
        <div class="flex flex-col gap-1 text-fs-13 font-body">
          <?php if ( !empty($footer_privacy_policy) || !empty($footer_terms_conditions) ) : ?>
            <div class="flex flex-wrap items-center">
              <?php if ( !empty($footer_privacy_policy) ) : ?>
                <a target="<?= !empty($footer_privacy_policy['target']) ? '_blank' : '_self'; ?>" href="<?= $footer_privacy_policy['url']; ?>"><?= $footer_privacy_policy['title']; ?></a>
              <?php endif; ?>
              <?php if ( !empty($footer_privacy_policy) && !empty($footer_terms_conditions) ) : ?>
                <span class="w-px h-2.5 mx-2 bg-white"></span>
              <?php endif; ?>
              <?php if ( !empty($footer_terms_conditions) ) : ?>
                <a target="<?= !empty($footer_terms_conditions['target']) ? '_blank' : '_self'; ?>" href="<?= $footer_terms_conditions['url']; ?>"><?= $footer_terms_conditions['title']; ?></a>
              <?php endif; ?>
            </div>
          <?php endif; ?>
          <?php if (!empty($footer_copyrights_text)) : ?>
            <p class="max-w-[336px] lg:max-w-full">
              <?= $footer_copyrights_text ?>
            </p>
          <?php endif; ?>
        </div>
      <?php endif; ?>
      <a target="_blank" href="https://www.jtbstudios.com.au/" class="flex items-center gap-2 text-fs-12 font-body">
        <?php _e('Web design Melbourne', 'mklogistics'); ?>
        <?= _get_svg('jtb') ?>
      </a>
    </div>
  </div>
</footer>
