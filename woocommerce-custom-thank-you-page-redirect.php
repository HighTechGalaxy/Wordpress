<?php 

//it will be rather simple to make redirection by creating a new plugin or opening the file functions.php that you can find in wp-content/themes/your-theme-name/ and enter the following code to the end of the file:

add_action( 'template_redirect', 'woo_custom_redirect_after_purchase' );
function woo_custom_redirect_after_purchase() {
	global $wp;
	if ( is_checkout() && !empty( $wp->query_vars['order-received'] ) ) {
		wp_redirect( 'http://localhost:8888/woocommerce/custom-thank-you/' );
		exit;
	}
}
?>



<?php
// Changing the Thank You page title & placed in the file functions.php

add_filter( 'the_title', 'woo_title_order_received', 10, 2 );

function woo_title_order_received( $title, $id ) {
	if ( function_exists( 'is_order_received_page' ) && 
	     is_order_received_page() && get_the_ID() === $id ) {
		$title = "Thank you for your order! :)";
	}
	return $title;
}



<?php
	
	// You can go one step forward & also personalize the Thank You page title to include details like the customer’s name, or anything else.You can add the below code in a plugin or in your theme’s functions.php:

add_filter( 'the_title', 'woo_personalize_order_received_title', 10, 2 );
function woo_personalize_order_received_title( $title, $id ) {
    if ( is_order_received_page() && get_the_ID() === $id ) {
	    global $wp;

        // Get the order. Line 9 to 17 are present in order_received() in includes/shortcodes/class-wc-shortcode-checkout.php file
        $order_id  = apply_filters( 'woocommerce_thankyou_order_id', absint( $wp->query_vars['order-received'] ) );
        $order_key = apply_filters( 'woocommerce_thankyou_order_key', empty( $_GET['key'] ) ? '' : wc_clean( $_GET['key'] ) );

        if ( $order_id > 0 ) {
            $order = wc_get_order( $order_id );
            if ( $order->get_order_key() != $order_key ) {
                $order = false;
            }
        }

        if ( isset ( $order ) ) {
            //$title = sprintf( "You are awesome, %s!", esc_html( $order->billing_first_name ) ); // use this for WooCommerce versions older then v2.7
	    $title = sprintf( "You are awesome, %s!", esc_html( $order->get_billing_first_name() ) );
        }
    }
    return $title;
}
