1. Create a child theme folder #

2. Create a stylesheet: style.css #
Next, you’ll need to create a stylesheet file named style.css, 
which will contain all of the CSS rules and declarations that control the look of your theme.
Your stylesheet must contain the below required header comment at the very top of the file.
This tells WordPress basic info about the theme, including the fact that it is a child theme with a particular parent.

/*
 Theme Name:   Twenty Fifteen Child
 Theme URI:    http://example.com/twenty-fifteen-child/
 Description:  Twenty Fifteen Child Theme
 Author:       John Doe
 Author URI:   http://example.com
 Template:     twentyfifteen
 Version:      1.0.0
 License:      GNU General Public License v2 or later
 License URI:  http://www.gnu.org/licenses/gpl-2.0.html
 Tags:         light, dark, two-columns, right-sidebar, responsive-layout, accessibility-ready
 Text Domain:  twentyfifteenchild
*/

3. Enqueue stylesheet #
If you do not have one, create a functions.php in your child theme’s directory.
The first line of your child theme’s functions.php will be an opening PHP tag (<?php), 
after which you can write the PHP code according to what your parent theme does.


add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
    wp_enqueue_style( 'child-style', get_stylesheet_uri(),
        array( 'parenthandle' ), 
        wp_get_theme()->get('Version') // this only works if you have Version in the style header
    );
}


If the parent theme loads its style using a function starting with get_stylesheet, 
such as get_stylesheet_directory() and get_stylesheet_directory_uri(),
the child theme needs to load both parent and child stylesheets.
Be sure to use the same handle name as the parent does for the parent styles.

add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
    $parenthandle = 'parent-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.
    $theme = wp_get_theme();
    wp_enqueue_style( $parenthandle, get_template_directory_uri() . '/style.css', 
        array(),  // if the parent theme code has a dependency, copy it to here
        $theme->parent()->get('Version')
    );
    wp_enqueue_style( 'child-style', get_stylesheet_uri(),
        array( $parenthandle ),
        $theme->get('Version') // this only works if you have Version in the style header
    );
}


4. Install child theme #
Install the child theme as you install any other theme.
You can copy the folder to the site using FTP, 
or create a zip file of the child theme folder,
choosing the option to maintain folder structure,
and click on Appearance > Themes > Add New to upload the zip file.


5. Activate child theme #
You may need to re-save your menu from 
Appearance > Menus and theme options (including background and header images) 
after activating the child theme.

Using functions.php #

