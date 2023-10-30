<?php

add_action('wp_enqueue_scripts', 'ttt_bulma_enqueue_bulma' );

function ttt_bulma_enqueue_bulma(){

    wp_enqueue_style( 'ttt_bulma_css', get_stylesheet_directory_uri() . '/css/bulma.min.css' );
    wp_enqueue_style( 'thet_local_styles', get_stylesheet_directory_uri() . '/style.css' );
}
