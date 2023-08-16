<?php
/**
 * Template name: Landing
 */

get_header();
?>
<!-- Scroll down -->
<a href="#About" style="scroll-behavior: auto" onclick="scrollToTop();return false" id="navbardown">
    <div id="mouse-scroll" class="mouse-container">
        <div class="mouse">
            <div class="mouse-in"></div>
        </div>
        <div>
            <span class="down-arrow-1"></span>
            <span class="down-arrow-2"></span>
            <span class="down-arrow-3"></span>
        </div>
    </div>
</a>
<!-- Scroll up -->
<a class="scrollToTopBtn">
    <?php get_template_part('template-parts/content', 'arrow'); ?>
</a>

<main id="page">
    <article id="demo">
        <div class="landing" style="display:none;"></div>
        <div class="accordion">
            <div class="accordion-section">
                <div id="About" class="accordion-section-content">
                    <section class="scroll-container">
                        <div class="scroll-element js-scroll fade-in">
                            <h1>About</h1>
                            <div class="cont_ab" id="demo">
                                <div class="container-content">
                                    <div class="video-container">
                                        <div class="video">
                                            <?php if (get_field('img_1')): ?>
                                                <img src="<?php the_field('img_1'); ?>">
                                            <?php endif; ?>
                                        </div>
                                        <div class="popup-video">
                                            <span onclick="">&times;</span>
                                            <?php if (get_field('video')): ?>
                                                <video id='vid' controls
                                                   src="<?php the_field('video'); ?>" type="video/mp4">
                                                </video>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="copy_ab" id="scroll-caption">
                                    <?php the_field('copy'); ?>
                                </div>
                            </div>
                            <div class="cont_bc">
                                <div class="container-content">
                                    <div class="video-container">
                                        <div class="video">
                                            <?php if (get_field('img_2')): ?>
                                                <img src="<?php the_field('img_2'); ?>">
                                            <?php endif; ?>
                                        </div>
                                        <div class="popup-video">
                                            <span onclick="">&times;</span>
                                            <?php if (get_field('video_2')): ?>
                                                <video id="vid" controls>
                                                    <source src="<?php the_field('video_2'); ?>">
                                                </video>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="copy_abc">
                                    <?php the_field('copy_signing_space'); ?>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div id="Team" class="accordion-section-content">
                    <div class="scroll-element js-scroll fade-in">
                        <h1 id="sectionId">Team</h1>
                        <?php the_content(); ?>
                        <div class="cont" id="demo">
                            <div class="copy" id="demo">
                                <?php the_field('team_copy'); ?>
                            </div>
                            <?php
                            $my_query = new WP_Query(
                                array(
                                    'posts_per_page' => -1,
                                    'orderby' => 'date',
                                    'order' => 'DESC',
                                    'category_name' => 'team-member'
                                )
                            );
                            ?>
                            <?php if ($my_query->have_posts()) : ?>
                                <div id="teamCont">
                                    <?php while ($my_query->have_posts()) : $my_query->the_post(); get_template_part('template-parts/content', 'teamMember');
                                    endwhile; ?>
                                </div>
                            <?php wp_reset_postdata();
                            endif; ?>
                        </div>
                    </div>
                </div>
                <div id="Service" href="#Service" class="accordion-section-content">
                    <div class="scroll-element js-scroll fade-in">
                        <h1 id="down">Services</h1>
                        <div class="cont">
                            <?php if (have_rows('services')) :
                                echo '<ul>';
                                while (have_rows('services')) : the_row(); ?>
                                    <li>
                                        <div class="heading">
                                            <?php the_sub_field('heading');
                                            get_template_part('template-parts/content', 'cross'); ?>
                                        </div>
                                        <div class="container" style="display: none;">
                                            <div class="container-content">
                                                <div class="video-container">
                                                    <div class="video">
                                                        <img src="<?php the_sub_field('video'); ?>">
                                                    </div>
                                                    <div class="popup-video">
                                                        <span onclick="">&times;</span>
                                                        <?php if (get_sub_field('video_service_1')) : ?>
                                                            <video 
                                                            id='vid' controls src="<?php the_sub_field('video_service_1') ?>" type="video/mp4">
                                                            </video>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <?php the_sub_field('copy'); ?>
                                            </div>
                                        </div>
                                    </li>
                                <?php endwhile;
                                echo '</ul>';
                            endif; ?>
                        </div>
                        <br>
                        <div id="Service" class="accordion-section-content">
                            <div class="cont">
                                <?php if (have_rows('insight')) :
                                    echo '<ul>';
                                    while (have_rows('insight')) : the_row(); ?>
                                        <li>
                                            <div class="heading">
                                                <?php the_sub_field('heading');
                                                get_template_part('template-parts/content', 'cross'); ?>
                                            </div>
                                            <div class="container" style=" display: none; grid-template-columns: 0!important">
                                                <?php the_sub_field('copy'); ?>
                                            </div>
                                        </li>
                                    <?php endwhile;
                                    echo '</ul>';
                                endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
</main>
<div id="popCont">

</div>

<?php get_footer(); ?>

