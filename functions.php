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



function ttt_upload_bat_logo() {

    $filename = get_stylesheet_directory() . '/media/bat-logo.png';

    if ( ! file_exists( $filename )){
        return null;
    };

    $wp_upload_dir = wp_upload_dir();
    
    copy( $filename, $wp_upload_dir['path'] . '/' . basename( $filename ) );

    $filetype = wp_check_filetype( $filename , null );


    $attachment = [
        'guid'           => $wp_upload_dir['url'] . '/' . basename( $filename ), 
        'post_mime_type' => $filetype['type'],
        'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
        'post_content'   => '',
        'post_status'    => 'inherit'
    ];

    $attachment_id = wp_insert_attachment( $attachment, basename( $filename ) );
    $fixed_attachemnt_location = $wp_upload_dir['path'] . '/' . basename( $filename );
    update_attached_file( $attachment_id, $fixed_attachemnt_location );

    require_once( ABSPATH . 'wp-admin/includes/image.php' );

    $attachment_data = wp_generate_attachment_metadata( $attachment_id, $wp_upload_dir['path'] . '/' . basename( $filename ) );
    wp_update_attachment_metadata( $attachment_id, $attachment_data );

    $file = fopen( get_stylesheet_directory() . '/log.txt', "w" ) or die('tadafdada');
    ob_start();
    var_dump( $filename );
    echo( '\n\n\n' );
    var_dump( $filetype );
    echo( '\n\n\n' );
    var_dump( $wp_upload_dir );
    echo( '\n\n\n' );
    var_dump( $attachment );
    echo( '\n\n\n' );
    var_dump( $attachment_id );
    fwrite( $file, ob_get_clean() );
    fclose( $file );

    return $attachment_id;

}


function ttt_add_logo_to_header_and_footer(){

    $first_activation = get_option('ttt_first_activation');

    if ( $first_activation !== false ){
        return;
    }

    update_option('ttt_first_activation', 'activated' );

    $logo_id = ttt_upload_bat_logo();

    if ( $logo_id === null ){
        return;
    }

    update_option('site_logo', $logo_id );

}

add_action('after_switch_theme', 'ttt_add_logo_to_header_and_footer' );

