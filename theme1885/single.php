<?php get_header(); ?>

<div class="extra-box clearfix <?php echo of_get_option('blog_sidebar_pos') ?>">
	<div class="container_12 clearfix">
		<div id="content" class="grid_8 <?php echo of_get_option('blog_sidebar_pos') ?>">
	
	<div class="header-title">
		<?php $blog_text = of_get_option('blog_text'); ?>
		<?php if($blog_text){?>
      <h1><?php echo of_get_option('blog_text'); ?></h1>
    <?php } else { ?>
      <h1><?php _e('Blog','theme1885');?></h1>
    <?php } ?>
	</div>
	
	<div class="posts-wrap">
	<?php 
	
		if (have_posts()) : while (have_posts()) : the_post(); 
		
				// The following determines what the post format is and shows the correct file accordingly
				$format = get_post_format();
				get_template_part( 'includes/post-formats/'.$format );
				
				if($format == '')
				get_template_part( 'includes/post-formats/standard' ); ?>
				
				
	<?php get_template_part( 'includes/post-formats/related-posts' ); ?>

				

	<?php comments_template('', true); ?>
	
	
	<?php endwhile; endif; ?>
	
	</div>

</div><!--#content-->
<?php get_sidebar(); ?>
	</div>
</div>

<?php get_footer(); ?>