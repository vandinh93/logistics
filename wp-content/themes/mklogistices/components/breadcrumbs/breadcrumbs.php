<?php
  global $post;
  $base_title = !empty($base_title) ? $base_title : __('Home');
  $base_url = !empty($base_url) ? $base_url : esc_url( home_url( '/' ) );
  $class = !empty($class) ? $class : 'py-4 bg-light-blue';

  $title = get_the_title($post);
  $is_product_category = is_tax('product_category');
  if ($is_product_category ) {
    $title = get_queried_object()->name;
  }

  if ( is_search() ) {
    $hero_banner = get_field('search_page_hero_banner', 'options');
    $title = !empty($hero_banner) && !empty($hero_banner['title']) ? $hero_banner['title'] : __('Search results');
  }
?>
<div class="<?= $class; ?>">
  <nav class="container !max-w-[1200px]" role="navigation" aria-label="<?php _e( 'Breadcrumbs' ); ?>">
    <ul class="flex items-center text-fs-14 lg:text-base leading-none text-black">
      <li class="inline-block"><a class="text-black transition-colors duration-300 md:hover:text-blue" href="<?= $base_url; ?>"><?= $base_title; ?></a></li>
      <li class="inline-block"><?= _get_svg('icon-right'); ?></li>

      <?php
      $parent_id = !empty($post) ? $post->post_parent : '';

      if ($parent_id) {
        $breadcrumbs = array();

        while ($parent_id) {
          $parent_page = get_post($parent_id);
          if ($parent_page && $parent_page->post_status == 'publish') {
            $breadcrumbs[] = $parent_page->ID;
            $parent_id  = isset($page->post_parent) ? $page->post_parent : false;
          } else {
            $parent_id = false;
          }
        }

        if ($breadcrumbs) {
          $breadcrumbs = array_reverse($breadcrumbs);
          foreach($breadcrumbs as $breadcrumb_id) { ?>
            <li class="inline-block"><a class="text-black transition-colors duration-300 md:hover:text-blue" href="<?php echo esc_url(get_permalink($breadcrumb_id)); ?>"><?php echo get_the_title($breadcrumb_id); ?></a></li>
            <li class="inline-block"><?= _get_svg('icon-right'); ?></li>
          <?php }
        }
        ?>

      <?php } ?>

      <li class="inline-block truncate"><?= $title; ?></li>
    </ul>
  </nav>
</div>
