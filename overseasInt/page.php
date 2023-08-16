<?php
/**
 * The default template for displaying pages
 */

get_header();
?>

<div id="primary">

    <?php while (have_posts()) : the_post(); ?>

        <section class="copySec sec">
            <div class="copy">
                <?php the_content(); ?>
            </div>
        </section>

    <?php endwhile; ?>

</div><!-- #primary -->

<?php get_footer(); ?>
