<?php

// Add fields to User Account Billing Address Section 
add_filter('woocommerce_billing_fields', 'custom_woocommerce_billing_fields');
// Add Custom Fields to Checkout page
function custom_woocommerce_billing_fields( $fields ) {
     $fields['billing_test_dropdown'] = array(
        'label'     => __('Custom Dropdown', 'woocommerce'),
        'placeholder'   => _x('dropdown', 'placeholder', 'woocommerce'),
        'required'  => false,
        'class'     => array('form-row-wide'),
        'clear'     => true,
        'type'      => 'select',
        'options'     => array(
           'blank' => __('Choose your choice', 'woocommerce' ),
           'option1' => __('option 1', 'woocommerce' ),
           'option2' => __('option 2', 'woocommerce' )
           )//end of options
     );
          
     
     $fields['billing_test_text'] = array(
     'label'     => __('Test Text', 'woocommerce'),
    'placeholder'   => _x('Test Text Field', 'placeholder', 'woocommerce'),
    'required'  => true,
    'class'     => array('form-row-wide'),
    'clear'     => true
     );

     
     $fields['billing_test_checkbox'] = array(
        'type'          => 'checkbox',
        'class'         => array('input-checkbox'),
        'label'         => __('I have read and agreed.'),
        'required'  => true,
        );
     
     
     $fields['billing_test_radio'] = array(
				                 'type' => 'radio',
								'required' => true,
                                'class'         => array('input-radio'),
                                'label'         => __('Radio Buttons.'),
								'options' => array(
												'Google' => 'Google',
												'Other Search' => 'Other Search Engine<br/>',
												'Friend' => 'Friend<br/>',
												'Friend/Facebook' => 'Facebook/Friend<br/>',
												'Cristal' => 'CristalProStyler on YoutTube',
												'Other' => 'Other<br/>'
												
								)
				);
     

     return $fields;
}