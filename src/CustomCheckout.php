<?php

namespace WP_Custom_Checkout;

class CustomCheckout
{

    public function __construct()
    {
        add_action( 'wp', [$this, 'removeFields'] );
    }

    public function getDefaultBillingFields()
    {   
        $countries = new \WC_Countries();
        //Get all billing fields corresponding to the base country
        return array_keys($countries->get_address_fields( $countries->get_base_country(),'billing_'));
    }

    public function removeFields()
    {

        //Check if is checkout
        if (function_exists('is_checkout') && (is_checkout() || is_ajax())) {
            //get all setting values (options)
            $allOptions= get_alloptions();
            
            if (WC()->cart && WC()->cart->needs_payment()) {
                foreach ($pricedFieldsIds as $field)
                {
                    //Tengo que preguntar si valor de mi field tiene yes en el arreglo de options que traje
                    if ($allOptions[$field] == 'yes')
                    {
                        $fieldsToRemove[]=$field;
                    }
                }
            }
            else {
                foreach ($freeFieldsIds as $field)
                {
                    //Tengo que preguntar si valor de mi field tiene un yes el arreglo de options que traje
                    if ($allOptions[$field] == 'yes')
                    {
                        $fieldsToRemove[]=$field;
                    }
                }
            }

            }

        else {
            return; 
        }

        //Acá debería remover los fields que traje 


    }

    
}
