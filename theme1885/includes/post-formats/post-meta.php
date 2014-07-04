    <?php $post_meta = of_get_option('post_meta'); ?>
		<?php if ($post_meta=='true' || $post_meta=='') { ?>
			<div class="post-meta">
				<?php _e('By', 'theme1885'); ?> <?php the_author_posts_link() ?><?php comments_popup_link('No comments', '1 comment', '% comments', 'comments-link', 'Comments are closed'); ?>
			</div><!--.post-meta-->
		<?php } ?>		
