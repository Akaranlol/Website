			<article id="post-<?php the_ID(); ?>" <?php post_class('post-holder'); ?>>
			
					<header class="entry-header">
			
					<?php if(is_singular()) : ?>
					
					<h1 class="entry-title"><?php the_title(); ?></h1>
					
					<?php endif; ?>
					
					<?php get_template_part('includes/post-formats/post-meta'); ?>
					
					<?php $post_meta = of_get_option('post_meta'); ?>
					<?php if ($post_meta=='true' || $post_meta=='') { ?>
						<time datetime="<?php the_time('Y-m-d\TH:i'); ?>"><?php the_time('j M, Y'); ?></time>
					<?php } ?>
					
					</header>
					
					<?php $quote =  get_post_meta(get_the_ID(), 'tz_quote', true); ?>
								
					<div class="quote-wrap clearfix">
							
							<blockquote>
									<?php echo $quote; ?>
							</blockquote>
							
					</div>
			
					<div class="post-content">
							<?php the_content(''); ?>
					<!--// .post-content -->
					</div>
					
					<?php get_template_part('includes/post-meta'); ?>
			
			<!--//.post-holder-->  
			</article>