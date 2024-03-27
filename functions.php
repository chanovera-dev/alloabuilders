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