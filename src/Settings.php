<?php

namespace WP_Custom_Checkout;

class Settings
{
    public function __construct()
    {
        add_filter('woocommerce_settings_tabs_array', [$this, 'addSettingsTab'], 50);
        add_action('woocommerce_settings_tabs_settings_tab_customcheckout', [$this, 'settingsTab']);
        add_action('woocommerce_update_options_settings_tab_customcheckout', [$this, 'updateSettings']);
    }

    public function addSettingsTab($settings_tabs)
    {
        $settings_tabs['settings_tab_customcheckout'] = __('Custom Checkout', 'customcheckout');

        return $settings_tabs;
    }

    public function settingsTab()
    {
        woocommerce_admin_fields($this->getSettings());
    }

    public function updateSettings()
    {
        woocommerce_update_options($this->getSettings());
    }

    public function getSettings()
    {
        $settings = [
            'priced_cart_title' => [
                'name' => __('Priced Cart Fields', 'customcheckout'),
                'type' => 'title',
                'desc' => __('Please select the fields that you want to hide when a priced purchase is made', 'customfields'),
                'id' => 'wc_settings_tab_customcheckout_priced_cart_title',
            ],
            'billing_company_priced' => [
                'name' => __('Company', 'customfields'),
                'type' => 'checkbox',
                'std' => 'no',
                'default' => 'no',
                'id' => 'wc_billing_company_priced',
            ],
            'billing_phone_priced' => [
                'name' => __('Phone', 'customfields'),
                'type' => 'checkbox',
                'std' => 'no',
                'default' => 'no',
                'id' => 'wc_billing_phone_priced',
            ],
            'billing_address_1_priced' => [
                'name' => __('Address 1', 'customfields'),
                'type' => 'checkbox',
                'std' => 'no',
                'default' => 'no',
                'id' => 'wc_billing_address_1_priced',
            ],
            'billing_address_2_priced' => [
                'name' => __('Address 2', 'customfields'),
                'type' => 'checkbox',
                'std' => 'no',
                'default' => 'no',
                'id' => 'wc_billing_address_2_priced',
            ],
            'billing_city_priced' => [
                'name' => __('City', 'customfields'),
                'type' => 'checkbox',
                'std' => 'no',
                'default' => 'no',
                'id' => 'wc_billing_city_priced',
            ],

            'billing_post_code_priced' => [
                'name' => __('Post Code', 'customfields'),
                'type' => 'checkbox',
                'std' => 'no',
                'default' => 'no',
                'id' => 'wc_billing_post_code_priced',
            ],
            'billing_country_priced' => [
                'name' => __('Country', 'customfields'),
                'type' => 'checkbox',
                'std' => 'no',
                'default' => 'no',
                'id' => 'wc_billing_country_priced',
            ],

            'billing_state_priced' => [
                'name' => __('State', 'customfields'),
                'type' => 'checkbox',
                'std' => 'no',
                'default' => 'no',
                'id' => 'wc_billing_state_priced',
            ],
            'priced_cart_end' => [
                'type' => 'sectionend',
                'id' => 'wc_settings_tab_customcheckout_priced_cart_title',
            ],
            'free_cart_title' => [
                'name' => __('Free Cart Fields', 'customcheckout'),
                'type' => 'title',
                'desc' => __('Please select the fields that you want to hide when a free purchase is made', 'customfields'),
                'id' => 'wc_settings_tab_customcheckout_free_cart_title',
            ],
            'billing_company_free' => [
                'name' => __('Company', 'customfields'),
                'type' => 'checkbox',
                'std' => 'no',
                'default' => 'no',
                'id' => 'wc_billing_company_free',
            ],
            'billing_phone_free' => [
                'name' => __('Phone', 'customfields'),
                'type' => 'checkbox',
                'std' => 'no',
                'default' => 'no',
                'id' => 'wc_billing_phone_free',
            ],
            'billing_address_1_free' => [
                'name' => __('Address 1', 'customfields'),
                'type' => 'checkbox',
                'std' => 'no',
                'default' => 'no',
                'id' => 'wc_billing_address_1_free',
            ],
            'billing_address_2_free' => [
                'name' => __('Address 2', 'customfields'),
                'type' => 'checkbox',
                'std' => 'no',
                'default' => 'no',
                'id' => 'wc_billing_address_2_free',
            ],
            'billing_city_free' => [
                'name' => __('City', 'customfields'),
                'type' => 'checkbox',
                'std' => 'no',
                'default' => 'no',
                'id' => 'wc_billing_city_free',
            ],

            'billing_post_code_free' => [
                'name' => __('Post Code', 'customfields'),
                'type' => 'checkbox',
                'std' => 'no',
                'default' => 'no',
                'id' => 'wc_billing_post_code_free',
            ],
            'billing_country_free' => [
                'name' => __('Country', 'customfields'),
                'type' => 'checkbox',
                'std' => 'no',
                'default' => 'no',
                'id' => 'wc_billing_country_free',
            ],

            'billing_state_free' => [
                'name' => __('State', 'customfields'),
                'type' => 'checkbox',
                'std' => 'no',
                'default' => 'no',
                'id' => 'wc_billing_state_free',
            ],
            'section_end' => [
                'type' => 'sectionend',
                'id' => 'wc_settings_tab_customcheckout_free_cart_title',
            ],
        ];

        return apply_filters('wc_settings_tab_customcheckout', $settings);
    }
}
