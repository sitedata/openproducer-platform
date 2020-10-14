<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;



// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_locale_css' ) ):
    function chld_thm_cfg_locale_css( $uri ){
        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter( 'locale_stylesheet_uri', 'chld_thm_cfg_locale_css' );

if ( !function_exists( 'chld_thm_cfg_parent_css' ) ):
    function chld_thm_cfg_parent_css() {
        wp_enqueue_style( 'chld_thm_cfg_parent', trailingslashit( get_template_directory_uri() ) . 'style.css', array(  ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'chld_thm_cfg_parent_css', 10 );
         
if ( !function_exists( 'child_theme_configurator_css' ) ):
    function child_theme_configurator_css() {
        wp_enqueue_style( 'chld_thm_cfg_child', trailingslashit( get_stylesheet_directory_uri() ) . 'style.css', array( 'chld_thm_cfg_parent','newspack-style','newspack-print-style','newspack-woocommerce-style' ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'child_theme_configurator_css', 20 );

// END ENQUEUE PARENT ACTION


//trying to remove the end time for events per https://theeventscalendar.com/knowledgebase/k/remove-the-event-end-time-in-views/
<<<<<<< HEAD

add_filter( 'tribe_events_event_schedule_details_formatting', 'tribe_remove_end_date' );
function tribe_remove_end_date ( $settings ) {
  $settings['time'] = false;
  return $settings;
}


//redirecting login per https://theeventscalendar.com/support/forums/topic/login-to-rsvp-and-login-to-purchase/

function tribe_make_login_to_purchase_go_to_woo_my_account_login( $original_login_url ) {

$new_url = esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) );

if ( empty( $new_url ) ) {
return $original_login_url;
}

return $new_url;
}

add_filter( 'tribe_tickets_ticket_login_url', 'tribe_make_login_to_purchase_go_to_woo_my_account_login' );



add_action( 'after_setup_theme', 'angelcity_setup' );

function angelcity_setup() {
add_theme_support( 'wc-product-gallery-zoom' );
add_theme_support( 'wc-product-gallery-lightbox' );
add_theme_support( 'wc-product-gallery-slider' );
}

add_theme_support( 'post-thumbnails', [ 
  'post', 
  'page',
  'tribe_events',
] );
=======
add_filter( 'tribe_events_event_schedule_details_formatting', 'tribe_remove_end_date' );
function tribe_remove_end_date ( $settings ) {
  $settings['show_end_time'] = false;
  return $settings;
}
>>>>>>> 0684dff50ad88161f19338cc90d4beb6fc613879
