<?php

// carga componentes (estilos, javascript, etc) en el header
function load_components_header() {
    wp_dequeue_style( 'wp-block-library' );
    wp_deregister_script('wp-polyfill');
    wp_deregister_script('regenerator-runtime');
}
add_action( 'wp_enqueue_scripts', 'load_components_header' );