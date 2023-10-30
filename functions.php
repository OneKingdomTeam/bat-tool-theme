<?php

add_action('wp_enqueue_scripts', 'ttt_bulma_enqueue_bulma' );

function ttt_bulma_enqueue_bulma(){

    wp_enqueue_style( 'ttt_bulma_css', get_stylesheet_directory_uri() . '/css/bulma.min.css' );
    wp_enqueue_style( 'thet_local_styles', get_stylesheet_directory_uri() . '/style.css' );
}


function ttt_custom_login_logo() { ?>
    <style type="text/css">
        .login h1 a {
            background-image: url("<?php echo get_stylesheet_directory_uri(); ?>/media/login-logo-150-150.png") !important;
            width: 100px;
            height: 100px;
            background-size: 100px;
        }
    </style>
<?php }

add_action('login_head', 'ttt_custom_login_logo');



function ttt_custom_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'ttt_custom_login_logo_url' );