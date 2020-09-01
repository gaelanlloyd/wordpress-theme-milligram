<?php get_header(); ?>

<div class="row">
	<div class="column">

<?php // --- START THE LOOP ---

	if ( have_posts() ) : while ( have_posts() ) : the_post();

		if ( has_post_thumbnail() ) { gmfw_write_featured_image(); }

		?><h1><?php echo the_title(); ?></h1><?php

		the_content();

	endwhile; else : ?>

		<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>

	<?php endif;

// --- END THE LOOP --- ?>

	</div>
</div>

<?php get_footer();
