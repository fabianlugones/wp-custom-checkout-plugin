<?php

namespace WP_Custom_Checkout;

class CustomCheckout
{

    public function __construct()
    {
        add_action( 'wp', [$this, 'billingFieldsDisplay'] );
    }

    public function getDefaultBillingFields()
    {   
        $countries = new \WC_Countries();
        //Get all billing fields corresponding to the base country
        return array_keys($countries->get_address_fields( $countries->get_base_country(),'billing_'));
    }

    public function billingFieldsDisplay()
    {

        //Check if is checkout
        if (function_exists('is_checkout') && (is_checkout() || is_ajax())) {
            add_filter( 'woocommerce_checkout_fields', function( $fields ) {
                $fieldsToRemove = $this->getFieldsToRemove();
                if (!empty($fieldsToRemove)) {
                
                    // unset each of those unwanted fields
                    foreach( $fieldsToRemove as $fieldName ) {
                        unset( $fields['billing'][ $fieldName ] );
                    }
                
                }
                return $fields;
                
            } );    

            
            
            
        }

        else {
            return; 
        }


    }

    public function fieldSelected($fieldId,$allOptions)
    {
        if ($allOptions[$fieldId] == 'yes')
        {
            return true;
        }
        else
        {
            return false; 
        }
    }

    public function getFieldsToRemove()
    {
        //get all setting values (options)
        $allOptions= wp_load_alloptions();
        //get all billing fields 
        $billingFieldsNames=$this->getDefaultBillingFields();
        //If the purchase is priced 
        if (WC()->cart && WC()->cart->needs_payment()) {
            foreach ($billingFieldsNames as $fieldName)
            {   $field = new Field($fieldName);
                //If this field has been selected in the settings panel, will be included in the array fields to remove
                if ($this->fieldSelected($field->getPricedIdField(), $allOptions))
                {
                    $fieldsToRemove[]=$fieldName;
                }
            }
        }
        //If the purchase is free
        else {
            foreach ($billingFieldsNames as $fieldName)
            {   $field = new Field($fieldName);
                //If this field has been selected in the settings panel, will be included in the array fields to remove
                if ($this->fieldSelected($field->getFreeIdField(),$allOptions))
                {
                    $fieldsToRemove[]=$fieldName;
                }
            }
        }

        return $fieldsToRemove;
    }    

    public function removeBillingFields($fieldsToRemove)
    {
        
	}
}

