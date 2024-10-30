<?php
/**
* Plugin Name: Hidden Price For Unregistred Users
* Version: 1.0
* Plugin URI: https://wordpress.org/plugins/hidden-price-for-unregistred-users
* Description: This is plugin show products prices just for registred users on website.
* Author: Desperado House - Cvijetin Maletic 
* Author URI: https://desperadohouse.com/
**/
defined('ABSPATH') or die();
/** THIS FILTER HIDE PRICE FOR UNREGISTRED USERS ON WEBSITE **/
add_filter('woocommerce_get_price_html', 'dhhp_custom_price_message', 100, 2);

/** THIS FUNCTION SHOW PRICE FOR REGISTRED USERS AND SEND NOTIFICATION MESSAGE FOR UNREGISTRED, THAT REGISTER TO SEE PRICE **/
function dhhp_custom_price_message($price, $product) {
	$notification_message = esc_attr( get_option('dhhp_notification_message_option') ); // Notification message text for unregistred users
    if (!is_user_logged_in()) {
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 ); // Remove "Add To Cart" button for unregistred users on shop page
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 ); // Remove "Add To Cart" button for unregistred users on single product page
        add_filter( 'woocommerce_is_purchasable', '__return_false' );
		return $notification_message;  // Message for unregistred users
    }
    return $price;  // Showing price for registred users
}

/** ADMINISTRATION SETTINGS PAGE **/
// create custom plugin settings menu
add_action('admin_menu', 'dhhp_plugin_create_menu');

function dhhp_plugin_create_menu() {

	//create new top-level menu
	add_menu_page('Hidden Price For Unregistred', 'Hidden Price For Unregistred', 'administrator', __FILE__, 'dhhp_settings_page' , 'dashicons-money-alt' );

	//call register settings function
	add_action( 'admin_init', 'register_dhhp_settings');
	
	//call admin page
	include ("adminpage.php");
}



