<?php 
// General info
https://codex.wordpress.org/Theme_Development

// Core info
https://wp-learner.com/wotdpress-development/wordpress-core-files-and-functions/

// Theme Handbook
https://developer.wordpress.org/themes/ 

// Demo content an theme unit testing
https://codex.wordpress.org/Theme_Unit_Test

// Util
https://misha.blog/wordpress-codex
https://wp-kama.ru/function/wp_query#suppress_filters

// wp loading
https://www.wpbeginner.com/wp-tutorials/how-wordpress-actually-works-behind-the-scenes-infographic/

// Good utility, dev utility, theme dev utility
https://github.com/WPTT



************  Base of theme dev, theme anatomy ************
Template Hierarchy
https://developer.wordpress.org/themes/basics/template-hierarchy/
https://www.wpbeginner.com/wp-themes/wordpress-template-hierarchy-explained/
// interactive versions of template hierarchy https://wphierarchy.com/


// front-page logic, 
https://www.rarst.net/wordpress/front-page-logic/
https://wordpress.stackexchange.com/questions/110349/template-hierarchy-confused-with-index-php-front-page-php-home-php




// Typical template files include:
comments.php
comments-popup.php
footer.php
header.php
sidebar.php


// Complete Theme folder and file structure, theme folders
assets (dir)
		- css (dir)
		- images (dir)
		- js (dir)
inc (dir)
template-parts (dir)
		- footer (dir)
		- header (dir)
		- navigation (dir)
		- page (dir)
		- post (dir)
404.php
archive.php
comments.php
footer.php
front-page.php
functions.php
header.php
index.php
page.php
README.txt
rtl.css
screenshot.png
search.php
searchform.php
sidebar.php
single.php
style.css


// Templates loading
https://wphierarchy.com/

Page view          			Theme template 
					if exists         	else
Home Page (posts)   home.php			index.php
Home Page (page)	front-page.php		index.php
Single Post			single.php			singular.php	
Single Page 		page.php			singular.php
404 (Not Found)		404.php				index.php
Tag Archive			tag.php				archive.php
Category Archive	category.php		archive.php
Date Archive		author.php			archive.php
Search Results 		search.php			archive.php



// Header for style.css
/*
Theme Name (*): Name of the theme.
Theme URI: The URL of a public web page where users can find more information about the theme.
Author (*): The name of the individual or organization who developed the theme. Using the Theme Author’s wordpress.org username is recommended.
Author URI: The URL of the authoring individual or organization.
Description (*): A short description of the theme.
Version (*): The version, written in X.X or X.X.X format.
License (*): The license of the theme.
License URI (*): The URL of the theme license.
Text Domain (*): The string used for textdomain for translation.
Tags: Words or phrases that allow users to find the theme using the tag filter. A full list of tags is in the Theme Review Handbook.
Domain Path: Used so that WordPress knows where to find the translation when the theme is disabled. Defaults to /languages.
*/


// Create child theme
https://developer.wordpress.org/themes/advanced-topics/child-themes/

// Overriding Parent Theme Functions
https://webdesign.tutsplus.com/tutorials/a-guide-to-overriding-parent-theme-functions-in-your-child-theme--cms-22623


// Steps
1. Create a child theme folder, theme_name-child
2. Create a stylesheet: style.css
	Theme Name – needs to be unique to your theme
	Template – the name of the parent theme directory. The parent theme in our example is the Twenty Fifteen theme, so the Template will be twentyfifteen. You may be working with a different theme, so adjust accordingly.

/*
 Theme Name:   Twenty Fifteen Child
 Theme URI:    http://example.com/twenty-fifteen-child/
 Description:  Twenty Fifteen Child Theme
 Author:       John Doe
 Author URI:   http://example.com
 Template:     twentyfifteen <- ( neaparat cu litera minuscula ca si numele folder-ului )
 Version:      1.0.0
 License:      GNU General Public License v2 or later
 License URI:  http://www.gnu.org/licenses/gpl-2.0.html
 Tags:         light, dark, two-columns, right-sidebar, responsive-layout, accessibility-ready
 Text Domain:  twentyfifteenchild
*/

// Style.css for a Child Theme, short version
/*
Theme Name: My Child Theme
Template: twentyfifteen // the name of the parent theme directory. 
*/



//--> create Page Templates
// Custom Page Template, Page templates are a specific type of template file that can be applied to a specific page or groups of pages.

// Write in template
/*
Template Name: Snarfer
*/


// Enqueue stylesheet in child theme
3. Enqueue stylesheet (create functions.php file)

/**
 * Register and enqueue scripts.
 */
function my_theme_enqueue_styles() {
 
    $parent_style = 'parent-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.
 
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
		);
		
		// Include JS
		wp_enqueue_script( 'custom-js-script', get_stylesheet_directory_uri() . '/custom-js.js', array(), '1.0.0', true); //Print in footer 
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );



// Activate child theme
4. Activate child theme #Activate child theme


// Code for header
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<title><?php wp_title(); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
	<?php wp_head(); ?>
</head>



************ Include jQuery in Wordpress ************
// By default when you enqueue jQuery in Wordpress you must use jQuery, and $ is not used (this is for compatibility with other libraries).
// Your solution of wrapping it in function will work fine, or you can load jQuery some other way (but that's probably not a good idea in Wordpress).
// If you must use document.ready, you can actually pass $ into the function call: 

// jQuery(function ($) { ... } or this:
// ;(function($){your code})(jQuery);


// Working method !!!
(function($) {	
    // $ Works! You can test it with next line if you like
    // console.log($);
})( jQuery );

// Another example
jQuery(function($){ ...your code... });

// Working to, for document.ready option
// Write this if you need it in header
jQuery(document).ready(function( $ ) {
	// $ Works! You can test it with next line if you like
	// console.log($);
});



************ Adding Custom JavaScript to WordPress, add js on login page, add js in admin page ************
https://webdesign.tutsplus.com/tutorials/how-to-add-custom-javascript-to-your-wordpress-site--cms-34368
wp_enqueue_scripts
admin_enqueue_scripts
login_enqueue_scripts



************  Include Template Parts, Linking Theme Files, include files, get paths, template part, include, include parts, include file parts, work with file parts, work files ************
https://codex.wordpress.org/Theme_Development#Referencing_Files_From_a_Template
https://developer.wordpress.org/themes/basics/template-files/
// Connect external file to WP, include wp to file
include('../wp-load.php');

// or (working method)
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );


// Here is an example of WordPress template tags to include specific templates into your page:
// Main needed includes
get_header()   //Load header template.
get_sidebar(); //Load sidebar template.
get_footer();  //Load footer template.
get_search_form(); // Include the search form


// Can create custom template files
get_header( 'your_custom_template' );
get_footer( 'your_custom_template' );
get_sidebar( 'your_custom_template' );


// To include custom theme files, use get_template_part(), get template part, include template parts
// The get_template_part() function should only be used to get template parts.
https://wp-kama.ru/function/get_template_part
https://www.hostpulse.net/help/applications/wordpress/wordpress-template-parts/
get_template_part( string $slug, string $name = null )

get_template_part( 'featured-content' ); 					// include featured-content.php
get_template_part( 'template-parts/login-form' ); // include template-parts/login-form.php
get_template_part( 'content', 'product' );				// include content-product.php 

get_template_part( 'navigation', get_post_type() ); //will return the name of the post type that is currently shown content-post.php


// Need to include in header and footer.php files
wp_head();   // need to incude in header.php file 
wp_body_open(); // New function form v. 5.2 site https://generatewp.com/wordpress-5-2-action-that-every-theme-should-use/?fbclid=IwAR32kkPAU8K44JdAXjDwnu3QSH6GdfvLXTFueJmVsJIYBOuO-rK9QfGlKBE
wp_footer(); // need to incude in footer.php file 


// Get Paths, absolute paths
get_template(); // Retrieves the directory name of the current theme, without the trailing slash.
get_theme_root(); // Retrieves the absolute path to the themes directory, without the trailing slash.
get_template_directory();// Retrieves the absolute path (eg: /home/user/public_html/wp-content/themes/my_theme) to the directory of the current theme.
get_stylesheet_directory(); // This functions returns the absolute path of the current theme (the stylesheet directory) that contains your stylesheet(s).
get_stylesheet_directory_uri(); // Retrieve stylesheet directory URI for the current theme/child theme. Checks for SSL.


get_home_url(); // Retrieves the URL for a given site where the front end is accessible.
get_admin_url() // Retrieves the URL to the admin area for the current site.
get_template_directory_uri(); //Theme URL



// were introduced in WordPress 4.7
get_theme_file_uri()  			- get_template_directory_uri() //old
get_theme_file_path() 			- get_template_directory()
get_parent_theme_file_uri() 	- get_stylesheet_directory_uri()
get_parent_theme_file_path() 	- get_stylesheet_directory()


// Get Paths
// include logo
// Example, include img in template, image path
<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/aternus.png" alt="" width="" height="" />

//Logo in header
the_custom_logo().






************  Template tags, template tag, theme template tags, work with template tags  ************
// Template tags are used within themes to retrieve content from your database. 
https://developer.wordpress.org/themes/basics/template-tags/

// Complete list of template tags
https://developer.wordpress.org/themes/references/list-of-template-tags/


// Main Often Used functions (template tags)
the_excerpt(); https://developer.wordpress.org/reference/functions/the_excerpt/
the_content();
the_time();

bloginfo( 'wpurl' ); //Show Site Url from admin settings
get_site_url(); //Retrieves the URL for a given site where WordPress application files 
get_page_link(); // Retrieves the permalink for the current page or page ID, page link


// Template tags that need to be inside of the loop include
the_content();
the_excerpt();
the_meta();
get_the_ID();
the_time();
the_category();
the_permalink();


// Show list categories, categories link, post categories, show categories, show category, work category
the_category();       // Displays a link to the category or categories a post belongs to. This tag must be used within The Loop.
get_categories();     // If no need HTML markup
get_the_category();   // Retrieve post categories.
get_category_link();  // Returns the correct url for a given Category ID.
wp_list_categories();


// Show categories list link 
https://developer.wordpress.org/reference/functions/wp_dropdown_categories/
wp_list_categories( $arg_list_categories );
wp_dropdown_categories()


// User login Registration
// Show login/registration links. login form
wp_login_url();
wp_registration_url();
wp_login_form(); // Provides a simple login form for use anywhere within WordPress.



bloginfo( 'wpurl' ); //Possible values for show
‘name‘ 					– Displays the “Site Title” set in Settings > General. This data is retrieved from the “blogname” record in the wp_options table.
‘description‘ 	– Displays the “Tagline” set in Settings > General. This data is retrieved from the “blogdescription” record in the wp_options table.
‘wpurl‘ 				– Displays the “WordPress address (URL)” set in Settings > General. This data is retrieved from the “siteurl” record in the wp_options table. Consider echoing site_url() instead, especially for multi-site configurations using paths instead of subdomains (it will return the root site not the current sub-site).
‘url‘ 					– Displays the “Site address (URL)” set in Settings > General. This data is retrieved from the “home” record in the wp_options table. Consider echoing home_url() instead.
‘admin_email‘ 	– Displays the “E-mail address” set in Settings > General. This data is retrieved from the “admin_email” record in the wp_options table.
‘charset‘ 			– Displays the “Encoding for pages and feeds” set in Settings > Reading. This data is retrieved from the “blog_charset” record in the wp_options table. Note: this parameter always echoes “UTF-8”, which is the default encoding of WordPress.
‘version‘ 			– Displays the WordPress Version you use. This data is retrieved from the $wp_version variable set in wp-includes/version.php.
‘html_type‘ 		– Displays the Content-Type of WordPress HTML pages (default: “text/html”). This data is retrieved from the “html_type” record in the wp_options table. Themes and plugins can override the default value using the pre_option_html_type filter.
‘text_direction‘ 	– Displays the Text Direction of WordPress HTML pages. Consider using is_rtl() instead.
‘language‘ 				– Displays the language of WordPress.
‘stylesheet_url‘ 	– Displays the primary CSS (usually style.css) file URL of the active theme. Consider echoing get_stylesheet_uri() instead.
‘stylesheet_directory‘ – Displays the stylesheet directory URL of the active theme. (Was a local path in earlier WordPress versions.) Consider echoing get_stylesheet_directory_uri() instead.
‘template_url‘ / ‘template_directory‘ – URL of the active theme’s directory. Within child themes, both get_bloginfo(‘template_url’) and get_template() will return the parent theme directory. Consider echoing get_template_directory_uri() instead (for the parent template directory) or get_stylesheet_directory_uri() (for the child template directory).
‘pingback_url‘ 		– Displays the Pingback XML-RPC file URL (xmlrpc.php).
‘atom_url‘ 				– Displays the Atom feed URL (/feed/atom).
‘rdf_url‘ 				– Displays the RDF/RSS 1.0 feed URL (/feed/rfd).
‘rss_url‘ 				- Displays the RSS 0.92 feed URL (/feed/rss).
‘rss2_url‘ 				– Displays the RSS 2.0 feed URL (/feed).
‘comments_atom_url‘ – Displays the comments Atom feed URL (/comments/feed).
‘comments_rss2_url‘ – Displays the comments RSS 2.0 feed URL (/comments/feed).
‘siteurl‘ – Deprecated since version 2.2. Echo home_url(), or use bloginfo(‘url’).
‘home‘ 		– Deprecated since version 2.2. Echo home_url(), or use bloginfo(‘url’).

bloginfo('url') // display home site link



************ View Info, get links ************
// Displays information about your site, mostly gathered from the information you supply in your User Profile and General Settings 
https://developer.wordpress.org/reference/functions/bloginfo/

// get url, site url, home url, home link

// If using bloginfo as a variable, for example: $url = bloginfo('url'); it will return null.
bloginfo('wpurl'); //Go to Home page, Show Site Url from admin settings,
bloginfo('name');
bloginfo('url'); // get only main address
bloginfo('description');

// get site url
https://developer.wordpress.org/reference/functions/site_url/
//can use like a variable $home_url = get_site_url();
echo get_site_url(); //Retrieves the URL for a given site where WordPress application files
site_url();

// example
$url = site_url( '/secrets/', 'https' ); 
echo $url; // Output: https://www.example.com/secrets/ or https://www.example.com/wordpress/secrets/

// For get variable from bloginfo use
get_bloginfo( 'name', string $filter = 'raw' );
get_bloginfo( 'name');



*** work escape data, work Untrusted Data ***
wp_specialchars()
htmlspecialchars()
esc_html()
clean_url()
esc_url()
attribute_escape()
esc_attr()



*** PAGES, section pages ***
// list of pages
https://wp-kama.ru/function/get_pages
https://developer.wordpress.org/reference/functions/wp_list_pages/

// Get page title
get_the_title( $post->ID );

wp_dropdown_pages( $args );

// List pages
https://developer.wordpress.org/reference/functions/wp_list_pages/
wp_list_pages();// Creating a List of Pages, view list of page

// show with Walker class
// $walker_page = new Walker_Page();
// $walker_page->walk(); 
// echo '<ul>'.$walker_page->walk(get_pages(), 0).'</ul>'; 


* section archive pages *
the_archive_title( '<h1 class="page-title">', '</h1>' ); // Display the archive title based on the queried object.
the_archive_description( '<div class="archive-description">', '</div>' ); // Display category, tag, term, or author description.


// Display a List of Child Pages For a Parent Page in WordPress, child pages
function wpb_list_child_pages() { 
	global $post; 
	if ( is_page() && $post->post_parent )
		$childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->post_parent . '&echo=0' );
	else
		$childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->ID . '&echo=0' );
	if ( $childpages ) {
		$string = '<ul>' . $childpages . '</ul>';
	}
	echo get_the_title( $post->post_parent );
	// echo $post->post_parent;
	return $string;
	}
	echo wpb_list_child_pages();
	
	
************ work query, querys, get query object ************

// get query data, query debug
https://codex.wordpress.org/WordPress_Query_Vars#Query_variables
get_query_var(); //

// global var about query
global $wp_query;  // nu este neaparat
debug($wp_query);

var_dump($wp_query->posts); 
var_dump(count($wp_query->posts)); // count objects
var_dump($wp_query->post_count); // show post_count

// $post_count - The number of posts being displayed.
// $found_posts - The total number of posts found matching the current query parameters


************ work Conditional Tags, detect templates, detect pages, template conditional ************
https://codex.wordpress.org/Conditional_Tags
https://developer.wordpress.org/themes/basics/conditional-tags/
https://developer.wordpress.org/themes/basics/conditional-tags/#function-reference


// Condition for view or not on Home Page
if( !is_home() && !is_front_page() ){}

// Detect Admin page
is_admin() // checks if the Dashboard or the administration panel is attempting to be displayed
if ( ! is_admin() ) {
	echo "You are viewing the theme";
} else {
	echo "You are viewing the WordPress Administration Panels";
}


// For The Blog Page
if ( is_front_page() && is_home() ) {
  // Default homepage
} elseif ( is_front_page() ) {
  // static homepage
} elseif ( is_home() ) {
  // blog page
} else {
  //everything else
}

if ( is_front_page() && is_home() ) {
	echo 'Default homepage';
} elseif ( is_front_page() ) {
 echo 'static homepage';
} elseif ( is_home() ) {
 echo 'blog page';
} else {
 echo 'everything else';
}

// Single Post, 
is_single();

// get Query
is_main_query();
get_query_var();

// query Taxonomy
is_tax(); // Determines whether the query is for an existing custom taxonomy archive page.

// Archive page or posts
if ( 'partners' == is_archive() )

// Page
https://codex.wordpress.org/Conditional_Tags#A_PAGE_Page

if ( is_page() && $post->post_parent > 0 ) { 
    echo "This is a child page";
}
is_page( 42 ) // Page Id

// Is a Page Template
is_page_template( 'about.php' ); // include subdirectoru ex. ‘page-templates/about.php’

// Is a Page Category
is_category( $category ) 

// Is Tag
is_tag() 

// not WP function, check if is array
is_array() // The is_array() function is used to find whether a variable is an array or not.


get_post_type() // if post type Post types, check post type, get post type
if ('book' == get_post_type())
is_post_type_hierarchical( 'book' ) // Returns true if the book post type was registered as having support for hierarchical.
is_post_type_archive( $post_type )
is_comments_popup() // is comments
is_page(); // is page
is_page_template( 'about.php' ) // is page template
is_category()
has_excerpt() // Determines whether the post has a custom excerpt. Check excerpt exists
is_active_sidebar()
is_plugin_active() // is plugin active, check plugin activation
is_child_theme()

is_user_logged_in()// check user login 

// Testing for Sub-Pages, if sub page
<?php  global $post; // if outside the loop

	if ( is_page() && $post->post_parent > 0 ) { 
		echo "This is a child page";
   } else {
     // This is not a subpage
	 }
}

// Simple example
if ( $post->post_parent > 0 ) {
	echo "This is a child page";
} else {
	echo "This is a parent page";
}
?>

// Multisite home page
if ( is_main_site($blog_id) ) {
  // display something special for the main site.
}

is_multisite();
is_super_admin();
is_user_logged_in();

// Woocommerce conditional tags
https://docs.woocommerce.com/document/conditional-tags/

// For woocommerce
is_woocommerce()
is_shop()
is_product_tag() //Product tag page is_product_tag( 'shirts' )
is_product_category() //is_product_category( array( 'shirts', 'games' ) ), 

is_product() // Single product page	
is_cart() // 	Cart page

is_account_page()


/**
 * Override The Template Hierarchy, override template, rewrite template
 */
https://bynicolas.com/code/override-template-hierarchy/
// My example for WooCommerce
/**
 * Create one custom template for all WooCommerce Cart pages
 * @param $template
 * @return mixed|string
 */
function include_custom_cart_template($template)
{
    if (is_cart()) {
        $new_template = locate_template(array( 'resources/views/page-cart.blade.php' ));
        if (!empty($new_template)) {
            return $new_template;
        }
    }

    return $template;
}
add_filter('template_include', 'include_custom_cart_template', 10);



/**
 * Func for detect if is login page, custom function for detect login page.
 * @return bool
 */
function isLoginPage()
{
	$is_login_page = false;

	$ABSPATH_MY = str_replace(array('\\', '/'), DIRECTORY_SEPARATOR, ABSPATH);

	// Was wp-login.php or wp-register.php included during this execution?
	if (
		in_array($ABSPATH_MY . 'wp-login.php', get_included_files()) ||
		in_array($ABSPATH_MY . 'wp-register.php', get_included_files())
	) {
		$is_login_page = true;
	}

	// $GLOBALS['pagenow'] is equal to "wp-login.php"?
	if (isset($GLOBALS['pagenow']) && $GLOBALS['pagenow'] === 'wp-login.php') {
		$is_login_page = true;
	}

	// $_SERVER['PHP_SELF'] is equal to "/wp-login.php"?
	if ($_SERVER['PHP_SELF'] == '/wp-login.php') {
		$is_login_page = true;
	}

	return $is_login_page;
}



************ work with The Loop, Show Posts, the main loop, get posts, post info, the loop, the main loop, show posts, posts info, the loop, loop, post object, work with posts, work loop ************
https://codex.wordpress.org/The_Loop
https://developer.wordpress.org/themes/basics/the-loop/
https://clubmate.fi/an-in-depth-look-into-the-wp_query-and-a-wordpress-loop/


// Properties
https://codex.wordpress.org/Function_Reference/$post
$post // global object wich contain post information, post info object, post object
//  or 
print_r($wp_query); 


<?php
	global $post;
	echo $post->post_title;
?>


// The Loop must always begin with the same if and while statements, 
// post loop, standard loop, main loop, basic loop
- basic loop function -

<?php if ( have_posts() ) : ?>
    <?php while ( have_posts() ) : the_post(); ?>
        //... Display post content (the_content())
		the_title();
		the_permalink()
		the_time( 'd / m / y' ); 
		get_the_excerpt()// wp_trim_words( get_the_excerpt(), 30, __( ' ...', 'show_review_posts' ) );
		the_content();
    <?php endwhile; ?>
<?php endif; ?>

// or

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    // code here 
<?php endwhile; else : ?>
    // code here
<?php endif; ?>	

<?php

// or with custom query

// arguments, custom query loop
$args = array( 
	'arg_1' => 'val_1', 
	'arg_2' => 'val_2'
 );

// Custom Query
$the_query = new WP_Query( $args );

// The Loop
if ( $the_query->have_posts() ) {

    while ( $the_query->have_posts() ) : $the_query->the_post(); 
        // Your code here
    endwhile;

} else {
				// no posts found
				_e('Sorry, no posts found.', 'theme_domain');
}

// Short syntax, alternative short sintax
https://www.php.net/manual/ro/control-structures.alternative-syntax.php
// PHP offers an alternative syntax for some of its control structures; namely, if, while, for, foreach, and switch. 
if ( $the_query->have_posts() ) : 

	while ( $the_query->have_posts() ) : $the_query->the_post(); 
			// Your code here
	endwhile;

 else : 
			// no posts found
			_e('Sorry, no posts found.', 'theme_domain');
	
	endif;



// how to use query functions from https://wp-kama.ru/id_767/3-sposoba-postroeniya-tsiklov-v-wordpress.html
query_posts() // — если нужно изменить/подправить стандартный вывод записей на страницах WordPress. Можно использовать 1 раз на странице;
get_posts() 	// — если нужно вывести записи из Базы Данных. Можно использовать сколько угодно раз на странице;
wp_query() 		// — во всех других случаях когда не подошли query_posts() и get_posts(). Класс WP_Query() является ядром query_posts() и get_posts() и может быть использован для каких-либо сложных случаев вывода.

/* Restore original Post Data */
wp_reset_postdata(); // recomended
or
wp_reset_query(); // is preferred for secondary loops.


// Template Tags - posts function that need to be inside of the loop included
the_content();
the_excerpt();
the_meta();
get_the_ID(); // get post id, function post id
the_time();
the_category();
next_post();
previous_post();


// Template blog, post view utils, view post tags, posts metatags
the_tags();
the_category(); //the_category( ', ' ) - show without list and comma if more items
the_author();


// get post time, get post date,
https://developer.wordpress.org/reference/functions/the_date/
the_date(); <?php the_date('d.m.y'); ?>
the_time('F j, Y'); // show the post plublished date


// get post meta, custom fields
get_post_meta(); // Retrieves a post meta field for the given post ID.
the_meta(); // Display a list of post custom fields.


// view categories names
// Display category list for a post in either HTML list or custom format.
the_category();

// work only with wp_query
// Display or retrieve page title for category archive
// Usefull then need ti display title with some text in the begin or end of the title
// https://developer.wordpress.org/reference/functions/single_cat_title/
single_cat_title()

// Main Often Used functions (template tags)
the_excerpt(); https://developer.wordpress.org/reference/functions/the_excerpt/
the_content();
the_time();

get_the_title(id);// Get single post title, get post title


// Count user posts number, posts number, get posts number,
https://codex.wordpress.org/Function_Reference/count_user_posts
// count user posts
count_user_posts( $userid , $post_type );

https://codex.wordpress.org/Function_Reference/wp_count_posts
// whose properties are the count of each post status of a post type.
wp_count_posts( $type, $perm );


// conditional tags wich works with main query
is_main_query() //Determines whether the query is the main query.



************ Post child posts, parent post, parent pages, child pages, show parent post, show child post, parent posts ************
// general functions
has_post_parent( int|WP_Post|null $post = null );
get_post_parent(); // Retrieves the parent post object for the given post.


// How to display only top level posts in loop via WP_Query
// pre_get_posts filter is called before WordPress gets posts

// Detect parent posts in preget filter
add_filter( 'pre_get_posts', 'my_get_posts' );

function my_get_posts( $query ) {
		//if page is an archive and post_parent is not set and post_type is the post type in question
		if ( is_archive() && false == $query->query_vars['post_parent'] &&  $query->query_vars['post_type'] == 'my_post_type')
				//set post_parent to 0, which is the default post_parent for top level posts
				$query->set( 'post_parent', 0 );
		return $query;
}

// get parent post only
if ( get_post_type() == 'partners' && $post->post_parent == 0  ){
	// do something
} ?>

// Take from ACF post value
$value  = get_field('seller_slogan', $post->post_parent);


	
************ Post object manipulation ************
https://codex.wordpress.org/Class_Reference/WP_Post

// Accessing the WP_Post Object
$examplePost = get_post();
echo $examplePost->ID; // Display the post's ID

// Check if post text is empty, check empty post
<?php if ( empty( get_the_content() ) ){ echo "Empty"; } ?>

<?php if( '' !== get_post()->post_content ) : ?>
<?php endif; ?>



************ WP_Query, work with wp_query, !custom query, custom query custom loop, post type, multiple loops ************
// WP_Query is a class defined in wp-includes/class-wp-query.php 
https://codex.wordpress.org/Query_Overview
https://developer.wordpress.org/reference/classes/wp_query/
https://codex.wordpress.org/Custom_Queries
https://wp-kama.ru/id_767/3-sposoba-postroeniya-tsiklov-v-wordpress.html
https://codex.wordpress.org/The_Loop#Multiple_Loops_in_Action // Multiple loops in action

// Custom query
https://codex.wordpress.org/Custom_Queries#Default_WordPress_Behavior (This article discusses how to modify queries using hooks.)

// Query Params
https://developer.wordpress.org/reference/classes/wp_query/parse_query/

// Query posts (diagram)
https://developer.wordpress.org/files/2016/06/avoid_query_posts.png

// parse_query is an action triggered after WP_Query->parse_query() has set up query variables
https://developer.wordpress.org/reference/classes/wp_query/parse_query/
parse_query();

// Sets up The Loop with query parameters.
https://developer.wordpress.org/reference/functions/query_posts/
// setup parameters for standard loop
query_posts(); // This must not be used within the WordPress Loop.

// Global object / variables

* wp query functions *
// main base functions, get posts, get post
wp_query(); // @link https://codex.wordpress.org/Class_Reference/WP_Query
get_post(); // @link https://wp-kama.ru/function/get_post, show single post
get_posts();// @link https://codex.wordpress.org/Template_Tags/get_posts


// get custom posts
https://wp-kama.ru/id_767/3-sposoba-postroeniya-tsiklov-v-wordpress.html
https://wordpress.stackexchange.com/questions/1753/when-should-you-use-wp-query-vs-query-posts-vs-get-posts (don't use query_posts() ever.)
query_posts() // — если нужно изменить/подправить стандартный вывод записей на страницах WordPress. Можно использовать 1 раз на странице;
get_posts() 	// — если нужно вывести записи из Базы Данных. Можно использовать сколько угодно раз на странице, get_posts are faster than WP_Query
							// 	 should be used for non paginated queries only, doesn't modify global variables and is safe to use anywhere.
wp_query() 		// — во всех других случаях когда не подошли query_posts() и get_posts().	
							// 	Класс WP_Query() является ядром query_posts() и get_posts() и может быть использован для каких-либо сложных случаев вывода.

pre_get_posts(); // filter to use 

// pre get posts
https://wpshout.com/practical-uses-pre_get_posts/
// pre get posts is useful when it’s best not to write a new query, 
// but to change one that already exists.
pre_get_posts(); // fillter pre get post
add_action( 'pre_get_posts', 'callback_function_name' );

// example
add_action( 'pre_get_posts', 'wpshout_pages_blogindex' );
function wpshout_pages_blogindex( $query ) {
	if ( is_home() && $query->is_main_query() ) :
		$query->set( 'post_type', 'page' );
	endif;
}


// Get custom posts count, custom posts count, custom post type count.
function wp_get_custompost_count($postType, $postStatus = 'publish') {

	$args = array(
			'post_type'     => $postType, 
			'post_status'   => $postStatus, 
			'posts_per_page' => -1
	);
	$query = new WP_Query($args);

	// return (int)$query->found_posts;
	return (int)$query->post_count;
}


// use with is_main_query() and with other conditional tags to be sure to get what we want
is_main_query()// hooking into 'pre_get_posts' and altering the main query by using is_main_query().


* Restore original Post Data *
wp_reset_postdata(); // recomended
or
wp_reset_query(); // is preferred for secondary loops.


// test custom query, query vars
https://codex.wordpress.org/WordPress_Query_Vars
get_query_var('paged'); // Retrieve public query variable in the WP_Query class of the global $wp_query object.

// This will reset the loop counter and allow you to do another loop.
// Resetting multiple loops, multiple loops
wp_reset_postdata(); 	// when you are running custom or multiple loops with WP_Query, this is the most common function you will use to reset loops.
wp_reset_query(); 		// You MUST use this function to reset your loop if you use query_posts(), is not best practice and should be avoided if at all possible. 
rewind_posts(); 			// This is useful if you want to display the same query twice in different locations on a page.

// custom loop
// List of arguments https://www.billerickson.net/code/wp_query-arguments/
// Arguments
// Query example by post id and post type
$args = array(
  'posts_per_page' => -1,
  'post_type' => array('page', 'page-sections'),
  'orderby'   => 'post__in', 
  'post__in' 	=> array(1761, 104, 84)
);


// Use wp_query post
// Initialize new object
$the_query = new WP_Query( $args );

// The Loop Query Loop, custom query lopp
if ( $the_query->have_posts() ) {
    while ( $the_query->have_posts() ) : $the_query->the_post(); 
      // Your code here
	  the_permalink()
	  the_time( 'd / m / y' ); 
	  get_the_excerpt()// wp_trim_words( get_the_excerpt(), 30, __( ' ...', 'show_review_posts' ) );
	  the_content();
    endwhile;
} else {
      // no posts found
}
wp_reset_postdata(); 


// clear and simple 
$the_query = new WP_Query( $args );

// The Loop
if ( $the_query->have_posts() ) {
	while ( $the_query->have_posts() ) {
      $the_query->the_post();
	  // Do Stuff
	} // end while
} // endif

// Reset Post Data
wp_reset_postdata();


// List of posts, get_posts view, list of posts, posts list, quick loop, simple query loop, foreach loop
$args = array( 'post_type' => 'post-type-name', 'posts_per_page' => -1 );
$myposts = get_posts( $args );
foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
    <li>
        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
    </li>
<?php endforeach; wp_reset_postdata(); ?>


- Show posts Advanced methods -
//To access a global variable in your code, you first need to globalize the variable with 

global $variable;

ex. global $post; //for show post manipulations
$post (WP_Post) //The post object for the current post. Object described in Class_Reference/WP_Post.


*** My examples ***

//Sets up global post data. Helps to format custom query results for using Template tags.
//https://codex.wordpress.org/Function_Reference/setup_postdata
setup_postdata(); 

//https://codex.wordpress.org/Function_Reference/wp_reset_postdata
wp_reset_postdata(); 


// Example show list of posts of custom post type, get_posts view, list of posts, posts list
global $post;
$args = array( 'post_type' => 'post-type-name', 'posts_per_page' => -1 );

$myposts = get_posts( $args );
foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
    <li>
        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
    </li>
<?php endforeach; wp_reset_postdata();   ?>

<?php

************ Show categories with posts on category page, get categories, show categories, show category post, list posts by category, work category ************

// Filter the WP_Query with categories
// Inspiration https://wesbos.com/wordpress-list-posts-by-category/
https://www.youtube.com/watch?v=e8nJMopiH2Q&t=1s

echo wp_list_categories(); // Display or retrieve the HTML list of categories.
https://developer.wordpress.org/reference/functions/wp_list_categories/

get_categories(); // Retrieve list of category objects.
https://developer.wordpress.org/reference/functions/get_categories/

// Display Only Top-Level Parent Categories
https://pagecrafter.com/display-only-top-level-parent-categories-wordpress/

// Main Functions
wp_list_categories(); 
get_categories();
get_the_category();
the_category; 	// Show only in main loop


--> Example of show latest posts with categories list view <--

    // Wp_list_categories settings
	$arg_list_categories = array(
		'child_of'           => '1',
		'show_option_all'    => '',
		'orderby'            => 'ID',
		'order'              => 'ASC',
		'style'              => 'list',
		'hide_empty'         => 0,
		'use_desc_for_title' => 1,
		'show_option_none'   => __( '' ),
		'number'             => null,
		'echo'               => 1,
		'taxonomy'           => 'category',
		'title_li'           => '',
	);
	wp_list_categories( $arg_list_categories );
	

// limit to the category Id
$args_cat = array('include' => '1,2,3');
$categories = get_categories($args_cat);
$category = $category->term_id; //Get current category ID
	foreach ($categories as $category) :
		the loop;
	endforeach;	
	
// show in standard loop, my modification
// This tag may be used outside The Loop by passing a post id as the parameter.
get_the_category()[0]->name; // get category name


// Show custom posts in the category
$cats = get_categories();

foreach ($cats as $cat) {
	$cat_id = $cat->term_id;
	echo "<h2>" . $cat->name . "</h2>";

	// query_posts("cat=$cat_id&post_per_page=10");
	$the_query = new WP_Query("cat=$cat_id&post_per_page=3");

	if( $the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>

		<a href="<?php the_permalink(); ?>"><?php the_title() ?></a>
		<hr/>	

	<?php endwhile; endif; 
} 


// show last post, recent post, get recent posts
// Retrieve the most recent posts without main loop, show last post
// https://codex.wordpress.org/Function_Reference/wp_get_recent_posts

// !Don't use the 'helper' methods, Use WP_Query() instead of wp_get_recent_posts();
wp_get_recent_posts( $args, $output );

// Another example with get_posts() function
$args = array( 'post_type' => 'blog', 'posts_per_page' => 1, 'order'=> 'ASC', 'orderby' => 'date' );
$postslist = get_posts( $args );
foreach ( $postslist as $post ) : setup_postdata( $post );


// simple list of categories
<div class="categories">
	<ul>
	<?php
		$cat_args = array(
			'exclude' => array(1),
			'option_all' => 'All',
			'taxonomy' => 'seminte'
		);

		$categories = get_categories($cat_args);

		foreach($categories as $cat) : ?>

		<li>
			<a href="<?= get_category_link($cat->term_id); ?>"><?= $cat->name; ?></a>
		</li>

		<?php endforeach;

	?>
	</ul>
</div>

<?php
// wp query filters
https://wp-kama.ru/hook/pre_get_posts
pre_get_posts() // This hook is called after the query variable object is created, but before the actual query is run.

- wp_query utils -

// Show post ID (indiferent of declared variable)
$post->ID // get post id without loop

// Get number of posts
$total = $query_Posts->found_posts;

// Get link to post type
get_post_type_archive_link('post_type_name');


// Meta query, meta properties
http://scribu.net/wordpress/advanced-metadata-queries.html
query_posts( array(
  'post_type' => 'product',
  'meta_key' => 'price',
  'meta_value' => 100,
  'meta_compare' => '>'
) );



Theme Functions
************ How to include CSS/JS libraries, js scripts ************
//include styles, include scripts, deregister, unregister

/************ How to include libraries ************/
// Modalitate de includere direct in header-ul temei (nu este recomandata)
// Sa nu uitam de ordinea de includere si executie a scripturilor si bibliotecilor

https://developer.wordpress.org/themes/basics/including-css-javascript/
https://premium.wpmudev.org/blog/adding-jquery-scripts-wordpress/a


// Functii necesare pentru includerea fisierelor
// Pentru includerea directa in HTML
bloginfo('stylesheet_directory') /assets/css/... // Lucreaza ca get_template_directory_uri()

get_stylesheet_uri();            // duce la style.css de baza
get_template_directory_uri();    // duce la folderul tema respectiva
get_stylesheet_directory_uri();  // duce la folderul cu tema child (sau acolo unde se afla style.css)


// modalitatea cea mai corecta de a include scripturi si css
// construim functia respectiva apoi chemam cu add_action


/**
 * Enqueue scripts and styles, connect scripts
 */
function include_theme_name_scripts() {
	
	// Include CSS
	wp_enqueue_style( 'style-name', get_stylesheet_uri() ); // This will look for a stylesheet named “style” and load it.
	wp_enqueue_style( 'main-style', get_template_directory_uri()  . '/assets/css/style.css', array('bootstrap'), '1.0.0', 'all' ); //Includerea fisierelor aditionale 
	
	
	// Include JS
	wp_enqueue_script( 'script-name', get_template_directory_uri() . '/js/example.js', array(), '1.0.0', true); //Print in footer 

	// deconect, deregister script from child theme
	wp_deregister_style( string $handle );
	wp_deregister_script( 'modernizr');
}
add_action( 'wp_enqueue_scripts', 'include_theme_name_scripts' );


// Adding Scripts to the WordPress Admin
https://codex.wordpress.org/Plugin_API/Action_Reference/admin_enqueue_scripts
function my_admin_scripts() {
    wp_enqueue_script( 'my-great-script', plugin_dir_url( __FILE__ ) . '/js/my-great-script.js', array( 'jquery' ), '1.0.0', true );
}
add_action( 'admin_enqueue_scripts', 'my_admin_scripts' );


/**
 * function for automatic inclusion of css files, auto including files
 * dar cu functia asta nu poti seta ordinea incarcarii
 */
function cascade_policy_scripts() {
	// add styles
	$files_css = scandir(get_template_directory() . "/css");
	foreach ($files_css as $file_css) {
			if (is_file(get_template_directory() . "/css/$file_css")) {
					wp_register_style($file_css . '-style', get_template_directory_uri() . '/css/' . $file_css);
					wp_enqueue_style($file_css . '-style');
			}
	}
	
	// add jquery plugins
	wp_enqueue_script('cascade-jquery',  	    	get_template_directory_uri() . '/js/jquery.min.js', array(), '3.5.1', true);
	wp_enqueue_script('cascade-bootstrap',      get_template_directory_uri() . '/js/bootstrap.min.js', array(), '4.5.3', true);
	wp_enqueue_script('cascade-slick',          get_template_directory_uri() . '/js/slick.js', array(), '1.2.3', true);
	wp_enqueue_script('cascade-main-functions', get_template_directory_uri() . '/js/main.js', array(), '1.1.1', true);

}
add_action('wp_enqueue_scripts', 'cascade_policy_scripts');


// explicarea functiilor, include styles
// CSS
wp_enqueue_style( $handle, $src, $deps, $ver, $media );
wp_enqueue_style( 'nume aleatoriu', get_template_directory_uri()  . '/assets/css/style.css', array('dependenta' false if no), 'versiunea', 'screens' );

// include font awesome (need to copy from my GD. fonts - design/Fonts/fontawesome/webfonts to fonts folder or from site source)
// https://fontawesome.com/how-to-use/on-the-web/setup/hosting-font-awesome-yourself
wp_enqueue_style( 'font-awesome', get_template_directory_uri()  . '/assets/css/all.min.css', false, '5.2.0', 'all');

// JS
wp_enqueue_script( $handle, $src, $deps, $ver, $in_footer);
wp_enqueue_script( 'script-name', get_template_directory_uri() . '/js/example.js', array('dependenta' false if no ), 'versiunea', true/false - footer/header);


// Functii aditionale
// If need to deregister default WP juqery, include jquery
wp_deregister_script('jquery');


// deregister style,  action must be with 9999 executed index
add_action( 'wp_enqueue_scripts', 'child_theme_enqueue_styles',  9999 );
wp_dequeue_style( 'style-name' );
wp_deregister_style( 'style-name' );


// If need to after jquery (or another script)
wp_enqueue_script( 'script-name', get_template_directory_uri() . '/js/example.js',  array( 'jquery' ), '', false );


// If need to include css libraries in last of "all"
function add_custom_ng_style() {
	wp_register_style('custom-ng-style', get_template_directory_uri().'/css/custom-ng.css'); // Register stylesheet
	wp_enqueue_style( 'custom-ng-style');	// Enqueue stylesheet
}
add_action('wp_enqueue_scripts', 'add_custom_ng_style', 12 );


// Or "don't this method" - wich don't work all times :(
<link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/css/custom-ng.css">


// include script, include styles, snippet, include scripts
function theme_name_scripts() {
	wp_enqueue_style( 'purcari_corporate-style', get_stylesheet_uri());
	
	wp_enqueue_style( 'font-awesome', get_template_directory_uri()  . '/assets/css/all.min.css', false, '5.2.0', 'all');
	wp_enqueue_style( 'bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css', array(), '4.3.1', 'all' );
	
	// bootstrap scripts
	wp_deregister_script('jquery');
	wp_enqueue_script( 'jquery', 		'https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js', array(), '3.4.1', true );
	wp_enqueue_script( 'popper-js', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js', array('jquery'), '1.14.7', true );
	wp_enqueue_script( 'bs-js', 		'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js', array('popper-js'), '4.3.1', true );
	
	// wp_enqueue_script( 'purcari_corporate-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
	// wp_enqueue_script( 'purcari_corporate-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'theme_name_scripts' );


// Include JS code, include scripts, include script in footer
// Admin footer
https://codex.wordpress.org/Plugin_API/Action_Reference/admin_print_scripts
add_action( 'admin_print_scripts', 'function_name' ); // mainly used to echo inline javascript in admin pages header.
add_action('admin_print_footer_scripts', 'my_action_javascript', 99); // work in admin 


https://codex.wordpress.org/Plugin_API/Action_Reference/wp_head
add_action('wp_head', 'wpb_hook_javascript'); // In front page 
add_action('wp_footer', 'wpb_hook_javascript', 99)); // In front page 

// Include JS code on specific page template
function wpb_hook_javascript() {
  if ( is_page ('10') ) { 
    ?>
        <script type="text/javascript">
          // your javscript code goes here
        </script>
    <?php
  }
}

wp_enqueue_scripts() 		// - for enqueuing on the front end
login_enqueue_scripts() // - for enqueuing on the login page, include script login page
admin_enqueue_scripts() // - for enqueuing on admin pages


// JavaScript directly into HTML documents, include js directly
// Should be CDATA encoded to prevent errors in older browsers.
<script type="text/javascript">
/* <![CDATA[ */
// content of your Javascript goes here
/* ]]> */
</script>



// deregister scripts, Remove scripts,
https://crunchify.com/try-to-deregister-remove-comment-reply-min-js-jquery-migrate-min-js-and-responsive-menu-js-from-wordpress-if-not-required/
wp_deregister_script()
wp_deregister_style()
wp_dequeue_script()
wp_dequeue_style()


// remove comment-reply
function remove_comment_reply() {
    wp_deregister_script('comment-reply');
}
add_action('init', 'remove_comment_reply');



// Change script tag, add async, add defer prop, add atribute to script
https://developer.wordpress.org/reference/hooks/script_loader_tag/

// For CF7 Google captcha solution
https://wordpress.org/support/topic/load-recaptcha-v3-asynchronously/

// add atributes to loaded script
add_filter( 'script_loader_tag', 'add_id_to_script', 10, 3 );
function add_id_to_script( $tag, $handle, $src ) {
    if ( 'dropbox.js' === $handle ) {
        $tag = '<script type="text/javascript" src="' . esc_url( $src ) . '" id="dropboxjs" data-app-key="MY_APP_KEY"></script>';
    }
 
    return $tag;
}



************ Include Google Fonts (Example), include fonts ************
function google_fonts() {
	$query_args = array(
		'family' => 'Open+Sans:400,700|Oswald:700'
		'subset' => 'latin,latin-ext',
	);
	wp_register_style( 'google_fonts', add_query_arg( $query_args, "//fonts.googleapis.com/css" ), array(), null );
	wp_enqueue_style( 'google_fonts');
}
            
add_action('wp_enqueue_scripts', 'google_fonts');

function custom_add_google_fonts() {
	wp_enqueue_style( 'custom-google-fonts', 'https://fonts.googleapis.com/css?family=Lato:300,400,400i', false );
}
	add_action( 'wp_enqueue_scripts', 'custom_add_google_fonts' );




************ Show post formats ************
site https://codex.wordpress.org/Post_Formats
// make use of get_post_format() to check the format for a post

if ( has_post_format( 'video' )) {
  echo 'this is the video format';
}




************ Show post !thumbnails, feature image, show images in posts, work with thumbnails, image thumbnails ************
site https://codex.wordpress.org/Post_Thumbnails
site https://developer.wordpress.org/reference/functions/the_post_thumbnail/
site https://www.wpbeginner.com/wp-themes/how-to-set-a-default-fallback-image-for-wordpress-post-thumbnails/

// responsive images in wordpress
site https://make.wordpress.org/core/2015/11/10/responsive-images-in-wordpress-4-4/


// Default settings for image size
'thumbnail_size_w' => 150,
'thumbnail_size_h' => 150,
'medium_size_w' => 300,
'medium_size_h' => 300,
'medium_large_size_w' => 768,
'medium_large_size_h' => 0,
'large_size_w' => 1024,
'large_size_h' => 1024,


// In the first need to Enabling Support for Post Thumbnails
add_theme_support( 'post-thumbnails' ); 

the_post_thumbnail(); // the_post_thumbnail( 'size' ); 
get_the_post_thumbnail( $post_id ); // get_the_post_thumbnail($post->ID);  

// thumbnail url, image url, get image url, image src
wp_get_attachment_url( $id ); // get image url https://codex.wordpress.org/Function_Reference/wp_get_attachment_url
wp_get_attachment_url( get_post_thumbnail_id() ); // show custom post thumbnail url

// another method of get image url, better cose permit image size setup
get_the_post_thumbnail_url( int|WP_Post $post = null, string|array $size = 'post-thumbnail' )
get_the_post_thumbnail_url(get_the_ID(),'full' ) // to take $post ID

// Add custom image size
// https://developer.wordpress.org/reference/functions/add_image_size/
add_image_size() // Reserved Image Size Names  'thumb', 'thumbnail', 'medium', 'large', 'post-thumbnail', 'full'
if ( has_post_thumbnail() ) { 
	the_post_thumbnail( 'your-custom-size' ); 
}

// For Media Library Images in Admin page
add_filter( 'image_size_names_choose', 'my_custom_sizes' );
function my_custom_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'your-custom-size' => __( 'Your Custom Size Name' ),
    ) );
}


// Call Featured Image from Parent Page, parent featured image
if( has_post_thumbnail( $post->post_parent ) ) {
	echo get_the_post_thumbnail( $post->post_parent );
}

<?php if( has_post_thumbnail( $post->post_parent )) : ?>
	<div class="partner-logo">
			<?php echo get_the_post_thumbnail( $post->post_parent, 'post-thumbnail', array('class' => 'img-thumbnail') ); ?>
	</div>
<?php endif; ?>

<?

// in the start need to activate thumbnails support in functions.php
add_theme_support('post-thumbnails');

// register thumbnail size
add_image_size( 'post-thumbnails', 300, 180, true );

// or if you want to show it directly in template
the_post_thumbnail(array( 300, 180)); //Show in template, hard crop.

// if wan to add class style to thumbnail
the_post_thumbnail('thumbnail', array( 'class' => 'img-responsive'));


// Thumbnail sizes ( modify settings in dashboard Settings/Media )
// without parameter -> Post Thumbnail (as set by theme using set_post_thumbnail_size())
get_the_post_thumbnail( $post_id );                   
 
get_the_post_thumbnail( $post_id, 'thumbnail' );      // Thumbnail (Note: different to Post Thumbnail)
get_the_post_thumbnail( $post_id, 'medium' );         // Medium resolution
get_the_post_thumbnail( $post_id, 'large' );          // Large resolution
get_the_post_thumbnail( $post_id, 'full' );           // Original resolution 
get_the_post_thumbnail( $post_id, array( 100, 100) ); // Other resolutions, hard crop ,custom resolution

// Example
get_the_post_thumbnail_url(get_the_ID(), 'full');

// Set the Post Thumbnail Size (functions.php)
set_post_thumbnail_size( 50, 50 ); // 50 pixels wide by 50 pixels tall, resize mode
set_post_thumbnail_size( 50, 50, true ); // 50 pixels wide by 50 pixels tall, crop mode
set_post_thumbnail_size( 50, 50, array( 'top', 'left')  ); // 50 pixels wide by 50 pixels tall, crop from the top left corner
set_post_thumbnail_size( 50, 50, array( 'center', 'center')  ); // 50 pixels wide by 50 pixels tall, crop from the center


// check if the post has a Post Thumbnail assigned to it.
// quick show thumbnail, condition show thumbnail, check thumbnails, check if thumbnails exists
if ( has_post_thumbnail() ) {
	the_post_thumbnail();
} 
<?php if ( has_post_thumbnail()) : endif; ?>

<?php if ( has_post_thumbnail()) : ?>
	<?php the_post_thumbnail('post-thumbnail', array('class' => 'img-thumbnail')); ?>
<?php endif; ?>


site https://codex.wordpress.org/Function_Reference/the_post_thumbnail_url
the_post_thumbnail_url();	 // You can use get_the_post_thumbnail_url() in the same way.
the_post_thumbnail_url( 'thumbnail' );  // Thumbnail (default 150px x 150px max)
the_post_thumbnail_url( 'medium' );     // Medium resolution (default 300px x 300px max)
the_post_thumbnail_url( 'large' );      // Large resolution (default 640px x 640px max)
the_post_thumbnail_url( 'full' );       // Full resolution (original size uploaded)
the_post_thumbnail_url( array(100, 100) );  // Other resolutions


//show thumbnails, get thumbnails
//example, standard need to put in main loop, post thumbnails, check post thumbnails
// verify if post thumbnail exists
<?php if ( has_post_thumbnail() ) : ?>
    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
        <?php the_post_thumbnail('size'); ?>
    </a>
<? endif; ?>

<?php the_post_thumbnail(get_the_ID(), 'large') ?>

<?
// example with wp_get_recent_posts()
// need to pass 'post ID' to the get_the_post_thumbnail() function, in main loop query no need to do this.
// https://wordpress.stackexchange.com/questions/245769/get-recent-posts-with-thumbnail

wp_get_recent_posts()
$args = array( 'numberposts' => '3' );
$recent_posts = wp_get_recent_posts($args);

foreach( $recent_posts as $recent ){
   if ( has_post_thumbnail( $recent["ID"]) ) {
      echo  get_the_post_thumbnail($recent["ID"],'thumbnail'); // get_the_post_thumbnail($post->ID); 
    }
}


//my code for thumbnails space if they don't exists in post 
 <a href="<?php echo get_permalink($recent["ID"]); ?>">
  <?php if ( has_post_thumbnail($recent["ID"]) ) {
              echo get_the_post_thumbnail($recent["ID"],'medium');
          }
          else { ?>
            <div class="default-post-image">
                <span>Lipsă Imagine Reprezentativă</span>
            </div>
          <?php } ?>
</a>

//example, bg image
<div style="background-image:url('<?php the_post_thumbnail_url('large'); ?>')"></div>

<div  style="background-image: url('<?php if (has_post_thumbnail()) {
	echo get_the_post_thumbnail_url(get_the_ID(), 'full');
} ?>')">
</div>


<?php if (has_post_thumbnail()) {
		the_post_thumbnail('medium', array('class' => 'img-responsive thumbnail-news-single-post-image'));
} ?>

wp_get_attachment_image();

<?
************ Images ************
site https://developer.wordpress.org/themes/functionality/media/images/

//display the image file located within your theme directory, images in theme
<img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" />


//Scale an image to fit a particular size (such as ‘thumb’ or ‘medium’).
site https://developer.wordpress.org/reference/functions/image_downsize/
image_downsize(); 


// To show menu item in Media Library settings
add_filter( 'image_size_names_choose', 'my_custom_sizes' );
function my_custom_sizes( $sizes ) {
return array_merge( $sizes, array(
'homepage-thumb' => __( 'Homepage Thumb' ),
'search-thumb' => __( 'Search Thumb' ),
));
}



************  Comments section, work with comments  ************
// comments count
https://developer.wordpress.org/reference/functions/get_comment_count/
https://codex.wordpress.org/Template_Tags/get_comments_number

// denug
// global $post;
//echo $post->comment_count;

get_comments_number($post_id)

echo get_comments_number(); 					// Get current post Comments Number
echo get_comments_number($post->ID); 	// Get specific post Comments Number



************ work Pagination, single post navigation, work with posts navigation, work pagination ************
site https://codex.wordpress.org/Pagination
site https://codex.wordpress.org/Next_and_Previous_Links
site https://codex.wordpress.org/Good_Navigation_Links
site https://codex.wordpress.org/Function_Reference/paginate_links


// Custom pagination functions
https://www.billerickson.net/custom-pagination-links/ (better long version)
https://dancameron.org/code/wordpress-paginate_links-customization-bootstrap-compatibility/  (short version)


// Numbered pagination
// Retrieve paginated link for archive post pages. ( e.g.: « Prev 1 … 3 4 5 6 7 … 9 Next » )
// don't work with custom query, need some code 
// paginate links
paginate_links( $args ) // Retrieve paginated link for archive post pages.

<?php $args = array(
	'base'               => '%_%',
	'format'             => '?paged=%#%',
	'total'              => 1,
	'current'            => 0,
	'show_all'           => false,
	'end_size'           => 1,
	'mid_size'           => 2,
	'prev_next'          => true,
	'prev_text'          => __('« Previous'),
	'next_text'          => __('Next »'),
	'type'               => 'plain',
	'add_args'           => false,
	'add_fragment'       => '',
	'before_page_number' => '',
	'after_page_number'  => ''
); ?>

<?php echo paginate_links( $args ); ?>

get_the_posts_pagination( array $args = array() )


// Multiple Posts Pagination
paginate_links();
posts_nav_link();

get_next_posts_link();
get_previous_posts_link();
get_the_posts_pagination();

the_posts_pagination();


// Single Post pagination
// Previous and Next text for single/permalink post
previous_post_link();
next_post_link();

// Displays page-links for paginated posts (i.e. includes the <!--nextpage--> Quicktag one or more times).
wp_link_pages();

// The first set of these site navigation links is featured only on the non-single/non-permalink web pages, such as categories, archives, searches, and the index page. 
posts_nav_link();


// Example of sdandard pagination
<div class="nav-previous alignleft"><?php previous_posts_link( 'Older posts' ); ?></div>
<div class="nav-next alignright"><?php next_posts_link( 'Newer posts' ); ?></div>


https://codex.wordpress.org/Function_Reference/the_posts_pagination
https://codex.wordpress.org/Making_Custom_Queries_using_Offset_and_Pagination

// Standard pagination number with text  ("Posts navigation" "1 2 Next")
the_posts_pagination();
the_post_navigation();


// Retrieve paginated link for archive post pages. Technically, the function can be used to create paginated link list for any area
//  « Prev 1 … 3 4 5 6 7 … 9 Next »
echo paginate_links( $args );

the_posts_pagination( array(
	'mid_size'  => 2,
	'prev_text' => __( 'Back', 'textdomain' ),
	'next_text' => __( 'Onward', 'textdomain' ),
) );

// Without previous and next pages:
the_posts_pagination( array( 'mid_size'  => 2 ) );


// example how to work with custom query, custom query pagination
https://www.youtube.com/watch?v=HMscydyViZw
https://developer.wordpress.org/reference/functions/paginate_links/
https://codex.wordpress.org/Making_Custom_Queries_using_Offset_and_Pagination


// Implement pagination in custom query.  
// Important note 
// Most Pages = paged, 
// Static Front Page = page
// aceste setari trebuiesc chiar daca utilizam bs4pagination (https://gist.github.com/mtx-z/f95af6cc6fb562eb1a1540ca715ed928)
$currentPage = get_query_var('paged'); // Static Front Page = page
$args = array(
	'post_type' => 'post',
	'post_status' => 'publish',
	'posts_per_page' => 2,
	'paged' => $currentPage, // Static Front Page = page
);

$the_query = new WP_Query( $args );

// The Loop
if ( $the_query->have_posts() ) {
	while ( $the_query->have_posts() ) {
			$the_query->the_post();
			the_title(); 
			the_excerpt();
	} 
}	
echo paginate_links(array( 'total' => $the_query->max_num_pages )); 
// or this func for individual page
// next_posts_link('Next Page', $the_query->max_num_pages );
wp_reset_postdata(); 
	

// implementing pagination
<!-- pagination -->
<div class="posts-pagination">
	<?php echo paginate_links(); ?>
</div>
<!-- .pagination -->



// For getting the current pagination number on a static front page (Page template) you have to use the 'page' query variable:
<h1>Currently Browsing Page <?php echo (int) $page; ?> On a static front page</h1>

// My example, pagination example
<ul class="pagination_list">
<?php $paginationArray = paginate_links(
	array( 
		'total' => $the_query->max_num_pages, 
		'prev_text' => '<span></span>',
		'next_text' => '<span></span>',
		'type' => 'array',
	)); 
	
	foreach ( $paginationArray  as $key => $value ) {
		echo '<li class="pagination_item">' . $value . '</li>';
	} 
?>
<script>
	document.addEventListener("DOMContentLoaded", function(event) {
		jQuery(document).ready(function ($) {
			$("a.page-numbers").removeClass("page-numbers").addClass("pagination_item_url");
			$(".prev, .next").addClass("btns");
		});
	});
</script>
</ul>



     
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$args = array( 'paged' =>  $paged);

// Pagination function, custom pagination function, work pagination custom function
function sa_get_bootstrap_paginate_links() {
	ob_start();
	?>
<!--	<div class="pages clearfix">-->
		<?php
		global $wp_query;
		$current = max( 1, absint( get_query_var( 'paged' ) ) );
		$pagination = paginate_links( array(
				'base' => str_replace( PHP_INT_MAX, '%#%', esc_url( get_pagenum_link( PHP_INT_MAX ) ) ),
				'format' => '?paged=%#%',
				'current' => $current,
				'total' => $wp_query->max_num_pages,
				'type' => 'array',
				'prev_text' => __('« Previous', 'starcard'),
				'next_text' => __('Next »', 'starcard'),
		) ); ?>
		<?php if ( ! empty( $pagination ) ) : ?>
			<ul class="pagination justify-content-end">
				<?php foreach ( $pagination as $key => $page_link ) : ?>
					<li class="page-item<?php if ( strpos( $page_link, 'current' ) !== false ) { echo ' disabled'; } ?>">
						<?php echo $page_link ?>
					</li>
				<?php endforeach ?>
			</ul>
		<?php endif ?>
<!--	</div>-->
	<?php
	$links = ob_get_clean();
	return apply_filters( 'sa_bootstap_paginate_links', $links );
}

function sa_bootstrap_paginate_links() {
	echo sa_get_bootstrap_paginate_links();
}




<?
************ work with post comments ************
site https://codex.wordpress.org/Comments_in_WordPress

// If comments are open or we have at least one comment, load up the comment template.
if ( comments_open() || get_comments_number()) {
	comments_template();
}



************ Custom Post Types, work with post type, posts types,  ************
// custom post type, cpt
https://codex.wordpress.org/Post_Types
https://wp-kama.ru/function/register_post_type

https://codex.wordpress.org/Function_Reference/register_post_type
//Create or modify a post type. register_post_type should only be invoked through the 'init' action. 
register_post_type( $post_type, $args ); 


// Get post type link
echo get_post_type_archive_link( 'products' );

// Rules:
// 1. When registering a post type, always register your taxonomies using the taxonomies argument. 
// Even if you register a taxonomy while creating the post type, you must still explicitly register and define the taxonomy using register_taxonomy().


//Reserved Post Types
post
page
attachment
revision
nav_menu_item
custom_css
customize_changeset
oembed_cache
user_request

//The following post types should not be used as they interfere with other WordPress functions.
action
author
order
theme

// Parameters
$post_type
$args


//basic example
function create_post_type() {
	register_post_type( 'acme_product',
	  array(
		'labels' => array(
		  'name' => __( 'Products' ),
		  'singular_name' => __( 'Product' )
		),
		'public' => true,
		'has_archive' => true,
	  )
	);
  }
add_action( 'init', 'create_post_type' );

// Labels
// 'name' - general name for the post type, usually plural. The same and overridden by $post_type_object->label. Default is Posts/Pages
// 'singular_name' - name for one object of this post type. Default is Post/Page
// 'add_new' - the add new text. The default is "Add New" for both hierarchical and non-hierarchical post types. When internationalizing this string, please use a gettext context matching your post type. Example: _x('Add New', 'product');
// 'add_new_item' - Default is Add New Post/Add New Page.
// 'edit_item' - Default is Edit Post/Edit Page.
// 'new_item' - Default is New Post/New Page.
// 'view_item' - Default is View Post/View Page.
// 'view_items' - Label for viewing post type archives. Default is 'View Posts' / 'View Pages'.
// 'search_items' - Default is Search Posts/Search Pages.
// 'not_found' - Default is No posts found/No pages found.
// 'not_found_in_trash' - Default is No posts found in Trash/No pages found in Trash.
// 'parent_item_colon' - This string isn't used on non-hierarchical types. In hierarchical ones the default is 'Parent Page:'.
// 'all_items' - String for the submenu. Default is All Posts/All Pages.
// 'archives' - String for use with archives in nav menus. Default is Post Archives/Page Archives.
// 'attributes' - Label for the attributes meta box. Default is 'Post Attributes' / 'Page Attributes'.
// 'insert_into_item' - String for the media frame button. Default is Insert into post/Insert into page.
// 'uploaded_to_this_item' - String for the media frame filter. Default is Uploaded to this post/Uploaded to this page.
// 'featured_image' - Default is Featured Image.
// 'set_featured_image' - Default is Set featured image.
// 'remove_featured_image' - Default is Remove featured image.
// 'use_featured_image' - Default is Use as featured image.
// 'menu_name' - Default is the same as `name`.
// 'filter_items_list' - String for the table views hidden heading.
// 'items_list_navigation' - String for the table pagination hidden heading.
// 'items_list' - String for the table hidden heading.
// 'name_admin_bar' - String for use in New in Admin menu bar. Default is the same as `singular_name`.

// There are five additional labels have been made available for custom post types since wordpress 5.0

// 'item_published' - The label used in the editor notice after publishing a post. Default “Post published.” / “Page published.”
// 'item_published_privately' - The label used in the editor notice after publishing a private post. Default “Post published privately.” / “Page published privately.”
// 'item_reverted_to_draft' - The label used in the editor notice after reverting a post to draft. Default “Post reverted to draft.” / “Page reverted to draft.”
// 'item_scheduled' - The label used in the editor notice after scheduling a post to be published at a later date. Default “Post scheduled.” / “Page scheduled.”
// 'item_updated' - The label used in the editor notice after updating a post. Default “Post updated.” / “Page updated.”


// Example of implementation
add_action( 'init', 'register_custom_post_types');
function register_custom_post_types(){
  $labels = array(
		'name' => '', 
		'singular_name' => '',
		'add_new' => '', 
		'add_new_item' => '', 
		'edit_item' => '', 
		'new_item' => '', 
		'view_item' => '', 
		'view_items' => '', 
		'search_items' => '', 
		'not_found' => '', 
		'not_found_in_trash'  => '',
		'parent_item_colon' => '', 
		'all_items' => '', 
		'archives' => '', 
		'attributes' => '', 
		'insert_into_item' => '', 
		'uploaded_to_this_item' => '', 
		'featured_image' => '', 
		'set_featured_image' => '', 
		'remove_featured_image' => '', 
		'use_featured_image' => '', 
		'menu_name' => '', 
		'filter_items_list' => '', 
		'items_list_navigation' => '', 
		'items_list' => '', 
		'name_admin_bar' => '', 
		
		'item_published' => '',
		'item_published_privately' => '',
		'item_reverted_to_draft' => '',
		'item_scheduled' => '',
		'item_updated' => '',
  );
  
  $args = array(
    'labels'      => $labels,
    'public'      => true,
    'has_archive' => true,
    'publicly_queryable' => true,
    'query_var'   => true,
    'rewrite'     => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'supports'     => array(
      'title',
      'editor',
      'author',
      'thumbnail', // (featured image, current theme must also support post-thumbnails)
      'excerpt',
      'trackbacks',
      'custom-fields',
      'comments', // (also will see comment count balloon on edit screen)
      'revisions', // (will store revisions)
      'page-attributes', // (menu order, hierarchical must be true to show Parent option)
      'post-formats'
    ),
    'taxonomies'    => array('category', 'post_tag'),
    'menu_position' => 5,
    'exclude_from_search' => false
  );
  register_post_type('potfolio', $args);
}
add_action('init', 'wptuts_custom_post_types');


// add test post type
function insurance_register_test_post_type() {

	$args = array (
		'label' => esc_html__( 'Test name', 'text-domain' ),
		'labels' => array(
			'menu_name' => esc_html__( 'Test name', 'text-domain' ),
			'name_admin_bar' => esc_html__( 'Test name', 'text-domain' ),
			'add_new' => esc_html__( 'Add new', 'text-domain' ),
			'add_new_item' => esc_html__( 'Add new Test name', 'text-domain' ),
			'new_item' => esc_html__( 'New Test name', 'text-domain' ),
			'edit_item' => esc_html__( 'Edit Test name', 'text-domain' ),
			'view_item' => esc_html__( 'View Test name', 'text-domain' ),
			'update_item' => esc_html__( 'Update Test name', 'text-domain' ),
			'all_items' => esc_html__( 'All Test name', 'text-domain' ),
			'search_items' => esc_html__( 'Search Test name', 'text-domain' ),
			'parent_item_colon' => esc_html__( 'Parent Test name', 'text-domain' ),
			'not_found' => esc_html__( 'No Test name found', 'text-domain' ),
			'not_found_in_trash' => esc_html__( 'No Test name found in Trash', 'text-domain' ),
			'name' => esc_html__( 'Test name', 'text-domain' ),
			'singular_name' => esc_html__( 'Test name', 'text-domain' ),
		),
		'public' => true,
		'exclude_from_search' => false,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_nav_menus' => true,
		'show_in_admin_bar' => true,
		'show_in_rest' => false,
		'menu_icon' => 'dashicons-admin-tools',
		'capability_type' => 'post',
		'hierarchical' => false,
		'has_archive' => true,
		'query_var' => true,
		'can_export' => true,
		'rewrite_no_front' => false,
		'supports' => array(
			'title',
			'thumbnail',
		),
		'rewrite' => true,
	);

	register_post_type( 'test-name', $args );
}
add_action( 'init', 'insurance_register_test_post_type' );


// Custom order, post type order, customize order
function order_posts_by_title( $query ) { 

	if ( $query-is_home() && $query-is_main_query() ) { 
		$query-set( 'orderby', 'title' ); 
		$query-set( 'order', 'ASC' ); 
	} 
} 

add_action( 'pre_get_posts', 'order_posts_by_title' );

//function work with custom post type
post_type_archive_title(); // Show Custom Archive Title


// Add Categories and Tags for Pages, pages categories, add categories to pages
function add_categories_to_pages() {
	register_taxonomy_for_object_type( 'category', 'page' );
}
add_action( 'init', 'add_categories_to_pages' );

// To add tags taxonomy in your page
function add_tags_to_pages() {
	register_taxonomy_for_object_type( 'post_tag', 'page' );
	}
	add_action( 'init', 'add_tags_to_pages');



***********  work taxonomy, work taxonomies, taxonomii, tags, terms, get data  ************
https://codex.wordpress.org/Taxonomies
https://wp-kama.ru/id_8218/taksonomii-v-wordpress.html

// Built-in WordPress Helper Functions
// cele mai utilizate
get_taxonomies() - Can be used to fetch all or some registered taxonomies
get_the_terms() - Fetch all terms for a single, specific taxonomy
get_terms() - Fetch all terms for a one or more taxonomies
is_tax(); // Determines whether the query is for an existing custom taxonomy archive page.
get_queried_object() // retrieve the currently-queried object.
has_term() // has term


get_objects_in_term(); // Retrieve object_ids of valid taxonomy and term.
get_term(); // Get all Term data from database by Term ID., generate data like get_queried_object()
get_term_by(); // Get all Term data from database by Term field and data.
get_term_children();
get_term_link(); // Generate a permalink for a taxonomy term archive.
get_terms(); // $tax_term = get_terms(array('taxonomy' => 'field_of_activity', 'hide_empty' => false));
get_the_terms( $post->ID, string $taxonomy );  // Retrieve the terms of the taxonomy that are attached to the post.
get_the_term_list(); // Retrieve a post’s terms as a list with specified format.
get_objects_in_term(); // Retrieve object_ids of valid taxonomy and term.
get_object_taxonomies();
get_post_taxonomies(); 	// Retrieve all taxonomies of a post with just the names. (slug name of taxonomies)
get_the_category(); 		// get category name <?php echo get_the_category()[0]->name; ?>


sanitize term();

wp_get_object_terms(); // Retrieves the terms associated with the given object(s), in the supplied taxonomies.
wp_set_object_terms();
wp_get_post_terms(); // get terms for atached to current post https://codex.wordpress.org/Function_Reference/wp_get_post_terms
wp_set_post_terms();
wp_delete_object_term_relationships();
wp_remove_object_terms(); 

// Checking, conditional tags
is_taxonomy(); // Deprecated taxonomy_exists( string $taxonomy )
is_tax(); // Determines whether the query is for an existing custom taxonomy archive page.
taxonomy_exists( string $taxonomy ); //Determines whether the taxonomy name exists.
is_taxonomy_hierarchical();
is_object_in_taxonomy();
term_exists();
has_term(); // has_term($term, $taxonomy, $post); if( has_term( 'jazz', 'genre' )) { // do something }
taxonomy_exists( string $taxonomy ); // Determines whether the taxonomy name exists.

the_terms();
the_taxonomies(); // This template tag can be used within The Loop to display Links for taxonomies and belonging Terms

// get category tax name
get_the_terms( $post->ID, string $taxonomy ); 
// Show results
// WP_Term Object
// (
// 	[term_id] =>
// 	[name] =>
// 	[slug] =>
// 	[term_group] =>
// 	[term_taxonomy_id] =>
// 	[taxonomy] =>
// 	[description] =>
// 	[parent] =>
// 	[count] =>
// 	[filter] =>
// )

// https://generatewp.com/
// Register Custom Taxonomy
function custom_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Taxonomies', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Taxonomy', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Taxonomy', 'text_domain' ),
		'all_items'                  => __( 'All Items', 'text_domain' ),
		'parent_item'                => __( 'Parent Item', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
		'new_item_name'              => __( 'New Item Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New Item', 'text_domain' ),
		'edit_item'                  => __( 'Edit Item', 'text_domain' ),
		'update_item'                => __( 'Update Item', 'text_domain' ),
		'view_item'                  => __( 'View Item', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Items', 'text_domain' ),
		'search_items'               => __( 'Search Items', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No items', 'text_domain' ),
		'items_list'                 => __( 'Items list', 'text_domain' ),
		'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'taxonomy', array( 'post' ), $args );

}
add_action( 'init', 'custom_taxonomy', 0 );


// get_the_terms will return an array of the taxonomies the post is assigned to
// https://developer.wordpress.org/reference/functions/get_the_terms/
$terms = get_the_terms( $post->ID, 'knowledgehub_topic' );

// Loop through them and display them
foreach($terms as $term) {
   	echo $term->name;
}

// My code to show custom category name
echo get_the_terms( $post->ID, 'categorii_evenimente' )[0]->name;

// Custom codes
$terms = get_the_terms( $post->ID , 'taxonomyname' );
foreach ( $terms as $term ) {echo $term->name;}


// example of used in project, get tax category name
echo(get_the_terms($post->ID, 'laundries_cat')[0]->name); 


// get terms example, get taxonomy terms
$terms_domain		= get_terms( array('taxonomy' => 'categorii_instrumente', 'hide_empty' => false));
<?php echo $terms_domain[0]->taxonomy; ?>
<?php foreach ( $terms_domain as $term ) : ?>
	<option value="<?php echo $term->slug; ?> "><?php echo $term->name; ?></option>
<?php endforeach;?>


// check if has terms, check if has term
<?php 
if ( has_term( '', 'laundries_features') ) 
	{ echo "exists"; } else { echo "no"; }
?>



- examples -
// taxonomy show in ACF
site https://www.advancedcustomfields.com/resources/taxonomy/

$term = get_field('taxonomy_field_name');
if( $term ): ?>
	<h2><?php echo $term->name; ?></h2>
	<p><?php echo $term->description; ?></p>
<?php endif; ?>


// taxonomy utils
// get terms and posts for it
// tax, query by tax, get by tax
https://codex.wordpress.org/Class_Reference/WP_Query#Taxonomy_Parameters

$terms = get_the_terms( $post->ID , 'taxonomy_name' );
	foreach ($terms as $term) {
		$args = array(
			'post_type' => 'news',
			'tax_query' => array(
				array(
					'taxonomy' => 'taxonomy_name',
					'field' => 'slug',
					'terms' => $term->name
				)
			)
		);
		$query = new WP_Query( $args );
		while ( $query->have_posts() ) : $query->the_post(); 
				the_title();
		endwhile; 
}


// get tax info
  $term_list = wp_get_post_terms($post->ID, 'images_logo_category', array("fields" => "all"));
  echo '<pre>';
  print_r($term_list);
  echo '</pre>';
  
  $term_list = wp_get_post_terms($post->ID, 'tax_name', array("fields" => "all"));
  echo '<pre>';
  print_r($term_list);
  echo '</pre>';
  
  echo '<pre>';
  $taxonomy_names = get_post_taxonomies();
  print_r( $taxonomy_names );
  echo '</pre>';
  
  if (has_term( "", 'tax_name', $post->ID )){
    echo "have";
	} else { echo "don't have"; }
	
	
	
	// Display only first level children of my custom taxonomy categories, term first level, category first level
	https://stackoverflow.com/questions/28931677/get-only-first-level-child-categories-of-current-category
	https://pagecrafter.com/display-only-top-level-parent-categories-wordpress/
	$taxonomy_name = 'product-category';
	$queried_object = get_queried_object();
	$term_id = $queried_object->term_id;

	$termchildren = get_terms( $taxonomy_name, array( 'parent' => $term_id, 'hide_empty' => false ) );

	echo '<ul>';
	foreach ( $termchildren as $child ) {
			echo '<li><a href="' . get_term_link( $child, $taxonomy_name ) . '">' . $child->name . '</a></li>';
	}
	echo '</ul>';
	

// one solution for display all terms from parent	
$queried_object = get_queried_object();
$term_id = $queried_object->term_id;
$taxonomy = $queried_object->taxonomy;
$term_childs = get_term_children($term_id, $taxonomy);

if ($term_childs && count($term_childs) > 0) {
	foreach ($term_childs as $child_id) {

		// debug($child_id);
		$term = get_term_by('id', $child_id, $taxonomy);

		// get img url
		$thumb_img = get_field('image_custom_tax_cat', 'term_' . $child_id);
		($thumb_img != null) ? $thumb_img : $thumb_img = get_template_directory_uri() . '/images/box_thumbnail_img.svg';

				echo  get_term_link($term, $taxonomy); 
				echo $thumb_img;
				echo $term->name; 
	} // end foreach
} else {
	_e('No subcategories', 'bioprotect');
} // end if

	
// Adding an Existing Taxonomy to an Existing Post Type
site https://premium.wpmudev.org/blog/wordpress-development-for-intermediate-users-custom-post-types-and-taxonomies/
function wpmu_add_categories_to_pages() {
	register_taxonomy_for_object_type( 'category', 'page' );
}
add_action( 'init', 'wpmu_add_categories_to_pages' );


<?php
************ Taxonomy - tags ************
https://www.wpexplorer.com/list-wordpress-tags/


// Creating A UL List With ALL Your Tags
<h2>Tags</h2>
<ul>
    <?php
    $tags = get_tags();
    if ( $tags ) :
        foreach ( $tags as $tag ) : ?>
            <li><a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>" title="<?php echo esc_attr( $tag->name ); ?>"><?php echo esc_html( $tag->name ); ?></a></li>
        <?php endforeach; ?>
    <?php endif; ?>
</ul> 

<?
// How To Add Post Tags To Pages, add tags to pages
add_action( 'admin_init', 'add_tags_to_pages' );
function add_tags_to_pages() {  
register_taxonomy_for_object_type('post_tag', 'page'); 
}



https://premium.wpmudev.org/blog/add-custom-post-types-to-tags-and-categories-in-wordpress/
// Get all your post types, problem with tags and custom post type
// write in functions.php
$post_types = get_post_types();
 
$query->set( 'post_type', $post_types );
return $query;
}
}
add_filter( 'pre_get_posts', 'add_custom_types_to_tax' );

//If you’d like to add only specific post types to listings of tags and categories you can replace the line:
// this
$post_types = get_post_types();
 // with this:
$post_types = array( 'post', 'your_custom_type' );



************ work with Custom fields ************
https://codex.wordpress.org/Custom_Fields

// To display the Custom Fields for each post, use the the_meta() template tag
// The tag must be put within The Loop in order to work
the_meta();

//The following are more advanced techniques for getting and customizing meta-data and custom fields.
get_post_meta(Post ID, 'key_name', single = true /* default false */); //true if wan to show single string not array
// take all meta from post
<?php echo 'Post Meta: ' . var_dump(get_post_meta()); ?>

// Example
$variable_name = get_post_meta( 8,'variable_name', true);
echo $variable_name;


// work with ACF plugin
// Type Select field
https://www.advancedcustomfields.com/resources/select/

get_field_object(); 

echo get_field_object('field_name')['name']; 

$var_name = get_field_object('field_name');
foreach ($var_name["choices"] as $key => $value) {
	echo $value;
}


// After what need to put this function
function myplugin_pre_get_posts( $query ) {
	// check if the user is requesting an admin page
	// or current query is not the main query
	if ( is_admin() || ! $query->is_main_query() ){
		return;
	}

	// edit the query only when post type is 'food'
	// if it isn't, return
	if ( !is_post_type_archive( 'post_name' )){
		return;
	}

	$meta_query = array();

	// add meta_query elements
	if( !empty( get_query_var( 'custom_query_var' ) ) ){
		$meta_query[] = array( 'key' => 'custom_query_var', 'value' => get_query_var( 'custom_query_var' ), 'compare' => 'LIKE' );
	}

	if( count( $meta_query ) > 1 ){
		$meta_query['relation'] = 'AND';
	}

	if( count( $meta_query ) > 0 ){
		$query->set( 'meta_query', $meta_query );
	}
}
add_action( 'pre_get_posts', 'myplugin_pre_get_posts', 1 );


// Query posts by custom fields, query repeater values, ACF query
https://www.advancedcustomfields.com/resources/query-posts-custom-fields/



************ Admin Menu order ************
/**
 * Menu Structure
 **/

Default: bottom of menu structure #Default: bottom of menu structure
2 – Dashboard
4 – Separator
5 – Posts
10 – Media
15 – Links
20 – Pages
25 – Comments
59 – Separator
60 – Appearance
65 – Plugins
70 – Users
75 – Tools
80 – Settings
99 – Separator


For the Network Admin menu, the values are different: #For the Network Admin menu, the values are different:
2 – Dashboard
4 – Separator
5 – Sites
10 – Users
15 – Themes
20 – Plugins
25 – Settings
30 – Updates
99 – Separator



************ work with Menu System, theme !menus, wp menu, create menu, add menu, work navigation, work menus ************
//Register menu in template/ menus menu / include menu

-> For functions.php <- 
site https://codex.wordpress.org/Navigation_Menus
site https://codex.wordpress.org/Function_Reference/register_nav_menus
site https://developer.wordpress.org/reference/functions/wp_nav_menu/
site https://codex.wordpress.org/Plugin_API/Filter_Reference/nav_menu_link_attributes


// write in functions.php
// Register one menu for a theme
register_nav_menu( string $location, string $description )

// Example 
register_nav_menu( 'primary', __( 'Primary Menu', 'theme-slug' ) );
 
// Extended example 
function register_primary_menu() {
	register_nav_menu( 'primary', __( 'Primary Menu', 'theme-text-domain' ));
}
add_action( 'after_setup_theme', 'register_primary_menu' );

// if multiple menus
register_nav_menus( array(
	'pluginbuddy_mobile' => 'PluginBuddy Mobile Navigation Menu',
	'footer_menu' => 'My Custom Footer Menu',
) );


// My Example
register_nav_menus( array(
		'menu_name'   => 'Menu description',
		'header_menu' => 'Menu in header',
		'footer_menu' => 'Menu in footer'
	));

// Displays a navigation menu, Show menu in template
// Ready to use snippet, show menu, customize menu, use nav menu, work nav
wp_nav_menu( array $args = array(
	'theme_location'  	=> 'primary',
	'menu'              => "", // (int|string|WP_Term) Desired menu. Accepts a menu ID, slug, name, or object.
	'menu_class'        => "", // (string) CSS class to use for the ul element which forms the menu. Default 'menu'.
	'menu_id'           => "", // (string) The ID that is applied to the ul element which forms the menu. Default is the menu slug, incremented.
	'container'         => "", // (string) Whether to wrap the ul, and what to wrap it with. Default 'div'.
	'container_class'   => "", // (string) Class that is applied to the container. Default 'menu-{menu slug}-container'.
	'container_id'      => "", // (string) The ID that is applied to the container.
	'fallback_cb'       => "", // (callable|bool) If the menu doesn't exists, a callback function will fire. Default is 'wp_page_menu'. Set to false for no fallback.
	'before'            => "", // (string) Text before the link markup.
	'after'             => "", // (string) Text after the link markup.
	'link_before'       => "", // (string) Text before the link text.
	'link_after'        => "", // (string) Text after the link text.
	'echo'              => "", // (bool) Whether to echo the menu or return it. Default true.
	'depth'             => "", // (int) How many levels of the hierarchy are to be included. 0 means all. Default 0.
	'walker'            => "", // (object) Instance of a custom walker class.
	'theme_location'    => "", // (string) Theme location to be used. Must be registered with register_nav_menu() in order to be selectable by the user.
	'items_wrap'        => "", // (string) How the list items should be wrapped. Default is a ul with an id and class. Uses printf() format with numbered placeholders.
	'item_spacing'      => "", // (string) Whether to preserve whitespace within the menu's HTML. Accepts 'preserve' or 'discard'. Default 'preserve'.
));


-> For Template <- 
//Show menu in template
https://developer.wordpress.org/reference/functions/wp_nav_menu/
wp_nav_menu();

// My Example
wp_nav_menu(
	array(
		'theme_location'  => 'primary',
		'container'       => 'nav',
		'container_class' => 'navbar-collapse collapse',
		'menu_class'		=> 'nav navbar-nav navbar-right'
	));

// container, container_class, menu_class in this example take class-es from BootStrap.


// Condition if menu doesn't activated
if ( has_nav_menu( 'primary' ) ) { ?>
		<?php
		wp_nav_menu( array(
			'theme_location'	=> 'primary',
			'before'			 		=> '',
			'after'				 		=> '',
			'link_before'	 	 	=> '<span>',
			'link_after'	 	 	=> '</span>',
			'depth'				 		=> 4,
			'container'			 	=> 'div',
			'container_class'	=> 'cg-main-menu')
		);
		?>
	<?php } else { ?>
		<p class="setup-message"><?php echo esc_html__( 'You can set your main menu in Appearance &rarr; Menus', 'factory' ); ?></p>
	<?php } ?>

<?php 
Important
<!-- If the menu (WP admin area) is not set, then the "menu_class" is applied to "container". In other words, it overwrites the "container_class". 
Ref: https://wordpress.org/support/topic/wp_nav_menu-menu_class-usage-bug/?replies=4 


// Add CSS classes to Footer menu 
// link attributes, add attributes in menu a tag, add class to a tag, link atributes, css class to a tag
https://codex.wordpress.org/Plugin_API/Filter_Reference/nav_menu_link_attributes
function add_specific_menu_location_atts( $atts, $item, $args ) {
	// check if the item is in the primary menu
	if( $args->theme_location == 'primary' ) {
		// add the desired attributes:
		$atts['class'] = 'menu-link-class';
	}
	return $atts;
}
add_filter( 'nav_menu_link_attributes', 'add_specific_menu_location_atts', 10, 3 );



************ work with Walker Class, work walker ************
https://codex.wordpress.org/Class_Reference/Walker
https://code.tutsplus.com/tutorials/understanding-the-walker-class--wp-25401
https://core.trac.wordpress.org/browser/trunk/src/wp-includes/class-wp-walker.php
https://www.smashingmagazine.com/2015/10/customize-tree-like-data-structures-wordpress-walker-class/#top

// Settings for Menu's
// Correct functions, 
// Your child class must use the same signature: three arguments, the first one passed by reference. Every difference will raise the error 
function start_lvl(&$output, $depth = 0, $args = array()) {}
function end_lvl(&$output, $depth = 0, $args = array()) {}
function start_el(&$output, $category, $depth = 0, $args = array(), $current_object_id = 0) {}
function end_el(&$output, $category, $depth = 0, $args = array()) {}

// Bootstrap 4 walker class 
	class Walker_Nav_Primary extends Walker_Nav_Menu{
				
				function start_lvl( &$output, $depth = 0, $args = array() ) {//ul
						$indent  = str_repeat("\t", $depth); // indents the outputted HTML
						$submenu = ( $depth > 0 ) ? 'sub-menu' : '';
						$output .= "\n$indent<ul class=\"dropdown-menu$submenu depth_$depth\">\n";
				}
				
				function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) { // li (need div) a

						$indent = ( $depth ) ? str_repeat("\t",$depth) : '';

						$li_attributes = '';
						$class_names = $value = '';

						$classes = empty( $item->classes ) ? array() : (array) $item->classes;

						$classes[] = ($args->walker->has_children) ? 'dropdown' : '';
						$classes[] = ($item->current || $item->current_item_anchestor) ? 'active' : '';
						$classes[] = 'nav-item';
						$classes[] = 'nav-item-' . $item->ID;
						if( $depth && $args->walker->has_children ){
								$classes[] = 'dropdown-menu';
						}
						
						$class_names =  join(' ', apply_filters('nav_menu_css_class', array_filter( $classes ), $item, $args ) );
						$class_names = ' class="' . esc_attr($class_names) . '"';
						
						$id = apply_filters('nav_menu_item_id', 'menu-item-'.$item->ID, $item, $args);
						$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';
						
						$output .= $indent . '<li ' . $id . $value . $class_names . $li_attributes . '>';
						
						$attributes  = ! empty( $item->attr_title ) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
						$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr($item->target) . '"' : '';
						$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
						$attributes .= ! empty( $item->url ) ? ' href="' . esc_attr($item->url) . '"' : '';
						
						$attributes .= ( $args->walker->has_children ) ? ' class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"' : ' class="nav-link"';
						
						$item_output = $args->before;
						$item_output .= ( $depth > 0 ) ? '<a class="dropdown-item"' . $attributes . '>' : '<a' . $attributes . '>';
						$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
						$item_output .= '</a>';
						$item_output .= $args->after;
						
						$output .= apply_filters ( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );					
				}
		}

		// write attr
		'walker' => new Walker_Nav_Primary(), // name of this example


// Example numbered levels add class with numbered index
class Walker_Nav_Additional extends Walker_Nav_Menu{

	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			echo $item->menu_order; //Count levels
			$output .= sprintf( "\n<div class='color". $item->menu_order ."'><a href='%s'%s><h3>%s</h3></a></div>\n",
					$item->url,
					( $item->object_id === get_the_ID() ) ? ' class="current"' : '',
					$item->title
			);
	}
}

if ( has_nav_menu( 'insurance-request-menu-1') ) {
	wp_nav_menu( 
		array( 
			'theme_location' 	=> 'insurance-request-menu-1',
			'container_class' 	=> 'services',
			'fallback_cb' 		=> 'wp_page_menu',
			'walker' 			=> new Walker_Nav_Additional()
		)); 
} ?> 

// generate this HTML code
<ul id="menu-insurance-menu-1" class="menu">
	<div class="color1">
		<a href="#">
			<h3></h3>
		</a>
	</div>
	<div class="color2">
		<a href="#">
			<h3></h3>
		</a>
	</div>
	<div class="color3">
		<a href="#">
			<h3></h3>
		</a>
	</div>
	<div class="color4">
		<a href="#">
			<h3></h3>
		</a>
	</div>
	<div class="color5">
		<a href="#">
			<h3></h3>
		</a>
	</div>
</ul>


// remove the <li> elements that wrap each menu item, only a tags
$menuParameters = array(
  'container'       => false,
  'echo'            => false,
  'items_wrap'      => '%3$s', // removes ul
  'depth'           => 0,
);

echo strip_tags(wp_nav_menu( $menuParameters ), '<a>' );



************ Widget, !widgets, sidebar ************
https://codex.wordpress.org/Sidebars

// generate sidebars
https://generatewp.com/sidebar/

// Widgets initiate	
function awesome_widget_setup(){
	register_sidebar(
		array(
					'name'  => 'Sidebar',
					'id'    => 'sidebar-1',
					'class' => 'custom',
					'description'   => 'Standard Sidebar',
					'before_widget' => '<aside id="%1$s" class="widget %2$s">',
					'after_widget'  => '</aside>',
					'before_title'  => '<h1 class="widget-title">',
					'after_title'   => '</h1>', 
		)
	);
}
add_action('widgets_init','awesome_widget_setup');

// use in template to show widget
<?php dynamic_sidebar( $index ); ?> 

// This ensures your theme will look good when the Widgets plug-in is not active.
<?php if ( ! dynamic_sidebar() ) : dynamic_sidebar(); ?>
<?php if ( !dynamic_sidebar() ) : dynamic_sidebar( 'sidebar-footer-1' ); endif; ?>


<?php if ( is_active_sidebar( 'sidebar-footer-1' ) ) : ?>
	<div class="col-12 col-md-3">
			<!-- Footer Widget -->
			<?php dynamic_sidebar( 'sidebar-footer-1' ); ?>
	</div>
<?php endif; ?>

// Core class used to implement a Recent Posts widget.
WP_Widget_Recent_Posts
the_widget( 'WP_Widget_Recent_Posts' );



************ work with Metaboxes, work with dashboard widgets, work metaboxes ************
https://www.smashingmagazine.com/2011/10/create-custom-post-meta-boxes-wordpress/
// WordPress Meta Boxes: a Comprehensive Developer’s Guide
https://themefoundation.com/wordpress-meta-boxes-guide/ 

// Setup dashboard metaboxes
function add_dashboard_widgets() {
	wp_add_dashboard_widget(
		'claim_location_dashboard_widget',  // Widget slug.
		'Claim Location Dashboard Widget',  // Title.
		'show_claim_location_widget' 				// Display function. Callback
	);	
}
add_action( 'wp_dashboard_setup', 'add_dashboard_widgets' );

// Remove Metaboxes 
https://codex.wordpress.org/Function_Reference/remove_meta_box
remove_meta_box( 'themeisle', 'dashboard', 'advanced' );

/**
 * Remove Slug Fields meta box From Laundries Post
 */
https://developer.wordpress.org/reference/functions/remove_meta_box/
add_action( 'admin_head' , 'wpdocs_remove_post_custom_fields' );
function wpdocs_remove_post_custom_fields() {
  remove_meta_box( 'slugdiv' , 'laundries' , 'normal' );
}

/**
 * work with Metaboxes, error show in metaboxes error, work save data metabox 
 */
// JS example
https://wordpress.stackexchange.com/questions/36180/can-you-make-a-custom-metabox-field-be-required-to-save-a-new-post

// example of WP natively does
https://wordpress.stackexchange.com/questions/15354/passing-error-warning-messages-from-a-meta-box-to-admin-notices





************ work with Filters ************

// Change defaul wp link on login page
function the_url( $url ) {
	return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'the_url' );

// Registration page custom login
function ng_custom_login_logo() {
	$site_addres = get_home_url();
	echo '<style type="text/css">
				h1 a {
							background-image:url('. $site_addres .'/wp-content/themes/prosanatate/assets/img/logo.png) !important; 
							margin:0 auto; 
							width: 250px !important; 
							background-size: 250px !important;
							}
				</style>';
}
add_filter( 'login_head', 'ng_custom_login_logo' );




************ Metadata API ************
// The Metadata API is a simple and standarized way for retrieving and manipulating metadata of various WordPress object types
get_post_meta();
get_user_meta();




************ Expand capabilities, user roles, users management, users control, user control, user work ************
// Capabilities
https://isabelcastillo.com/assign-custom-post-type-capabilities-roles-wordpress
https://codex.wordpress.org/User_Levels#User_Level_0_2


// Roles slug's
administrator
editor
author
contributor
subscriber


// Check if user is logged in
is_user_logged_in();
get_current_user_id(); //get user id

https://codex.wordpress.org/Function_Reference/get_userdata
get_userdata( $userid ); // Returns a WP_User object with the information pertaining to the user whose ID

https://codex.wordpress.org/wp_get_current_user
wp_get_current_user(); // To return the current user object (WP_User).
wp_get_current_user()->roles[0]; // Role name

$current_user = wp_get_current_user();
$current_user->user_login;
$current_user->user_email;
$current_user->user_firstname;
$current_user->user_lastname;
$current_user->display_name;
$current_user->ID;


// example show user Id
echo  get_userdata( get_current_user_id() )->user_login;

// or function

wp_get_current_user(); // Retrieve the current user object (WP_User).
echo wp_get_current_user()->user_login;

 
// determine if a user is logged in.
<?php
	$current_user = wp_get_current_user();
	if ( 0 == $current_user->ID ) {
			// Not logged in.
	} else {
			// Logged in.
	}
?>


// Include style css on some user roles, in front
add_action( 'wp_enqueue_scripts', 'hide_from_author_users' );
function hide_from_author_users(){
    if( in_array( 'author', (array) wp_get_current_user()->roles ) ){
        echo '<style>
            .authorhide {
                display: none;
            }
        </style>';
    }
}


// Include style css on some user role, in dashboard
add_action('admin_head', 'my_custom_fonts');
function my_custom_fonts() {
	if( in_array( 'role_name', (array) wp_get_current_user()->roles ) ){
		// echo '<style;
	}
	
	if( is_user_logged_in() ) {
		$user = wp_get_current_user();
		
		$roles = ( array ) $user->roles;
		echo $roles[0]; // This returns an array, Use this to return a single value return $roles[0];
			} else {
		echo array();
		}
		
	// echo 'Test Script';
}


// Hide posts "All view" from different authors, hide all posts
function posts_for_current_author($query) {
	global $pagenow;

	if( 'edit.php' != $pagenow || !$query->is_admin )
			return $query;

	if( !current_user_can( 'edit_others_posts' ) ) {
			global $user_ID;
			$query->set('author', $user_ID );
	}
	return $query;
}
add_filter('pre_get_posts', 'posts_for_current_author');



************ Usefull/Miscellaneous ************
//Show post Thumnbail link in style:background-image:url(), show background imgs, post thumbnail link
foreach($news as $post) : setup_postdata( $post ); $image = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) ); ?>
	<a href="<?php the_permalink();?>" class="widget_news_list_item" style="background-image:url(<?php echo $image; ?>); background-size: 50px 50px;"><?php the_title();?>
	</a>
<?php endforeach;?>

// Do something then page template it's activated, if page template is activated 
<?php if(get_page_template_slug() == 'template-thank-you.php') ?>


<!-- Image path -->
<!-- Get template path, img -->
get_template_directory_uri();
<img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="">

// Logo img
https://developer.wordpress.org/themes/functionality/custom-logo/
<a href="<?php bloginfo('wpurl') ?>">
	<img src="<?php echo get_template_directory_uri() . '/images/logo.png'; ?>" />
</a>


<!-- Change styles with ternar operator -->
<a href="<?=get_permalink(5);?>"<?=(is_single('page') && get_the_ID() != 63 ? ' class="current"' : '')?>></a>			



************ data time, datatime ************
echo date( 'Y' );

// Elegant WordPress Solution for Dynamic Copyright Date
https://www.wpbeginner.com/wp-tutorials/how-to-add-a-dynamic-copyright-date-in-wordpress-footer/




************ Search Form, custom search form ************
https://developer.wordpress.org/reference/functions/get_search_form/
https://www.wpbeginner.com/wp-tutorials/how-to-create-advanced-search-form-in-wordpress-for-custom-post-types/

// Display search form.
get_search_form();
get_search_form( array $args = array() )

// Fires before the search form is retrieved, at the start of get_search_form().
do_action( 'pre_get_search_form' )


// If you do have searchform.php in your theme, it will be used instead. 
// Keep in mind that the search form should do a GET to the homepage of your blog.
// The input text field should be named s and you should always include a label like in the examples above.
<form action="/" method="get">
    <label for="search">Search in <?php echo home_url( '/' ); ?></label>
    <input type="text" name="s" id="search" value="<?php the_search_query(); ?>" />
    <input type="image" alt="Search" src="<?php bloginfo( 'template_url' ); ?>/images/search.png" />
</form>

// Another example from theme
<form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
	<div class="input">
		<input class="search-field" type="text" name="s" placeholder="<?php esc_attr_e('To search type and hit enter','theme_name') ?>" value=""/>
	</div>
</form>

// Search Fillter
function wpdocs_my_search_form( $form ) {
	$form = '<form role="search" method="get" id="searchform" class="searchform" action="' . home_url( '/' ) . '" >
	<div><label class="screen-reader-text" for="s">' . __( 'Search for:' ) . '</label>
	<input type="text" value="' . get_search_query() . '" name="s" id="s" />
	<input type="submit" id="searchsubmit" value="'. esc_attr__( 'Search' ) .'" />
	</div>
	</form>';

	return $form;
}
add_filter( 'get_search_form', 'wpdocs_my_search_form' );


/**
 * Add HTML5 theme support.
 */
function wpdocs_after_setup_theme() {
	add_theme_support( 'html5', array( 'search-form' ) );
}
add_action( 'after_setup_theme', 'wpdocs_after_setup_theme' );


// WordPress will render its built-in HTML5 search form:
<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
	<label>
		<span class="screen-reader-text"><?php echo _x( 'Search for:', 'label' ) ?></span>
		<input type="search" class="search-field"
					 placeholder="<?php echo esc_attr_x( 'Search …', 'placeholder' ) ?>"
					 value="<?php echo get_search_query() ?>" name="s"
					 title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
	</label>
	<input type="submit" class="search-submit"
				 value="<?php echo esc_attr_x( 'Search', 'submit button' ) ?>" />
</form>


	
	// Settings for Posts Loop
	$category = get_queried_object();
	$category = $category->term_id;
	
	$arg_posts_loop = array(
		'cat'   	=> $category,
		'posts_per_page' => 4
	);
	// Define Query object
	$queryPost = new WP_Query($arg_posts_loop);
	



	
/**
 * Customize excerpt view, the excerpt, custom excerpt custom, work excerpt
 * 
 * https://wordpress.stackexchange.com/questions/141125/allow-html-in-excerpt/141136#141136
 * 
 */

// excerpt size limit, excerpt view
// Change the length of excerpt text, customize excerpt text
function wpse_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'wpse_excerpt_length', 999 );


// function to excerpt by words count
wp_trim_words( get_the_excerpt(), 30, __( ' ...', 'show_review_posts' ) );


// Change [...] to 'Read More' text.
function wpse_excerpt_more( $more ) {
	return ' <a class="read-more" href="'. get_permalink( get_the_ID() ) . '">' . __('Read More', 'your-text-domain') . '</a>';
}
add_filter( 'excerpt_more', 'wpse_excerpt_more' );


// Modify the [...] string using filters, remove another tags, excerpt more
function wpdocs_excerpt_more( $more ) {
	return '[.....]';
}
add_filter( 'excerpt_more', 'wpdocs_excerpt_more' );


// excerpt custom function
// This is for template Theme (not for functions.php), excerpt length function
// if you set your limit to more that 55 words, only 55 words will be returned as 
// the excerpt is only 55 words in length. If longer excerpts are needed, use get_the_content instead.
function wpse_custom_excerpts($limit) {
    $aTag = '<a href="'. esc_url( get_permalink() ) . '">' . '&nbsp;&hellip;' . __( 'Read more &nbsp;&raquo;') . '</a>';
	// $aTag = '...';
	
	return wp_trim_words(get_the_excerpt(), $limit, $aTag);
}
echo wpse_custom_excerpts(30);





************ Debug, debug functions ************
//Activate log files in wp-config.php
define( 'WP_DEBUG', true ); //Enabling WP_DEBUG will cause all PHP errors, notices and warnings to be displayed.
define( 'WP_DEBUG_DISPLAY', true ); //controls whether debug messages are shown inside the HTML of pages or not.
define( 'WP_DEBUG_LOG', true ); //Enable Debug logging to the /wp-content/debug.log file 

// will load jQuery Migrate in debug mode, and output stack traces in your JavaScript developer console.
define( 'SCRIPT_DEBUG', true );


Include aditional files in WP
// Important to include, prevent to execute from url, only in WP environment.
if (!defined('WPINC')) {
    die;
}

// Another method
define( 'ABSPATH', dirname(dirname(__FILE__)) . '/' );

// Debug functions
// show var inf/contain.
var_dump();

// custom funcs
function debug($arr){
  echo '<pre>' . print_r( $arr, true ) . '</pre>';
}

// my debug function, custom debug function to put in functions.php
// Need to improove
function debug($value){
//  $type_of_value = gettype($value);

	if( is_array( $value )  ){
		echo '<pre>' . var_dump($value) . '</pre>';
	}
	else echo '<pre>' . print_r( $value, true ) . '</pre>';
}


// another option, best view, custom debug function
function debug($value)
{
    echo '<pre>';
    if (is_array($value)) {
        echo print_r($value) ;
    } else {
        var_dump($value, true) ;
    }
    echo '</pre>';
}

	
// Debug WPQuery, debug wpquery, debug $wp_query 
global $wp_query;
debug($wp_query);
	


************ Settings API ************
https://codex.wordpress.org/Settings_API
https://wp-kama.ru/id_3773/api-optsiy-nastroek.html
https://developer.wordpress.org/themes/functionality/administration-menus/

// print option value in template 
echo esc_html( get_option( 'phone', '' ) );



************ Disable autoupdate, deactivate autoupdate ************
// add the following line to wp-config.php:
// for core only
define( 'WP_AUTO_UPDATE_CORE', false );
define( 'WP_AUTO_UPDATE_CORE', minor ); //allow minor updates only


// deactivate update and notification (it works)
add_action( 'wp_loaded', 'disable_wp_theme_update_loaded' );
function disable_wp_theme_update_loaded() {
    remove_action( 'load-update-core.php', 'wp_update_themes' );
    add_filter( 'pre_site_transient_update_themes', '__return_null' );
}

// for wp-config.php
// Disable Plugin and Theme Update and Installation
define( 'DISALLOW_FILE_MODS', true );


// use functions.php for these snippets. (this example don't work in 5.2.2)
add_filter( 'auto_update_theme', '__return_false' );
add_filter( 'auto_update_plugin', '__return_false' );

// disable update notifications (work's fine )
function remove_core_updates(){ 
	global $wp_version;
	return(object) 
	array('last_checked'=> time(),
				'version_checked'=> $wp_version,
			); 
}
add_filter('pre_site_transient_update_core','remove_core_updates');
add_filter('pre_site_transient_update_plugins','remove_core_updates');
add_filter('pre_site_transient_update_themes','remove_core_updates');




************ Must use plugins, plugins ************

*** !ACF plugin, acf plugin *** 
https://www.advancedcustomfields.com/resources/
https://www.advancedcustomfields.com/resources/code-examples/

// Displays the value of a specific field.
https://www.advancedcustomfields.com/resources/the_field/


// take values
get_field();			//Returns the value of a specific field.
get_field_object();		//Returns the settings of a specific field.
get_fields();			//Returns an array of field values (name => value) for a specific post.
the_field();			//Displays the value of a specific field.
get_field_objects();	//Returns an array of field settings (name => field) for a specific post

// get from group field
get_field('group_name')['filed_name']; 

// get the fields
get_fields([$post_id], [$format_value]);



https://www.advancedcustomfields.com/resources/get_field/

// the_field
// get_field($selector, [$post_id], [$format_value]);
the_field('field_name'); //Show field the_field($selector, [$post_id], [$format_value]), the same as echo get_field(); 
$value = get_field('field_name', $post->ID);


https://www.advancedcustomfields.com/resources/the_field/
// Example	
<?php the_field('text_field'); ?>
<?php the_field('text_field', 123); ?>


// ACF condition to show values, ACF show acf values, show in front inf, if value exists
<?php if( get_field('name')) : ?>
	<?php echo get_field( 'name' ); ?> or <?php the_field('name'); ?>
<?php endif; ?>


// Get a value from a specific post
$value = get_field( "text_field", 123 );


// take group values
https://www.advancedcustomfields.com/resources/group/
if( have_rows('date_contact') ) :
	while( have_rows('date_contact') ) : the_row();

	// vars
	global $phone;
	global $mail;

 	$phone 	= get_sub_field('numar_telefon');
 	$mail 	= get_sub_field('adresa_email');

endwhile; endif;


// Example
<?php if( have_rows('user_laundries_pricing') ) : ?>
	<?php	while ( have_rows('user_laundries_pricing') ) : the_row(); ?>
		<li>
			<h5><?php	the_sub_field('user_laundries_price-feature-name'); ?></h5>
			<p><?php	the_sub_field('user_laundries_price-feature-description'); ?></p>
			<span><?php	the_sub_field('user_laundries_feature-price'); ?></span>
		</li>
	<?php	endwhile; ?>
<?php endif; ?>


// Basic repeater field
// check if the repeater field has rows of data
if( have_rows('repeater_field_name') ) :
 	// loop through the rows of data
    while ( have_rows('repeater_field_name') ) : the_row();
        // display a sub field value
        the_sub_field('sub_field_name');
    endwhile;
else :
    // no rows found
endif;


// work acf taxonomy term
// Adding fields to a taxonomy term, Getting taxonomy category
https://www.advancedcustomfields.com/resources/adding-fields-taxonomy-term/

//  data from query object
$queried_object = get_queried_object();
$term_id = $queried_object->term_id;
$taxonomy = $queried_object->taxonomy;
$termchilds = get_term_children($term_id, $taxonomy);

// Or standard terms category

  // get all the categories from the database  
  $cats = get_categories();  

  // loop through the categories  
  foreach ($cats as $cat) {  
    // setup the category ID  
		$cat_id= $cat->term_id;  
		
the_field('category-image', 'term_'. $cat_id);



// Show date, time, acf date, acf time
site https://www.advancedcustomfields.com/resources/date-picker/

// Multilanguage show
$dateformatstring = "l d F, Y";
$event_date  = strtotime(get_field('field_name'));
echo date_i18n( $dateformatstring, $event_date );

// Standard function don't work.
site https://support.advancedcustomfields.com/forums/topic/date-output/
$date2 = date("F j, Y", strtotime(get_field('field_name')));
echo $date2;


// example
if (have_posts()) : while ( have_posts()) : the_post(); 

    // Custom Fields Values
    $event_date       = get_field( 'date_event' );

    // Prepare date format view
    $dateformatstring = "d F Y";
    $event_date       = strtotime( get_field( 'date_event' ));
    $event_date       = date_i18n( $dateformatstring, $event_date );
 endwhile; endif; 


// Using conditional statements
// get_field returns false if (value == “” || value == null || value == false)

if(get_field('field_name'))
{
	echo '<p>' . get_field('field_name') . '</p>';
}

// Google maps
https://www.advancedcustomfields.com/resources/google-map/



// ACF user role, ACF hide fields
// CSS based on user role
// use plugin "ACF User Role Field Setting".
https://wordpress.org/plugins/user-role-field-setting-for-acf/#faq
https://github.com/Hube2/acf-user-role-field-setting
https://support.advancedcustomfields.com/forums/topic/acf-hide-field-from-roles/


// ACF and google maps, ACF google maps
https://support.advancedcustomfields.com/forums/topic/google-map-not-displaying-on-wp-backend/


// acf multilanguage polylang
// plugin
https://github.com/BeAPI/acf-options-for-polylang
https://support.advancedcustomfields.com/forums/topic/options-page-polylang/
https://www.advancedcustomfields.com/resources/multilingual-custom-fields/#translating-options%20page%20compatibility

// Interesting Ideea
https://mackeycreativelab.com/advanced-custom-fields-acf-options-page-polylang/


// ACF oEmbed, acf video embed, acf embed
https://www.advancedcustomfields.com/resources/oembed/
<div class="embed-container">
	<?php the_field('oembed'); ?>
</div>

// CSS for Responsive Embeds
<style>
	.embed-container { 
		position: relative; 
		padding-bottom: 56.25%;
		overflow: hidden;
		max-width: 100%;
		height: auto;
	} 

	.embed-container iframe,
	.embed-container object,
	.embed-container embed { 
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
	}
</style>



// ACF Options page
https://www.advancedcustomfields.com/resources/options-page/
$contact_general_phone = get_field('contact_general_phone', 'option');


// If need to filter or do custom query by 'meta_value', filter custom fields
// need to register variable
function themeslug_query_vars( $qvars ) {
  $qvars[] = 'custom_query_var';
  return $qvars;
}
add_filter( 'query_vars', 'themeslug_query_vars' );


// Google maps
// default Addreses for ACF
lat: 47.0078206, lng: 28.8429574,14

// write in functions.php
function my_acf_google_map_api( $api ){
	$api['key'] = 'xxx';
	return $api;
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');




************ Miscellaneous codes ************
//*** Register/login ***//


//*** Register/login ***//
// Change default logo link on login/register page
function the_url( $url ) {
	return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'the_url' );

// Change te default registration link
add_filter( 'register_url', 'my_register_page' );
function my_register_page( $register_url ) {
	return home_url( '/register/' );
}



//*** google analytics ***//
add_action( 'wp_head', 'ng_google_analytics', 10 );
function ng_google_analytics(){ ?>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-130167291-1"></script>
<script>
 window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-130167291-1');
</script>
<?php }
     
     
//*** AntiSpam HonneySpot method ***//   
//add_action( 'register_form', 'registration_form_antispam' );
function registration_form_antispam() { ?>
	<input type="hidden" name="spam" id="spam">
	<script>
      document.forms["registerform"].addEventListener("submit", clearSpamFunction);
      function clearSpamFunction() {
          if ( document.forms["registerform"]["spam"].value.length === 0 ) { console.log('No spam'); }
          else { console.log('Spammer Suka'); document.forms["registerform"].reset();}
      }
	</script>
	<?php
}


************ Disabling auto p , autop, autotag p, remove p ************
//sometimes need to use for complete remove, eliminate p tag, remove p tag
site https://codex.wordpress.org/Function_Reference/wpautop
site https://wpcatalogue.com/how-to-disable-automatic-paragraph-tags-in-wordpress/
remove_filter( 'the_content', 'wpautop' );
remove_filter( 'the_excerpt', 'wpautop' );


// disabling auto p in cf7, remove auto p in cf7, eliminate p tag
// in wp-config.php
define('WPCF7_AUTOP', false );

// in functions.php
add_filter('wpcf7_autop_or_not', '__return_false');

// remove span tag from CF7
add_filter('wpcf7_form_elements', function($content) {
	$content = preg_replace('/<(span).*?class="\s*(?:.*\s)?wpcf7-form-control-wrap(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>/i', '\2', $content);

	return $content;
});



************ Open Graph data, facebook ************
site https://www.wpbeginner.com/wp-themes/how-to-add-facebook-open-graph-meta-data-in-wordpress-themes/
site https://francescocarlucci.com/seo/wordpress-open-graph-meta-without-plugin/

	<meta property="og:title" content="<?= get_the_title(); ?>" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="<?= get_permalink(); ?>" />
	<meta property="og:image" content="<?php
  		// if the post does not have featured image, use a default image
			if(!has_post_thumbnail( $post->ID )){
				echo bloginfo('stylesheet_directory') . "/assets/img/logo_for_social.jpg" ;
			}
				else {
					echo get_the_post_thumbnail_url($post->ID);
						or
					echo get_the_post_thumbnail_url(get_the_ID(), 'large' );
				}
		?>"/>
		
		
	

************ Youtube Embeded with = 100%, youtube video, video embed filter ************
site https://stackoverflow.com/questions/33390885/wordpress-auto-embed-of-youtube-videos-adding-filter-to-handle-end-attribute
site https://developer.wordpress.org/reference/functions/wp_embed_handler_youtube/

add_filter('embed_oembed_html', 'my_theme_embed_handler_oembed_youtube', 10, 4);
function my_theme_embed_handler_oembed_youtube($html, $url, $attr, $post_ID) {
	if (strpos($url, 'youtube.com')!==false) {
		/*  YOU CAN CHANGE RESULT HTML CODE HERE */
		$html = '<div class="content-youtube-wrap">'.$html.'</div>';
	}
	return $html;
}

// this code is for setup general max width for embed
//if ( ! isset( $content_width ) ) $content_width = 300; 



************ include content ************
// Include title with link
<h2 class="entry-title">
	<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
		<?php the_title(); ?>
	</a>
</h2>


************ include favicon, ico ************
site https://codex.wordpress.org/Creating_a_Favicon
<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon.png" />



************ i18n, Internationalization, localization, translation, localization function, include localization, theme translation ************

// https://developer.wordpress.org/themes/functionality/internationalization/	
// https://developer.wordpress.org/apis/handbook/internationalization/

// WordPress i18n guide.
https://codex.wordpress.org/I18n_for_WordPress_Developers
https://developer.wordpress.org/themes/functionality/internationalization/

// good tutorial
https://www.smashingmagazine.com/2011/12/internationalizing-localizing-wordpress-theme/

// video 
https://www.youtube.com/watch?v=fJfqgrzjEis&t=801s

// using wpml
https://wpml.org/documentation/support/translating-the-theme-you-created/

// locale codes
https://i18n.svn.wordpress.org/



// Basic strings, wrapping with GetText() calls
__( 'Blog Options', 'my-theme' ); // Return string in function, Retrieve the translation of $text. Retreve only value without echo
_e( 'WordPress is the best!', 'my-theme' ); // Print string, like echo __( 'Blog Options', 'my-theme' );
esc_html_e( 'Nothing Found!', 'my-theme' ); // Display translated text that has been escaped for safe use in HTML output.


// add localization folder to theme, Adding your theme’s translations
add_action( 'after_setup_theme', 'my_theme_setup' );
function my_theme_setup(){
  load_theme_textdomain( 'wpml_theme', get_template_directory() . '/languages' );
}


// Translation with parameters, translate with values
// transmit value to GetText() function
printf( __('by %s', 'wpml_theme' ), get_the_author() );

// shortcode values example
printf( __('Au mai rămas %s oferte', 'starcard' ), '<strong>' . do_shortcode($shortcode_code) . '</strong>'  );


// Date and number functions 
// time localization
the_time( get_option('date_format') );

// Convert float number to format based on the locale.
number_format_i18n( float $number, int $decimals );

//Retrieve the date in localized format, based on a sum of Unix timestamp and timezone offset in seconds.
date_i18n( string $dateformatstring, int|bool $timestamp_with_offset = false, bool $gmt = false )

// get current language
get_locale() returns the WordPress locale in the format 'en_US'
get_bloginfo('language') returns the locale in the format 'en-US'


// ACF Localization ACF
if ( get_locale() == 'en_GB' ) {
	the_field('contact_administrative_title', 136); // select the field with page ID
} 
	else {echo "Administratia locala";}


// WPML	
// get current language from wpml, get wpml, detect language wpml
https://wpml.org/forums/topic/get-current-language-2/
echo ICL_LANGUAGE_CODE;

<?php if (ICL_LANGUAGE_CODE == 'ro') : ?>
	<p>Stoc epuizat!<br/>lasă-ne datele tale de contact, iar noi vom lua legătura cu tine pentru o alta ofertă</p>
	<?php else: ?>
	<p>Все продано!<br/>Оставь нам свои данные, и мы  предложим тебе новую оферту.</p>
	<?php endif; ?>


************ create shortcode, add shortcode, work shortcode ************
https://codex.wordpress.org/Shortcode_API
https://wp-kama.ru/handbook/codex/shortcodes#create
https://wp-kama.ru/function/add_shortcode
https://kinsta.com/blog/wordpress-shortcodes/

// default values
$atts = shortcode_atts( [
	'category_id' => 0,
	'show_on_home'  => 0,
	'posts_per_page'  => 5,
], $atts );

//[phonenumbertext][/phonenumbertext]
function add_phone_number_text($atts = null, $content = null){
	$phone_num = '(503) 292-1580';
	return $phone_num;
}
add_shortcode('phonenumbertext', 'add_phone_number_text');

//[html_code][/html_code]
function add_html($atts = null, $content = null){
	ob_start();  ?>
	
	html
	
	<?php return ob_get_clean();
}
add_shortcode('html_code', 'add_html');

// View Shortcode
<?php echo do_shortcode('[html_code]'); ?>


// Check if shortcode exists, execute shortcode
shortcode_exists( string $tag );
if ( shortcode_exists( 'shortcode-name' ) ) {
	echo do_shortcode( '[shortcode-name]' ); 
}


// Menu shortcode, show menu with shortcode
function get_menu($args){
	$menu = isset($atts['menu']) ? $atts['menu'] : '';
	ob_start();
	wp_nav_menu(array(
			'menu' => $menu
	) );
	return ob_get_clean();
}
add_shortcode('get_menu', 'get_menu');



// shortcode example for showing custom posts type by ID
/**
 * Team members shortcode
 * [team_members member_post_id="8605"][/team_members]
 */

// 8605,1667,6186 (Id's for /about-cascade-policy-institute/)
function generate_card_member($atts){
	
	if ( is_string($atts['member_post_id']) ){
		$str = $atts['member_post_id'];
		$str = trim($str);
		$str = str_replace(' ', '', $str);
		$user_ids = explode( ",", trim($str) );
	}
	
	ob_start();
	
	// var_dump($user_ids);
	
	$args = array(
    'post_type'   => 'team',
    'post_status' => 'publish',
    'orderby'     => 'post__in',
		'post__in'    => $user_ids
	);
	$the_query = new WP_Query( $args ); ?>
	
	<div class="row">
	
	<?php
	if ( $the_query->have_posts() ) {
        
		while ( $the_query->have_posts() ) : $the_query->the_post();  ?>
		
		<div class="col-md-6 col-lg-4">
				<?php get_template_part( 'template-parts/content', get_post_type() ); ?>
		</div>
		
		<?php
		endwhile;

		} else { ?>
		 <div class="col-12">
				<?php
					// no posts found
					_e('Sorry, no posts found, need to include some post ID in shortcode params.', 'cascade-policy');
				?>
		 </div>
		<?php } ?>
	</div>
	
	<?php

	return ob_get_clean();
}

add_shortcode('team_members', 'generate_card_member');


// custom shortcode btn, shortcode btn, 
/**
 * Custom CAS btn template
 * [cas-btn link="" link-text=""][/cas-btn]
 */
function add_cas_btn($atts = null, $content = null){

	$link = $atts['link'];
	$link_text = $atts['link-text'];

	$link = '<a href="' . $link . '" class="btn btn-success" target="_blank">' . $link_text . '</a>';
	return $link;
}
add_shortcode('cas-btn', 'add_cas_btn');




************ Redirect function ************
function my_login_redirect( $redirect_to, $request, $user ) {
	//is there a user to check?
	if (isset($user->roles) && is_array( $user->roles )) {
		//check for subscribers
		if (in_array( 'free' || 'paid' , $user->roles )) {
				// redirect them to another URL, in this case, the homepage 
				$redirect_to =  admin_url('/edit.php?post_type=laundries');
		}
	}
	return $redirect_to;
}
add_filter( 'login_redirect', 'my_login_redirect', 10, 3 );



************ breadcrumbs ************
// With Plugin Breadcrumb NavXT
https://mtekk.us/code/breadcrumb-navxt/breadcrumb-navxt-doc/#Usingbcn_displayandbcn_display_list
<div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
	<?php bcn_display(); ?>
</div>


************ single post navigation ************

// text cu titlu, optiuni excerpt
<nav class="navigation post-navigation" role="navigation">
<div class="nav-links">

	<?php if ($prev = get_previous_post()) :
		$prev_title = $prev->post_title;
		$prev_ex_con = ($prev->post_excerpt) ? $prev->post_excerpt : strip_shortcodes($prev->post_content);
		$prev_text = wp_trim_words(apply_filters('the_excerpt', $prev_ex_con), 5);
		?>

			<div class="nav-previous">
					<a href="<?php echo esc_url(get_permalink($prev->ID)); ?>">
							<span class="icon">&larr;</span>
							<strong><?php echo $prev_title; ?></strong>
							<br/>
						<?php echo $prev_text; ?>
					</a>
			</div>
	<?php endif;

	if ($next = get_next_post()) :
		$next_title = $next->post_title;
		$next_ex_con = ($next->post_excerpt) ? $next->post_excerpt : strip_shortcodes($next->post_content);
		$next_text = wp_trim_words(apply_filters('the_excerpt', $next_ex_con), 5);
		?>

			<div class="nav-next">
					<a href="<?php echo esc_url(get_permalink($next->ID)); ?>">
							<span class="icon">&rarr;</span>
							<strong><?php echo $next_title; ?></strong>
							<br/>
						<?php echo $next_text; ?>
					</a>
			</div>
	<?php endif; ?>
</div>
</nav>


************ slick slider with posts, posts slider ************
<div class="slickBanner">
<?php if ( $the_query->have_posts()) :
		while ( $the_query->have_posts()) : $the_query->the_post(); ?>
				<a href="<?php the_permalink(); ?>">
						<div class="news_img slick-item">
								<?php if (!empty($additional_thumbnail = get_field('required_main_feat_image'))) : ?>
									<img src="<?php echo esc_url($additional_thumbnail['url']); ?>" alt="<?php echo esc_attr($additional_thumbnail['alt']); ?>" />
								<?php elseif (has_post_thumbnail()) : ?>
										<?= get_the_post_thumbnail( get_the_ID(),'full'); ?>
									<!-- <img src="--><?php // echo get_the_post_thumbnail_url( get_the_ID(),'large'); ?><!--"/>-->
								<?php endif; ?>
								<div class="news_img_comment"><?php the_title(); ?></div>
						</div>
				</a>
<?php endwhile; endif; wp_reset_postdata(); ?>
</div>


// custom header, custom wp head, custom meta name
function custom_facebook_meta_tags() {
    echo '<meta name="facebook-domain-verification" content="ucqvmgd5666zu5s9mokadx2w9xunif" />';
}

add_action('wp_head', 'custom_facebook_meta_tags');


/**
 * func for detect if is login page, detecd login page
 * @return bool
 */
function isLoginPage()
{
	$is_login_page = false;

	$ABSPATH_MY = str_replace(array('\\', '/'), DIRECTORY_SEPARATOR, ABSPATH);

	// Was wp-login.php or wp-register.php included during this execution?
	if (
		in_array($ABSPATH_MY . 'wp-login.php', get_included_files()) ||
		in_array($ABSPATH_MY . 'wp-register.php', get_included_files())
	) {
		$is_login_page = true;
	}

	// $GLOBALS['pagenow'] is equal to "wp-login.php"?
	if (isset($GLOBALS['pagenow']) && $GLOBALS['pagenow'] === 'wp-login.php') {
		$is_login_page = true;
	}

	// $_SERVER['PHP_SELF'] is equal to "/wp-login.php"?
	if ($_SERVER['PHP_SELF'] == '/wp-login.php') {
		$is_login_page = true;
	}

	return $is_login_page;
}

// Last posts to read
// Query Posts
https://rudrastyh.com/wordpress/ajax-post-filters.html 


// Custom Users 
https://daronspence.wordpress.com/2014/09/29/front-facing-user-profile-editing-customization-with-acf/
https://noface.co.uk/user-profiles-advanced-custom-fields
https://www.advancedcustomfields.com/resources/how-to-get-values-from-a-user/


https://kinsta.com/blog/wordpress-user-roles/
https://isabelcastillo.com/assign-custom-post-type-capabilities-roles-wordpress
https://support.advancedcustomfields.com/forums/topic/acf-hide-field-from-roles/
https://3.7designs.co/blog/2014/08/restricting-access-to-custom-post-types-using-roles-in-wordpress/
https://herothemes.com/blog/restricting-access-wordpress-pages-creating-members-area/



************ work rewrite url, rewriteAPI, custom url, rewrite query, rewrite link ************
// about rewrite in general
https://docs.ovh.com/au/en/hosting/htaccess_url_rewriting_using_mod_rewrite/
// good explanation
https://www.smashingmagazine.com/2011/11/introduction-to-url-rewriting/


// fii atent la RegEx
https://wp-kama.ru/function/add_rewrite_rule
https://wordpress.stackexchange.com/questions/26388/how-to-create-custom-url-routes
Important de inteles aici: https://wordpress.stackexchange.com/questions/388741/custom-taxonomies-with-custom-rewrites-slug-and-loading-a-taxonomy-archive-tem

// rewrite for taxonomy
// Good ideea and explanation here
https://react2wp.com/using-same-slug-for-custom-post-type-and-custom-taxonomy/

// the same slug fpr page and taxonomy conflict
https://wordpress.stackexchange.com/questions/4127/custom-taxonomy-and-pages-rewrite-slug-conflict-gives-404?rq=1





************  Feeds, feeds, feed, rss feed ************
// https://wordpress.org/support/article/wordpress-feeds/
// https://kb.wprssaggregator.com/article/219-how-to-create-custom-rss-feeds

// show custom fields in rss
// https://www.lockedownseo.com/add-advanced-custom-field-to-rss-feed-in-wordpress/

// create custom fields
// https://kb.wprssaggregator.com/article/219-how-to-create-custom-rss-feeds


// By default, WordPress comes with various feeds. 
// URL for RDF/RSS 1.0 feed 
<?php bloginfo('rdf_url'); ?>

// URL for RSS 0.92 feed 
<?php bloginfo('rss_url'); ?>

// URL for RSS 2.0 feed 
<?php bloginfo('rss2_url'); ?>

// URL for Atom feed 
<?php bloginfo('atom_url'); ?>

// URL for comments RSS 2.0 feed 
<?php bloginfo('comments_rss2_url'); ?>


// Finding Your Feed URL
// https://perishablepress.com/what-is-my-wordpress-feed-url/
RSS 2.0 format	http://example.com/feed/
RSS 2.0 format	http://example.com/feed/rss2/
RSS 0.92 format	http://example.com/feed/rss/
RDF/RSS 1.0 format	http://example.com/feed/rdf/
Atom format	http://example.com/feed/atom/		

http://example.com/?feed=rss
http://example.com/?feed=rss2
http://example.com/?feed=rdf
http://example.com/?feed=atom

// Using custom permalinks
http://example.com/feed/
http://example.com/feed/rss/
http://example.com/feed/rss2/
http://example.com/feed/rdf/
http://example.com/feed/atom/

// comment feed
http://example.com/comments/feed/
http://example.com/?feed=comments-rss2 // Default format

// Post-specific 
http://example.com/post-name/feed/

// Categories and Tags
http://www.example.com/?cat=42&feed=rss2
http://www.example.com/?tag=tagname&feed=rss2
http://www.example.com/category/categoryname/feed
http://www.example.com/tag/tagname/feed


// Adding Feeds
<ul class="feeds">
    <li>
		<a href="<?php bloginfo('rss2_url'); ?>" title="<?php _e('Syndicate this site using RSS'); ?>">
			<?php _e('<abbr title="Really Simple Syndication">RSS</abbr>'); ?>
		</a>
	</li>
    <li>
		<a href="<?php bloginfo('atom_url'); ?>" title="<?php _e('Syndicate this site using Atom'); ?>">
			<?php _e('Atom'); ?>
		</a>
	</li>
    <li>
		<a href="<?php bloginfo('comments_rss2_url'); ?>" title="<?php _e('The latest comments to all posts in RSS'); ?>">
			<?php _e('Comments <abbr title="Really Simple Syndication">RSS</abbr>'); ?>
		/a>
	</li>
</ul>


// Feed templates
feed-rss2.php // Displays your entries in RSS 2.0 format.
feed-rss.php  // Displays your entries in RSS 0.92 format.
feed-rdf.php  // Displays your entries in RDF/RSS 1.0 format.
feed-atom.php // Displays your entries in Atom format.
feed-atom-comments.php // Displays comments - either the most recent comments on all posts, or the comments on a specific post - in Atom format.
feed-rss2-comments.php // Displays comments - either the most recent comments on all posts, or the comments on a specific post - in RSS 2.0 format.



// if wan to add new custom feed name
// include in functions.php
/**
 * Deal with the custom RSS templates.
 */
add_action('init', 'customRSSView');
function customRSS() {
   add_feed('feedname', 'customRSSFunc');  // custom name is 'feedname'
}
function customRSSView() {
    get_template_part( 'feed', 'rss2' ); // include feed-rss2.php 
}


// Add a Custom templates
/**
 * Deal with the custom RSS templates.
 */
function my_custom_rss() {
	// if ( 'photos' === get_query_var( 'post_type' ) ) { // nu lucreaza cu get_query_var 
	// 	get_template_part( 'feed', 'photos' );
	// } else {
	// 	get_template_part( 'feed', 'rss2' );
	// }

	// 
	if (is_tax( 'job_sectors' ) || is_tax( 'jobs' ) || is_post_type_archive( 'employees')) {
		get_template_part( 'custom', 'rss2' );
	} else {
		get_template_part( 'feed', 'rss2' );
	}
}
remove_all_actions( 'do_feed_rss2' );
add_action( 'do_feed_rss2', 'my_custom_rss', 10, 1 );



/**
 * Multisites.
 */
// get blog id
get_current_blog_id()



************ Display Custom Error Messages, work error, work admin notice, work notice, Add Custom Admin Notices, post edit notices ************
https://developer.wordpress.org/reference/hooks/admin_notices/
https://wpengine.com/resources/how-to-add-custom-admin-notices/

// example
https://www.wp-tweaks.com/display-custom-error-messages-in-wordpress-admin/


// This is a custom class allowing WordPress theme authors to add admin notices to the WordPress dashboard.
https://github.com/WPTT/admin-notices

// How to customize post edit notices
https://wordpress.stackexchange.com/questions/268379/how-to-customize-post-edit-notices


// CSS classes, need to use with the 'notice' class
* notice-error 		– will display the message with a white background and a red left border.
* notice-warning	– will display the message with a white background and a yellow/orange left border.
* notice-success 	– will display the message with a white background and a green left border.
* notice-info 		– will display the message with a white background a blue left border.