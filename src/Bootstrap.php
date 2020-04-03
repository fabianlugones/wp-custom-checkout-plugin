<?php

namespace WP_Custom_Checkout;

class Bootstrap
{
    public function __construct()
    {
        add_action('admin_enqueue_scripts', [$this, 'adminEnqueueStyles']);
        add_action('admin_enqueue_scripts', [$this, 'adminEnqueueScripts']);
        add_action('wp_enqueue_scripts', [$this, 'frontEnqueueStyles']);
        add_action('wp_enqueue_scripts', [$this, 'frontEnqueueScripts']);

        $this->initializeSettings();
    }

    public function defaultOptions()
    {
        $defaultOptions = [
            'wc_billing_company_priced' => 'no',
            'wc_billing_phone_priced' => 'no',
            'wc_billing_address_1_priced' => 'no',
            'wc_billing_address_2_priced' => 'no',
            'wc_billing_city_priced' => 'no',
            'wc_billing_post_code_priced' => 'no',
            'wc_billing_state_priced' => 'no',
            'wc_billing_company_free' => 'no',
            'wc_billing_phone_free' => 'no',
            'wc_billing_address_1_free' => 'no',
            'wc_billing_address_2_free' => 'no',
            'wc_billing_post_code_free' => 'no',
            'wc_billing_country_free' => 'no',
            'wc_billing_state_free' => 'no',
        ];

        foreach ($defaultOptions as $option => $value) {
            if (!get_option($option) || '' === get_option($option)) {
                add_option($option, $value);
            }
        }
    }

    public function initializeSettings()
    {
        new Settings();
    }
}