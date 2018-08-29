  </div><!-- /container /grid -->
  <footer>
    <p>&copy;<span class="copy-date"><?php $year = date( "Y", time() ); echo date('Y'); ?></span><span class="copy-name"><a href="<?php echo home_url('/'); ?>">小西&emsp;高幸</a></span></p>
  </footer>
<?php wp_footer(); if (is_singular()) wp_enqueue_script("comment-reply"); ?>
</body>
</html>