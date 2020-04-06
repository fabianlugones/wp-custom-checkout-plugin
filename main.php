<?php
/**
 * Plugin Name: Hide Fields
 * Plugin URI: https://brightplugins.com/
 * Description: Plugin to hide WooCommerce's Checkout fields.
 * Version: 1.0
 * Author: Bright Plugins
 * Author URI: https://brightplugins.com
 * Text Domain: hidefields-woocommerce
 * Domain Path: /etc/i18n/languages/.
 */
defined('ABSPATH') || exit;

// Define WPCC_PLUGIN_DIR.
if (!defined('WPCC_PLUGIN_DIR')) {
    define('WPCC_PLUGIN_DIR', __DIR__);
}

use WP_Hide_Fields\CustomCheckout;
use WP_Hide_Fields\Settings;

// Check if WooCommerce is active
if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
    add_action('woocommerce_loaded', function () {
        require_once WPCC_PLUGIN_DIR.'/vendor/autoload.php';
        //Load Settings
        new Settings();
        $customCheckout = new CustomCheckout();
    });
} else {
    add_action('admin_notices', function () {
        $class = 'notice notice-error';
        $message = __('Oops! looks like WooCommerce is disabled. Please, enable it in order to use WP Custom Checkout.', 'customCheckout');
        printf('<div class="%1$s"><p>%2$s</p></div>', esc_attr($class), esc_html($message));
    });
}
