# WHY WOULD YOU CONVERT HTML INTO A WORDPRESS THEME?
1. MANUAL CONVERSION OF HTML TO WORDPRESS
Because it is the most technical option on our list, manual conversion is not recommended for everyone.

Manual conversion uses your current site’s HTML code as a starting point. If you’re going to attempt this conversion method, it is recommended that you have some coding experience. Specifically, you should know HTML and CSS, as well as PHP.

Luckily, most of this process involves copy and paste, but it’s still complicated.

Here is a step-by-step guide to manual HTML/WordPress conversion:

# Step 1: Create a New Theme Folder
The first thing that you’ll need to do is create a new theme folder on your desktop. Think of it as a directory folder on your computer. It serves the same purpose.

Now, go to the code editor and create text files. There are five different files you’ll want to create:

<br> Style.css
<br> Index.php
<br> Header.php
<br> Sidebar.php
<br> Footer.php

# Step 2: Copy CSS Code
Next, you’ll have to copy the CSS coding from your old website onto a WordPress Style Sheet.

To do that, you’ll have to prepare the WordPress style sheet, which is the style.css file you created in the last step.

Copy and paste the CSS code from the old site’s source into that style sheet.

Then it’s time to fill out the various parts of the style sheet header for your new WordPress theme.

They are:

Theme Name – This can be anything you want.
Theme URL – The homepage information or site address.
Author – Your name.
Author URL – Link to the homepage you’re building.
Description – This part is an optional write-up on the theme that shows within the WordPress backend.
Version – Start with 1.0.
License, License URL, Tags – This part is only necessary if you’re going to submit the theme into the WordPress directory for others to use. If you’re keeping it for yourself, then don’t worry about it.

# Here’s what that style sheet might look like:
<br>/*
<br>Theme Name: Flatsome Child
<br>Description: This is a child theme for Flatsome Theme
<br>Author: UX Themes
<br>Template: flatsome
<br>Version: 3.0
<br>*/

Once you’re done with the header, paste the CSS code from the static HTML site into your file. Save the file in your theme folder and close it.

# Step 3: Separate Existing HTML
WordPress uses PHP to access database information. As a result, your existing HTML code has to be chopped into separate pieces so that the WordPress CMS can properly string them together.

<br>To do this, you’ll have to copy parts of the original HTML document into several different PHP files.

<br> First, open your index.html file.

# Go through the WordPress files that were created and copy that code into the following areas:

Header.php – This entails everything from the beginning of your HTML code up to the main content area. Right before the section marked </head> you’ll have to copy and paste 
<br><?php wp_head();?>
<br>Sidebar.php – This is where you put all the code from the section marked <aside>
<br>Footer.php – This section starts at the end of the sidebar and goes up to the end of the file. Add a call for <?php wp_footer();?> before closing off the bracket with <br> <br></body>.
Once you’ve done that, close the index.html file and save your other data to the theme folder.

Close all of the files except for header.php and index.php.

# Step 4: Change the Header.php and Index.php Files for WordPress
<br>Next, you’ll be changing the header.php and index.php to fit into WordPress’s format.

# To do this, look for a link in the <head> section that looks like this:
 <br> <link rel=”stylesheet” href=”style.css”>
  
# Replace that link with this:

<br> <link rel=”stylesheet” href=”<?php echo get_template_directory_uri(); ?>/style.css” type=”text/css” media=”all” />

Now, save and close the header.php file. You’re done with it for the moment.

Open your index.php file. It should be empty.

# Enter the following, precisely like this:
<br> <?php get_header(); ?>

<br> <?php get_sidebar(); ?>

<br> <?php get_footer(); ?>


# The loop starts here:

<br> <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>


# and ends here

<br> <?php endwhile; else : ?>

<br> <p> <?php esc_html_e( 'sorry, no posts matched your criteria.' ); ?> </p>

<br> <?php endif; ?>

# Step 5: Screenshot and Upload

The last thing you’ll need to do is create a screenshot of your theme and upload it.

The screenshot will show a preview of your site in the WordPress backend.

Take this screenshot and crop it to 880×660 pixels. Save the file as a screenshot.png.

Now, add the screenshot to your theme folder.

# It’s time to upload the theme to WordPress. Take the following five steps:

Create a zip file.
Go to WordPress.
Select Appearance, Themes, and click Add New at the top.
Click Upload Theme.
Upload your zip file and click Install Now.
Once that’s done, you can activate the theme!

# 2. CONVERTING HTML THROUGH A WORDPRESS CHILD THEME
Using a WordPress child theme to turn your original HTML into a CMS format gives you a lot more freedom and doesn’t require nearly the amount of technical know-how as the previous method.

It’s also the easiest and cheapest option for converting HTML to WordPress.

To do this, you’re going to use a ready-made theme as a jumping-on point instead of modeling it off your existing site.

It is possible to adjust the design of your WordPress parent theme so that it resembles the old site as much as possible.

That means you’ll be able to use WordPress while retaining the look and feel of the original site. There is no need to add WordPress features after because you’re building the new website on an existing theme.

Child themes are built on top of another theme, which is called the parent. The child theme modifies the parent theme in a way that fits your specific site.

Here is a step-by-step guide to converting your static HTML site into WordPress using a child theme.

# Step 1: Choose a Theme

Before you can get started, you need to pick a theme. Try to find one that you like, but also resembles your existing design.

Install the theme on your WordPress site like you would any other theme. Just don’t activate it yet.

# Step 2: Create a New Theme Folder
You’re going to create a new folder on your desktop, much like you did in the previous method.

Name the folder the same as the parent theme and add “-child” to the end of it. Remember, there should be no spaces in the name.

# Step 3: Create a Style Sheet
This step is identical to the style sheet creation we went through in the previous method.

However, this time, you’re going to add a tag titled “template.” Make sure that you include the name of your parent theme. That is needed for the child theme to work.

# Step 4: Create a Functions.php
Next, you’ll create a functions.php and inherit the parent styles for the child theme.

To do this, create a new file and call it functions.php. Make sure you start it off with<br> <?php.

<br> Now, input the following code:

<br> function child_theme_enqueue_styles() {

 <br> $parent_style = ‘parent-style’;

<br> wp_enqueue_style( $parent_style, get_template_directory_uri() . ‘/style.css’ );

<br> wp_enqueue_style( ‘child-style’,

<br> get_stylesheet_directory_uri() . ‘/style.css’,

<br> array( $parent_style ),

<br> wp_get_theme()->get(‘Version’)

<br> );

<br> }

<br>add_action( ‘wp_enqueue_scripts’, ‘child_theme_enqueue_styles’ );


This code lets WordPress know to go to the parent theme and use the styles that are listed there for the child theme.

# Step 5: Activate the Child Theme
You can now activate the child theme.

Before that, though, make sure that you take a screenshot to be featured on the WordPress backend.

Create a zip file with everything and add it all into WordPress, as we did in the previous method.

You’ll then be able to change the design to match your original HTML.

# 3. IMPORT YOUR CONTENT FROM HTML INTO WORDPRESS USING A PLUGIN
This tactic is only recommended if you’re open to changing your site’s design. If you want an all-new look, using WordPress plugins can be a much easier road to travel.

# Here is a step-by-step guide on how you can import your content from HTML into WordPress using plugins.

# Step 1: Set Up a New Site
# Start up your new site and install the WordPress theme of your choice. Make sure it’s a template that you like and is easily edited. You will need to change the appearance to match your branding.

# Step 2: Install the Plugin
Now, it’s time to install the plugin that makes this possible. You’re going to search for a WordPress Plugin called HTML Import 2 and install it on your site.
plugin link: https://wordpress.org/plugins/import-html-pages/ 

# Step 3: Upload Pages
Once the plugin is up and running, upload your pages to the same server as your WordPress installation.

# Under the Files tab, you’ll enter the following information:

Directory to Import – This is the pathway you copied your existing HTML code to
Old site URL – The old URL is mostly there for redirect purposes. Enter the old URL of the site.
Default File – Enter your index.html.
File extensions to include – Put in the extensions of the files that will be imported.
Directories to exclude – Exclude anything from the old site that you don’t want to be carried over.
Preserve file names – The plugin will automatically use your file names as the new URL.
Once that’s done, go under the content tab and configure the HTML tag that holds your site’s content.

# There are several tabs that you’ll have to familiarize yourself with:
# IN CONCLUSION
If you have a static HTML site, it’s a good idea to switch over to a more effective content management system with proven functionality, like the WordPress platform.

Thanks to WordPress templates and the easy-to-use WordPress Dashboard, HTML to WordPress conversion will make your website easier to manage and a whole lot cheaper to maintain.

Under the Title and Metadata tab, you’ll let the plugin know how your titles are marked in the HTML template.
The Custom Fields tab is where you put data that needs to be imported into custom fields.
On the Categories and Tags tab, you’ll assign categories to your imported content.
The tools screen is where you can go over some of the built-in tools found in the extension.
Once you’ve gone through every tab, save your settings, and click Import Files.
