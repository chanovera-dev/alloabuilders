<?php

// carga componentes (estilos, javascript, etc) en el header
function load_components_header() {
    wp_dequeue_style( 'wp-block-library' );
    wp_deregister_script('wp-polyfill');
    wp_deregister_script('regenerator-runtime');
}
add_action( 'wp_enqueue_scripts', 'load_components_header' );



// Carga componentes (estilos, javascript, etc) en el footer
function load_components_footer(){}
add_action( 'get_footer', 'load_components_footer' );



// theme support
function alloabuilders_theme_support(){
    add_theme_support( 'title-tag' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'custom-logo', array( 
    'height' => 240,
    'width' => 240, 
    'flex-height' => true,
    ) );
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ) );
    add_theme_support( 'post-formats', array(
        'aside',
        'image', 
        'video',
        'quote',
        'link',
        'gallery',
        'status',
        'audio',
        'chat',
    ) );
    add_theme_support( 'customize-selective-refresh-widgets' );
    add_theme_support( 'post-thumbnails', array( 'post', 'page' ) ); // Add it for posts
	set_post_thumbnail_size( 200, 200, true ); // Normal post thumbnails, hard crop mode
	add_image_size( 'post-image', 600, 200, true ); // Post thumbnails, hard crop mode
	add_image_size( 'slider-image', 920, 300, true ); // Post thumbnails for slider, hard crop mode
	add_theme_support('custom-background');
} 
add_action('after_setup_theme', 'alloabuilders_theme_support');



// mueve los scripts del head al footer
function mover_jquery_al_footer( $wp_scripts ) {
    if ( ! is_admin() ) {
        $wp_scripts->add_data( 'jquery', 'group', 1 );
        $wp_scripts->add_data( 'jquery-core', 'group', 1 );
        $wp_scripts->add_data( 'jquery-migrate', 'group', 1 );
    }
}
add_action( 'wp_default_scripts', 'mover_jquery_al_footer' );



function ver_archivos_cargados(){
    global $wp_styles;
    global $wp_scripts;
    echo 'STYLES:';
    echo '<pre>';
    var_dump($wp_styles->queue);
    echo '</pre>';
    echo 'SCRIPTS:';
    echo '<pre>';
    var_dump($wp_scripts->queue);
    echo '</pre>';
}
add_action("wp_footer", "ver_archivos_cargados");



add_action('wp_print_styles', 'rankya_remove_styles', 100000);
add_action('wp_print_footer_scripts', 'rankya_remove_styles', 100000);
function rankya_remove_styles(){
wp_deregister_style('wp-block-library');
wp_dequeue_style('wp-block-library');
wp_deregister_style('wp-block-library-theme');
wp_dequeue_style('wp-block-library-theme');
}
/**
 * Disable the emoji's
 */
function disable_emojis() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); 
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
    add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
   }
   add_action( 'init', 'disable_emojis' );
   
   /**
    * Filter function used to remove the tinymce emoji plugin.
    * 
    * @param array $plugins 
    * @return array Difference betwen the two arrays
    */
   function disable_emojis_tinymce( $plugins ) {
    if ( is_array( $plugins ) ) {
    return array_diff( $plugins, array( 'wpemoji' ) );
    } else {
    return array();
    }
   }
   
   /**
    * Remove emoji CDN hostname from DNS prefetching hints.
    *
    * @param array $urls URLs to print for resource hints.
    * @param string $relation_type The relation type the URLs are printed for.
    * @return array Difference betwen the two arrays.
    */
   function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
    if ( 'dns-prefetch' == $relation_type ) {
    /** This filter is documented in wp-includes/formatting.php */
    $emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );
   
   $urls = array_diff( $urls, array( $emoji_svg_url ) );
    }
   
   return $urls;
   }