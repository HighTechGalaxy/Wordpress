<script>
document.addEventListener( 'wpcf7mailsent', function( event ) {
  location = 'http://example.com/';
}, false );
</script>

 or


<script>
document.addEventListener( 'wpcf7mailsent', function( event ) {
    location = "<?php echo get_bloginfo('url'); ?>/thank-you";
}, false );
</script>



#Here is an example of the code for two different pages.


<?php
 
//This function prints the JavaScript to the footer
function cf7_footer_script(){ 
 
//if page name is contact.
if ( is_page('contact')) {?>
  
    <script>
    document.addEventListener( 'wpcf7mailsent', function( event ) {
            location = 'http://example.com/thank-you';
        }, false );
    </script>
 
<?php } else if ( is_page('download')) /* if page name is download */ {?>
  
    <script>
    document.addEventListener( 'wpcf7mailsent', function( event ) {
            location = 'http://example.com/thank-you';
        }, false );
    </script>
  
<?php } 
     
}
