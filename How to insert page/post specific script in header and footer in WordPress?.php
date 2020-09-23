You can Do it via Slug of post or page or id of post/page using...

1. is_single() for post

2. is_page() for page

you can add or functions also if you want to add that code in multiple pages but specific pages only. here is code...

if (is_page('home') || is_page('contact') || is_page('45')

Example 1....

 <?php if (is_page('home')): ?>
    <!--home page add custom JS-->
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/Scripts/customJS.js"></script>
    <?php endif; ?>
Example 2...

<?php if (is_page(346) ):?>
    <!-- Google Analytics Content Experiment code here -->
        ...
    <!-- End of Google Analytics Content Experiment code here -->
<?php endif; ?>
