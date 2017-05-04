<?php
define('THEME_NAME', 'locales');
define('THEME_PRETTY_NAME', 'Locales');

//Load Textdomain
function tt_theme_textdomain_setup(){
    if(load_theme_textdomain('locales', file_exists(get_stylesheet_directory() . '/languages') ? get_stylesheet_directory() . '/languages' : get_template_directory() . '/languages'))
        define('TT_TEXTDOMAIN_LOADED',true);
}
add_action('after_setup_theme', 'tt_theme_textdomain_setup');



//content width
if (!isset($content_width))
    $content_width = 1170;

//============Theme support=======
//post-thumbnails
add_theme_support('post-thumbnails');
//add feed support
add_theme_support('automatic-feed-links');
//add  html5 support
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'caption' ));
add_theme_support( 'custom-header' );
add_theme_support( 'custom-background' );
 add_theme_support( 'title-tag' );

add_image_size( 'tt_post_thumbnail', 652, 324, array( 'center', 'center'));
add_image_size( 'tt_popular_posts', 300, 162, array( 'center', 'center'));
add_image_size( 'tt_offers', 760, 602, array( 'center', 'center'));
add_image_size( 'tt_similar_locations', 54, 54, array( 'center', 'center'));
add_image_size( 'tt_explore_locations', 150, 135, array( 'center', 'center'));
add_image_size( 'tt_popular_locations', 613, 613, array( 'center', 'center'));
add_image_size( 'tt_location_slider_style_1', 360, 432, array( 'center', 'center'));
add_image_size( 'tt_location_slider_style_2', 555, 324, array( 'center', 'center'));