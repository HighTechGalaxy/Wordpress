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
