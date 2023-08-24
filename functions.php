<?php

add_action('wp_enqueue_scripts', 'ttt_bulma_enqueue_bulma' );

function ttt_bulma_enqueue_bulma(){

    wp_enqueue_style( 'ttt_bulma_css', plugin_dir_url( __FILE__ ) . 'css/bulma.min.css' );

}
