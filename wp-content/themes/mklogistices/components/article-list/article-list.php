<?php
  $posts_per_page       = ! empty( $posts_per_page ) ? $posts_per_page : 12;
  $paged                = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
  $request_uri       = $_SERVER['REQUEST_URI'];
  $path              = trim( $request_uri, '/' );
  $segments          = explode( '/', $path );
  $slug              = ! empty( $slug ) ? $slug : '';
  $article_slug      = $request_uri;

  if ( str_contains( $request_uri, 'category' ) ) {
    $slug = end( $segments );
  }

  $posts = mk_get_article_listing( $posts_per_page, $slug, $paged );
?>

<?php if ( ! empty( $posts ) && ! empty( $posts['posts'] ) ) : ?>
  <section class="article-listing relative py-10 lg:py-20">
    <div class="container">
      <h2 class="mb-12 font-body text-center text-fs-32 font-bold uppercase text-black lg:text-fs-44"><?php echo single_cat_title(); ?></h2>
      <div class="flex flex-wrap gap-y-4 md:-mx-4 lg:justify-center">
        <?php
          foreach ( $posts['posts'] as $key => $article ) :
            the_component(
              'article-card',
              $article,
            );
          endforeach;
        ?>

        <?php
          if ( ! empty( $posts ) && $posts['max_num_pages'] > 1 ) :
            the_component('pagination', array(
              'paged' => $paged,
              'total' => $posts['max_num_pages'],
            ));
          endif;
          ?>
      </div>
    </div>
  </section>
<?php endif; ?>
