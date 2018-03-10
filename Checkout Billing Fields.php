<?php

// Hook in custom fields
add_filter( 'woocommerce_checkout_fields' , 'custom_fields' );

// Add Custom Fields to Checkout page
function custom_fields( $fields ) {
     $fields['billing']['billing_test_dropdown'] = array(
        'label'     => __('Test Dropdown Field', 'woocommerce'),
        'placeholder'   => _x('dropdown field', 'placeholder', 'woocommerce'),
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
          
     
     $fields['billing']['billing_test_text'] = array(
    'label'     => __('Test Text Field', 'woocommerce'),
    'placeholder'   => _x('text field', 'placeholder', 'woocommerce'),
    'required'  => true,
    'class'     => array('form-row-wide'),
    'clear'     => true
     );

     
     $fields['billing']['billing_test_checkbox'] = array(
        'type'          => 'checkbox',
        'class'         => array('input-checkbox'),
        'label'         => __('I have read and agreed.'),
        'required'  => true,
        );
     
     
     $fields['billing']['billing_test_radio'] = array(
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
     
$fields['billing']['test_text_field'] = array(
     'label'     => __('Test Text', 'woocommerce'),
    'placeholder'   => _x('Test Text', 'placeholder', 'woocommerce'),
    'required'  => true,
    'class'     => array('form-row-wide'),
    'clear'     => true
     );
     
     
     return $fields;
}

//* Process the checkout
 add_action('woocommerce_checkout_process', 'wps_select_checkout_field_process');
 function wps_select_checkout_field_process() {
    global $woocommerce;
    // Check if set, if its not set add an error.
    if ($_POST['billing_test_dropdown'] == "blank")
     wc_add_notice( '<strong>Please select a dropdown option</strong>', 'error' );
     
}     
     
 
/**
 * Update the order meta with field value
 */
add_action( 'woocommerce_checkout_update_order_meta', 'my_custom_checkout_field_update_order_meta' );
 
function my_custom_checkout_field_update_order_meta( $order_id ) {
    if ( ! empty( $_POST['test_text_field'] ) ) {
        update_post_meta( $order_id, 'test_text_field', sanitize_text_field( $_POST['test_text_field'] ) );
    }
}


 
//* Display field value on the admin side order page
add_action( 'woocommerce_admin_order_data_after_billing_address', 'wps_select_checkout_field_display_admin_order_meta', 10, 1 );
function wps_select_checkout_field_display_admin_order_meta($order){
	echo '<p><strong>'.__('Dropdown Option').':</strong> ' . get_post_meta( $order->id, '_billing_test_dropdown', true ) . '</p>';
    echo '<p><strong>'.__('Test Text').':</strong> ' . get_post_meta( $order->id, '_billing_test_text', true ) . '</p>';
    echo '<p><strong>'.__('My Checkbox').':</strong> ' . get_post_meta( $order->id, '_billing_test_checkbox', true ) . '</p>';
    echo '<p><strong>'.__('My Radio').':</strong> ' . get_post_meta( $order->id, '_billing_test_radio', true ) . '</p>';
    echo '<p><strong>'.__('My Test Text Field').':</strong> ' . get_post_meta( $order->id, 'test_text_field', true ) . '</p>';
}


//* Add selection field value to emails
add_filter('woocommerce_email_order_meta_keys', 'wps_select_order_meta_keys');
function wps_select_order_meta_keys( $keys ) {
	$keys['Dropdown'] = '_billing_test_dropdown';
    $keys['Text'] = '_billing_test_text';
    $keys['Checkbox'] = '_billing_test_checkbox';
    $keys['Radio'] = '_billing_test_radio';
    $keys['Text2'] = 'test_text_field';
     
	return $keys;
	
}