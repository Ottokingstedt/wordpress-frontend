<?php
/**
 * The template for displaying the footer
 */
?>

	</div><!--#content -->
<article id="demo">
	<footer id="footer">
        <div class="contact" id="contact">
            <?php the_field('contact') ?>
            <?php the_field("contact_2") ?>
            <?php the_field ("social_media")?>
        </div>
        <div class="logo_footer">
                <div id='logo'>
        <?php get_template_part('template-parts/content', 'logo') ?>
                </div>
                <div class="ease">Copyright ©
		<a class="copyright" href="" target="_blank"> Overseas Interpreting</a>
        </div>
        </div>
        <div class="des">Web development by&nbsp; <a href="">Otto Kingstedt</a>&nbsp; | Content creator by&nbsp;<a href="">Fuming Ni</a></div>
    </footer><!-- footer -->
    <div class="inner-cursor"></div>
<div class="outer-cursor"></div>
</article>
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
