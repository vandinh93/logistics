<?php
/**
 * Parse video type (Youtube/Vimeo/HTM5)
 * @param string $url
 * @return array
 */
function parse_video($url = '') {
  $results = array();
  $regs = array();
  preg_match('/(http:|https:|)\/\/(player.|www.)?(vimeo\.com|youtu(be\.com|\.be|be\.googleapis\.com))\/(video\/|embed\/|watch\?v=|v\/)?([A-Za-z0-9._%-]*)(\&\S+)?/', $url, $regs);
  if (strpos($regs[3], 'youtu') !== false) {
    $results['type'] = 'youtube';
  } else if (strpos($regs[3], 'vimeo') !== false) {
    $results['type'] = 'vimeo';
  } else {
    $results['type'] = 'html5';
    $results['src'] = $url;
  }
  $results['id'] = $regs[6];
  return $results;
}

function reading_time($post_id) {
  $content = get_post_field( 'post_content', $post_id );
  $word_count = str_word_count( strip_tags( $content ) );
  $readingtime = ceil($word_count / 200);

  if ($readingtime == 1) {
    $timer = " minute";
  } else {
    $timer = " min read";
  }
  $totalreadingtime = $readingtime . $timer;

  return $totalreadingtime;
}

function generate_random_string($length = 20) {
  $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $charactersLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
    $randomString .= $characters[rand(0, $charactersLength - 1)];
  }
  return $randomString;
}

/**
 * Get page by page template
 */
function get_page_by_template($path) {
  if(empty($path)) {
    return false;
  }
  $args = [
    'post_type' => 'page',
    'fields' => 'ids',
    'nopaging' => true,
    'meta_key' => '_wp_page_template',
    'meta_value' => $path
  ];
  $pages = get_posts($args);
  return $pages[0];
}


/**
 * Construct and return an image tag for lazy-loading
 *
 * @param array $image
 * @param string $size
 * @param string $class
 * @param string $sizes
 * @param string $alt
 */
function the_lazy_img( $image, $size, $class, $sizes = '', $alt, $image_attr, $first_image_blur ) {
  $blank = empty($first_image_blur) ? 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7' : '';
  if( is_array($image) ) {
    $id = $image['ID'];
    $img = wp_get_attachment_image_src( $id, $size )[0];
    $blank = !empty($first_image_blur) ? wp_get_attachment_image_src( $id, 'medium' )[0] : $blank;
  } elseif (is_numeric($image)) {
    $id = $image;
    $img = wp_get_attachment_image_src( $id, $size )[0];
    $blank = !empty($first_image_blur) ? wp_get_attachment_image_src( $id, 'medium' )[0] : $blank;
  } else {
    $id = null;
    $img = $image;
  }

  if ( empty( $img ) ) {
    return;
  }

  $html = '<img %s src="%s" data-normal="%s" data-retina="%s" data-srcset="%s" alt="%s" %s %s>';

  printf(
    $html,
    empty( $class ) ? '' : "class=\"${class}\"",
    $blank,
    $img,
    $img,
    wp_get_attachment_image_srcset($id, $size) ? wp_get_attachment_image_srcset($id, $size) : $img,
    $alt,
    empty( $sizes ) ? '' : "sizes=\"${sizes}\"",
    $image_attr
  );
}

/**
 * Get Article Card
 *
 * @param int $post_id
 *
 * @return array An array.
 */
function mk_get_article_card( int $post_id = null ) {
  if ( empty( $post_id ) ) return array();

  $result          = array();

  $result = array(
    'title'       => get_the_title( $post_id ),
    'image'       => get_post_thumbnail_id( $post_id ),
    'description' => get_the_excerpt( $post_id ),
    'cta'         => array(
      'url'   => get_the_permalink( $post_id ),
      'title' => 'Xem chi tiết',
    ),
  );

	return $result;
}

/**
 * Get Article Listing
 *
 * @param int    $per_page
 * @param string $category_slug
 * @param int    $paged
 *
 * @return array An array.
 */
function mk_get_article_listing( int $per_page = 12, $category_slug = '', $paged = 1 ) {
  $results = array();
	$args    = array(
		'post_type'      => 'post',
		'posts_per_page' => $per_page,
		'paged'          => $paged,
		'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC',
	);

  if ( ! empty( $category_slug ) ) {
    $args['category_name'] = $category_slug;
  }

	$query = new WP_Query( $args );

	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) :
			$query->the_post();

      $results['posts'][] = mk_get_article_card( get_the_ID() );
		endwhile;

    $results['found_post'] = $query->found_posts;
    $results['max_num_pages'] = $query->max_num_pages;
    $results['paged'] = $paged;
    wp_reset_postdata();
	}

	return $results;
}
