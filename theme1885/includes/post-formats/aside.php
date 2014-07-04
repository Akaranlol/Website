       
        <!--BEGIN .hentry -->
        <article id="post-<?php the_ID(); ?>" <?php post_class('post-holder'); ?>>
				
						<header class="entry-header">
						
						<?php get_template_part('includes/post-formats/post-meta'); ?>
						
						<?php $post_meta = of_get_option('post_meta'); ?>
					<?php if ($post_meta=='true' || $post_meta=='') { ?>
						<time datetime="<?php the_time('Y-m-d\TH:i'); ?>"><?php the_time('j M, Y'); ?></time>
					<?php } ?>
						
						</header>
				
            <!--BEGIN .entry-content -->
            <div class="entry-content">
                <?php the_content('<span>Continue Reading</span>'); ?>
            <!--END .entry-content -->
            </div>
        
        <!--END .hentry-->  
        </article>