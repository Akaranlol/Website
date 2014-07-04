<?php
/**
 * Template Name: Home Page
 */

get_header(); ?>
<div class="extra-box clearfix">
  <div class="container_12">
    <div class="grid_8">
	    <div class="bottom-indent">
	      <?php if ( ! dynamic_sidebar( 'Home Content Area' ) ) : ?>
	    <!-- Wigitized Content -->
	  <?php endif; ?>
	    </div>
    </div>
    <div class="grid_4">
	  <div class="extra-indent">
	      <?php if ( ! dynamic_sidebar( 'Home Sidebar' ) ) : ?>
	    <!-- Wigitized Content -->
	  <?php endif; ?>
	  </div>
    </div>	
  </div>
</div>
<?php get_footer(); ?>