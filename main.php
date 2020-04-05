<?php
/*
 * Plugin Name: WP Custom Checkout
 * Plugin URI: https://polluxcoop.com/
 * Description: Ultimate WP Custom Checkout Plugin for WooCommerce.
 * Version: 1.0
 * Author: Osama Bin Laden
 * Author URI: https://fabeanfabean.com
 * Text Domain: custom-checkout
 * Domain Path: /etc/i18n/languages/
 *
 * @package WPCustomCheckout
 *
 */



defined('ABSPATH') || exit;


// Define WPCC_PLUGIN_DIR.
if (!defined('WPCC_PLUGIN_DIR')) {
    define('WPCC_PLUGIN_DIR', __DIR__);
}

use WP_Custom_Checkout\CustomCheckout;
use WP_Custom_Checkout\Bootstrap;

// Check if WooCommerce is active
if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
    // Put your plugin code here

    add_action('woocommerce_loaded', function () {
    require_once WPCC_PLUGIN_DIR.'/vendor/autoload.php';
    $bootstrap = new Bootstrap();
    $customCheckout = new CustomCheckout();
    });
} else {
    add_action('admin_notices', function () {
        $class = 'notice notice-error';
        $message = __('Oops! looks like WooCommerce is disabled. Please, enable it in order to use WP Custom Checkout.', 'customCheckout');
        printf('<div class="%1$s"><p>%2$s</p></div>', esc_attr($class), esc_html($message));
    });


}
