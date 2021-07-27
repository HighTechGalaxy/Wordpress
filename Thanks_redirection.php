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



#Here is an example of the code for two different pages USING FOR ID.


add_action( 'wp_footer', 'redirect_cf7' );
function redirect_cf7() {
?>
<script type="text/javascript">
document.addEventListener( 'wpcf7mailsent', function( event ) {
   if ( '101' == event.detail.contactFormId ) { //if the form if equals #101
      location = 'https://www.example.com/thanks1/';
    } else if ( '365' == event.detail.contactFormId ) { //if the form if equals #365
      location = 'https://www.example.com/thanks2/';
    } else if ( '987' == event.detail.contactFormId ) { //if the form if equals #987
      location = 'https://www.example.com/thanks3/';
    } else { // Default thank you page for all forms which are not 101, 365 or 987
      location = 'https://www.example.com/thanks-main/';
    }
}, false );
</script>
<?php
}
