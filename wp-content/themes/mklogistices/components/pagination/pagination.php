<?php if ( ! empty( $total ) ) :
  $class  = empty( $class ) ? '' : $class;
  $format = empty( $format ) ? '?paged=%#%' : $format;
  $paged  = empty( $paged ) ? max( 1, get_query_var( 'paged' ) ) : $paged;
  ?>
  <div class="pagination <?php echo esc_attr( $class ); ?>">
    <div class="pagination__list">
      <?php
        $prev = '<span class="button__icon button__icon--left" aria-hidden="true">'. _get_svg( 'arrow-left' ) . '</span><span class="sr-only">Previous</span>';
        $next = '<span class="sr-only">Next</span><span class="button__icon button__icon--right" aria-hidden="true">'. _get_svg( 'arrow-right' ) . '</span>';

        $pagination_links = paginate_links(array(
          'current'   => max(1, $paged),
          'total'     => $total,
          'prev_text' => $prev,
          'next_text' => $next,
          'format'    => $format,
          'show_all'  => false,
          'prev_next' => true,
          'type'      => 'plain',
          'before_page_number' => '<span class="page-number-prefix">',
          'after_page_number'  => '</span>',
        ));

        if ( ! empty( $pagination_links ) ) {
          $pagination_links = preg_replace_callback(
            '/<span class="page-number-prefix">(\d)<\/span>/',
            function ($matches) {
              return '<span class="page-number-prefix">0' . $matches[1] . '</span>';
            },
            $pagination_links
          );

          echo $pagination_links;
        }
      ?>
    </div>
  </div>
<?php endif; ?>
