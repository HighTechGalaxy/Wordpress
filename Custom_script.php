2.1. Enqueue Your Custom Scripts With the wp_enqueue_script() Function

If you want to add your script to the header, you only need to define a custom handle ('custom' in the example below) and the path to the script. As you can see below, I've also used the get_stylesheet_directory_uri() WordPress function to get the URI of the child theme directory. And the add_action() function adds the custom tutsplus_enqueue_custom_js() function to the wp_enqueue_scripts action hook, which lets you enqueue custom scripts you want to display on the front-end of your site.
/* Custom script with no dependencies, enqueued in the header */
add_action('wp_enqueue_scripts', 'tutsplus_enqueue_custom_js');
function tutsplus_enqueue_custom_js() {
    wp_enqueue_script('custom', get_stylesheet_directory_uri().'/scripts/custom.js');
}


Besides enqueuing scripts for the header, you can also use the wp_enqueue_script() function to add custom JavaScript to the footer template. However, in this case, you also need to define all the optional parameters, respectively: 

the dependencies: array() as we have no dependencies for now
the version of the script: false as we don't want to add version numbers
whether this is for the header or footer template: true as we switch to the footer template, which is the non-default option

/* Custom script with no dependencies, enqueued in the footer */
add_action('wp_enqueue_scripts', 'tutsplus_enqueue_custom_js');
function tutsplus_enqueue_custom_js() {
    wp_enqueue_script('custom', get_stylesheet_directory_uri().'/scripts/custom.js', 
    array(), false, true);
}

If your custom script has dependencies, you need to add them to the array() parameter of the wp_enqueue_script() function. There are a couple of popular scripts and libraries, such as jQuery, that are already registered by the WordPress core, so you can add them using their registered handle ('jquery' in the example below).

/* Custom script with jQuery as a dependency, enqueued in the footer */
add_action('wp_enqueue_scripts', 'tutsplus_enqueue_custom_js');
function tutsplus_enqueue_custom_js() {
    wp_enqueue_script('custom', get_stylesheet_directory_uri().'/scripts/custom.js', 
    array('jquery'), false, true);
    
    2.2. Print Out Your Inline Script With the wp_head or wp_footer Action Hooks
    
    This is how you can use the wp_head action hook to print out an inline script in the header template:
<?php
/* Inline script printed out in the header */
add_action('wp_head', 'tutsplus_add_script_wp_head');
function tutsplus_add_script_wp_head() {
    ?>
        <script>
            console.log("I'm an inline script tag added to the header.");
        </script>
    <?php
}

And this is how you can use the wp_footer action hook to print out an inline script in the footer template:

<?php
/* Inline script printed out in the footer */
add_action('wp_footer', 'tutsplus_add_script_wp_footer');
function tutsplus_add_script_wp_footer() {
    ?>
        <script>
            console.log("I'm an inline script tag added to the footer.");
        </script>
    <?php
}
