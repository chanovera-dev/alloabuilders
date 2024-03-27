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


/* Quitar RSD */
remove_action('wp_head', 'rsd_link');



// elimina el enlace corto
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0 );



// elimina los enlaces de fedd RSS
function itsme_disable_feed() {
    wp_die( __( '¡No hay nada por aquí! Vuelve a la página de <a href="'. esc_url( home_url( '/' ) ) .'">inicio</a>!' ) );
}
add_action('do_feed', 'itsme_disable_feed', 1);
add_action('do_feed_rdf', 'itsme_disable_feed', 1);
add_action('do_feed_rss', 'itsme_disable_feed', 1);
add_action('do_feed_rss2', 'itsme_disable_feed', 1);
add_action('do_feed_atom', 'itsme_disable_feed', 1);
add_action('do_feed_rss2_comments', 'itsme_disable_feed', 1);
add_action('do_feed_atom_comments', 'itsme_disable_feed', 1);
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'feed_links', 2 );