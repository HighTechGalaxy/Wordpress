Step 1: Prepare Code Snippets
# To add code to your header, use this code snippet:

/* Describe what the code snippet does so you can remember later on */
add_action('wp_head', 'your_function_name');
function your_function_name(){
?>
PASTE HEADER CODE HERE
<?php
};

# To add code to your footer, use this code snippet:

/* Describe what the code snippet does so you can remember later on */
add_action('wp_footer', 'your_function_name');
function your_function_name(){
?>
PASTE FOOTER CODE HERE
<?php
};





#Registering Sidebars or Widget Areas in WordPress
If you want to add or register sidebars to your website without plugin.
Then paste the code given below in your functions.php file located at 
website_root_path/wp-content/themes/your_theme/functions.php

<?php
function rmc_sidebar_init() {

    register_sidebar( array(
        'name' => __( 'Your Sidebar Name', 'wpb' ),
        'id' => 'your-sidebar-1',
        'description' => __( 'This is your sidebar description.', 'rmc' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

}

add_action( 'widgets_init', 'rmc_sidebar_init' );
?>

# Adding or Showing Dynamic Sidebars in WordPress Template or Theme Files
For example we want to show sidebar in our all pages. 
Then paste the code given below in your page.php file located at
website_root_path/wp-content/themes/your_theme/page.php where you want your sidebar.

<?php if ( is_active_sidebar( 'your-sidebar-1' ) ) : ?>
    <div id="your-sidebar" class="widget-area" role="complementary">
    <?php dynamic_sidebar( 'your-sidebar-1' ); ?>
    </div>
<?php endif; ?>
