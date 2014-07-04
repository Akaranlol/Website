  </div><!--.container-->
</div>  
	<footer id="footer">
		<div class="container_12 clearfix">
			<div id="copyright" class="clearfix">
				<div class="grid_12">
					<div id="back-top-wrapper">
						<p id="back-top">
						<a href="#top"><span></span></a>
					      </p>
					    </div>		
					<div id="footer-text">
						<?php $myfooter_text = of_get_option('footer_text'); ?>
						
						<?php if($myfooter_text){?>
							<?php echo of_get_option('footer_text'); ?>
						<?php } else { ?>
							<a href="<?php bloginfo('url'); ?>/" title="<?php bloginfo('description'); ?>" class="site-name"><?php bloginfo('name'); ?></a> <?php _e('is proudly powered by', 'theme1885'); ?> <a href="http://wordpress.org">WordPress</a> <a href="<?php if ( of_get_option('feed_url') != '' ) { echo of_get_option('feed_url'); } else bloginfo('rss2_url'); ?>" rel="nofollow" title="<?php _e('Entries (RSS)', 'theme1885'); ?>"><?php _e('Entries (RSS)', 'theme1885'); ?></a> and <a href="<?php bloginfo('comments_rss2_url'); ?>" rel="nofollow"><?php _e('Comments (RSS)', 'theme1885'); ?></a>							
						<?php } ?>
						<br />
						<?php if( is_front_page() ) { ?>
						<!-- {%FOOTER_LINK} -->
						<?php } ?>
					</div>
					
				</div>
			</div>
		</div><!--.container-->
	</footer>
</div><!--#main-->
<?php wp_footer(); ?> <!-- this is used by many Wordpress features and for plugins to work properly -->
<?php if(of_get_option('ga_code')) { ?>
	<script type="text/javascript">
		<?php echo stripslashes(of_get_option('ga_code')); ?>
	</script>
  <!-- Show Google Analytics -->	
<?php } ?>
</body>
</html>