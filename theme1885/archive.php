<?php get_header(); ?>
<div class="extra-box clearfix <?php echo of_get_option('blog_sidebar_pos') ?>">
  <div class="container_12 clearfix">
    <div id="content" class="grid_8 <?php echo of_get_option('blog_sidebar_pos') ?>">
  <div class="header-title"><h1><?php if ( is_day() ) : /* if the daily archive is loaded */ ?><?php printf( __( 'Daily Archives: %s' ), get_the_date() ); ?><?php elseif ( is_month() ) : /* if the montly archive is loaded */ ?><?php printf( __( 'Monthly Archives: %s' ), get_the_date('F Y') ); ?><?php elseif ( is_year() ) : /* if the yearly archive is loaded */ ?><?php printf( __( 'Yearly Archives: %s' ), get_the_date('Y') ); ?><?php else : /* if anything else is loaded, ex. if the tags or categories template is missing this page will load */ ?><?php _e('Blog Archives', 'theme1885'); ?><?php endif; ?></h1></div>
<div class="posts-wrap">
  <?php 
                
		if (have_posts()) : while (have_posts()) : the_post(); 
		
				// The following determines what the post format is and shows the correct file accordingly
				$format = get_post_format();
				get_template_part( 'includes/post-formats/'.$format );
				
				if($format == '')
				get_template_part( 'includes/post-formats/standard' );
				
		 endwhile; else:
		 
		 ?>
		 
		 <div class="no-results">
			<?php echo '<p><strong>' . __('There has been an error.', 'theme1885') . '</strong></p>'; ?>
			<p><?php _e('We apologize for any inconvenience, please', 'theme1885'); ?> <a href="<?php bloginfo('url'); ?>/" title="<?php bloginfo('description'); ?>"><?php _e('return to the home page', 'theme1885'); ?></a> <?php _e('or use the search form below.', 'theme1885'); ?></p>
			<?php get_search_form(); /* outputs the default Wordpress search form */ ?>
		</div><!--no-results-->
		
	<?php endif; ?>
    </div>
  <?php get_template_part('includes/post-formats/post-nav'); ?>
  
</div><!--#content-->
<?php get_sidebar(); ?>
  </div>
</div>
<?php get_footer(); ?>