<?php

include_once( __DIR__ . '/blocks-init.php' );
include_once( __DIR__ . '/base-theme.php' );

class SLS_Theme extends SLS_Theme_Base {
  public function __construct() {
    parent::__construct();
    $this->acf_json_path = TEMPLATEPATH . '/acf-json';
    $this->cpt_json_path = TEMPLATEPATH . '/cpt-json';

    add_action( 'init', array( &$this, 'sls_base_menu_setup' ) );
    add_action( 'after_setup_theme', array( &$this, 'sls_base_add_theme_supports' ) );
    add_action( 'wp_head', array( &$this, 'preload_image_hero' ), 1 );
    add_filter( 'pre_option_upload_url_path', array( &$this, 'rewrite_uploads' ) );
  }

  /**
   * Add menu location for Header and Footer
   */
  public function sls_base_menu_setup() {
    register_nav_menus(
      array(
        'header-menu'     => __( 'Header Menu', 'mklogistics' ),
        'footer-menu'     => __( 'Footer Menu', 'mklogistics' ),
      )
    );
  }

  /**
   * Enable Title tag support
   */
  public function sls_base_add_theme_supports() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
  }

  public function rewrite_uploads( $upload_url_path ) {
    $enable_proxy = get_field( 'proxy_images', 'option' );
    if ( ! $enable_proxy ) {
      return;
    }

    $site_name = get_field( 'proxy_url', 'option' );

    if ( getenv( 'LANDO_INFO' ) ) {
      return "$site_name/wp-content/uploads";
    }
  }

  public function preload_image_hero() {
    if ( have_rows( 'page_builder' ) ) {
      $content = get_field( 'page_builder' );
      if (!empty($content) ) {
        $row = $content[0];
        $module = $row['acf_fc_layout'];
        $row['module'] = str_replace('_', '-', $module);
        if ( $row['module'] == 'full-width-media' ) {
          $image = $row['image'];
          $id = !empty($image) ? $image['ID'] : '';
          $image_mobile = $row['image_mobile'];
          $id_mobile = !empty($image_mobile) ? $image_mobile['ID'] : '';

          if (!empty($image) && !empty($image['url'])) {
            $srcset = $image['url'];

            if (!empty($id)) {
              $srcset = wp_get_attachment_image_srcset($id);
            }

            printf( "<link rel='preload' href='%s' as='image' imagesrcset='%s'>", $image['url'], $srcset);
          }

          if (!empty($image_mobile) && !empty($image_mobile['url'])) {
            $srcset_mobile = $image_mobile['url'];

            if (!empty($id_mobile)) {
              $srcset_mobile = wp_get_attachment_image_srcset($id_mobile);
            }

            printf( "<link rel='preload' href='%s' as='image' imagesrcset='%s'>", $image_mobile['url'], $srcset_mobile);
          }
        }
      }
    }
  }
}

new SLS_Blocks();
new SLS_Theme();
