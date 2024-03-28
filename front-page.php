<?php
    get_header();

    echo '
    <main id="main">';
        include(TEMPLATEPATH . '/sections/front-page/hero.php');

        // if ( get_posts() == null ) : else: include(TEMPLATEPATH . '/sections/front-page/blog.php'); endif;

        echo '
    </main>';

get_footer();