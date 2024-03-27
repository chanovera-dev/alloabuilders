<?php

// elimina el número de versión de wordpress
remove_action( 'wp_head', 'wp_generator' );
add_filter( 'the_generator', '__return_null' );



// Disable the Wordpress emoji's
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

/* Removing s.w.org DNS prefetch */
add_filter('wp_resource_hints', function (array $urls, string $relation): array {
    if ($relation !== 'dns-prefetch') {
        return $urls;
    }
    $urls = array_filter($urls, function (string $url): bool {
        return strpos($url, 's.w.org') === false;
    });
    return $urls;
}, 10, 2);



// elimina wlwmanifest.xml
remove_action( 'wp_head', 'wlwmanifest_link' );



// elimina el enlace corto
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0 );