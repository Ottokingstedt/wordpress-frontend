<?php
/**
 * The template for displaying 404 pages (not found)
 */

get_header(); ?>

	<div id="primary">
		
        <section class="copySec sec">
			<div class="notfoundpage">
			Oops! We couldn't find that page
			<br>
			<a href="<?php echo home_url()?>"> &nbsp; &nbsp; &rarr; Back to homepage</a>
			</div>
		</section>
        
	</div><!-- #primary -->

<?php get_footer(); ?>