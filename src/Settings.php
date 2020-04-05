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
        //Get Default Billing fields
        $billingFields = $this->getDefaultBillingFields();
        //If the pluging has been activated, populate DB with default options 
        register_activation_hook(__FILE__, [$this, 'defaultOptions']);

        $settings = array_merge($this->getPricedSettings($billingFields),$this->getFreeSettings($billingFields)) ;
        return apply_filters('wc_settings_tab_customcheckout',$settings);

    }
    
    public function getDefaultBillingFields()
    {   
        $countries = new \WC_Countries();
        //Get all billing fields corresponding to the base country
        return array_keys($countries->get_address_fields( $countries->get_base_country(),'billing_'));
    }

    public function getPricedSettings($billingFields)
    {   
        $pricedSettings['priced_cart_title'] = 
               [
                'name' => __('Priced Cart Fields', 'customcheckout'),
                'type' => 'title',
                'desc' => __('Please select the fields that you want to hide when a priced purchase is made', 'customfields'),
                'id' => 'wc_settings_tab_customcheckout_priced_cart_title',
                ];
        foreach ($billingFields as $fieldName ) {
            $field = new Field($fieldName);
            $capitalizedFieldName = ucwords(str_replace("_"," ",$fieldName));
            $pricedSettings['priced_'.$fieldName]=
                 [
                    'name' => __($capitalizedFieldName, 'customfields'),
                    'type' => 'checkbox',
                    'std' => 'no',
                    'default' => 'no',
                    'id' => $field->getPricedIdField(),
                 ];

            };
        $pricedSettings['priced_cart_end'] =
            [
                'type' => 'sectionend',
                'id' => 'wc_settings_tab_customcheckout_priced_cart_title',
            ];
        return $pricedSettings;
    }

    public function getFreeSettings($billingFields)
    {   
        $freeSettings['free_cart_title'] = 
               [
                'name' => __('Free Cart Fields', 'customcheckout'),
                'type' => 'title',
                'desc' => __('Please select the fields that you want to hide when a free purchase is made', 'customfields'),
                'id' => 'wc_settings_tab_customcheckout_free_cart_title',
               ];  
        foreach ($billingFields as $fieldName ) {
            $field = new Field($fieldName);
            $capitalizedFieldName = ucwords(str_replace("_"," ",$fieldName));
            $freeSettings['free_'.$fieldName]=
                 [
                    'name' => __($capitalizedFieldName, 'customfields'),
                    'type' => 'checkbox',
                    'std' => 'no',
                    'default' => 'no',
                    'id' => $field->getFreeIdField(),
                 ];

            };
        $freeSettings['free_cart_end'] =
            [
                'type' => 'sectionend',
                'id' => 'wc_settings_tab_customcheckout_free_cart_title',
            ];
        return $freeSettings;
    }

    public function defaultOptions()
    {
        //waiting for response to optimize
        $defaultBillingFields = $this->getDefaultBillingFields();


        foreach ($defaultBillingFields as $fieldName ) {
            $field = new Field( $fieldName);
            $pricedIdField = $field->getPricedIdField();
            if (!get_option($pricedIdField) || '' === get_option($pricedIdField)) {
                add_option($pricedIdField, 'no');
            }
            $freeIdField = $field->getFreeIdField();
            if (!get_option($freeIdField) || '' === get_option($freeIdField)) {
                add_option($freeIdField, 'no');
            }
        }
    }

}
