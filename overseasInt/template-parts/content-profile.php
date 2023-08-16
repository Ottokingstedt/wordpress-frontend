<?php
/**
 * Team & Partnerships
 */
?>
<div class="team-part">
    <h1><?php the_title(); ?></h1>

    <?php if (in_category('partnership')) { ?>

        <?php if (get_field('content_type') == "copy") { ?>
            <div class="content_block copy_block">
                <div class="copy">
                    <?php the_sub_field('copy'); ?>
                </div>
                <?php if (get_field('partnership_logo')): ?>
                    <div class="logo">
                        <img src="<?php the_field('partnership_logo'); ?>" alt="<?php the_title(); ?>">
                    </div>
                <?php endif; ?>
                <?php if (get_field('video')): ?>
                    <video controls>
                        <source src="<?php the_field('video'); ?>" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                <?php endif; ?>
                <div class="copy">
                    <?php the_field('copy'); ?>
                </div>
                <?php
                $link = get_field('website_link');
                if ($link):
                    $link_url = $link['url'];
                    $link_title = $link['title'];
                    $link_target = $link['target'] ? $link['target'] : '_self';
                    ?>
                    <a href="<?php echo esc_url($link_url); ?>"
                       target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
                <?php endif; ?>
            </div>
        <?php } ?>

        <?php if (have_rows('facts')):
            echo '<div class="content_block facts_block">'; ?>
            <div class="intro copy">
                <?php the_content(); ?>
            </div>
            <?php $num = 1;
            while (have_rows('facts')) : the_row(); ?>

                <div class="fact">

                    <?php if (get_sub_field('fact_chart')): ?>
                        <div class="fact_chart">
                            <img src="<?php the_sub_field('fact_chart'); ?>" alt="<?php the_title(); ?>">
                        </div>
                    <?php endif; ?>

                    <div class="title">
                        <?php echo $num; ?><br><?php the_sub_field('title'); ?>
                    </div>
                    <div class="copy">
                        <?php the_sub_field('copy'); ?>
                    </div>


                </div>

                <?php $num++; endwhile;
            echo '</div>';
        else : endif; ?>

        <?php if (have_rows('testimonials')):
            echo '<div class="content_block testimonial_block">';
            while (have_rows('testimonials')) : the_row(); ?>

                <div class="testimonial">
                    <div class="details">
                        <?php the_sub_field('testimonial_details'); ?>
                    </div>

                    <?php if (get_sub_field('video')): ?>
                        <div class="vidCont">
                            <video controls>
                                <source src="<?php the_sub_field('video'); ?>" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                    <?php endif; ?>

                    <div class="copy">
                        <?php the_sub_field('copy'); ?>
                    </div>

                    <?php
                    $link = get_sub_field('url');
                    if ($link):
                        $link_url = $link['url'];
                        $link_title = $link['title'];
                        $link_target = $link['target'] ? $link['target'] : '_self';
                        ?>
                        <a href="<?php echo esc_url($link_url); ?>"
                           target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
                    <?php endif; ?>
                </div>

            <?php endwhile;
            echo '</div>';
        else : endif; ?>

    <?php } elseif (in_category('team-member')) { ?>

        <!--Team-->
        <div class="content_block team_block">
            <?php if (get_field('roles')): ?>
                <div class="position acct">
                    <?php the_field('roles'); ?>
                </div>
            <?php endif; ?>
            <?php if (get_field('partnership_info')): ?>
                <div class="position">
                    <?php the_field('partnership_info'); ?>
                </div>
            <?php endif; ?>
            <?php if (get_field('partnership_logo')): ?>
                <div class="logo">
                    <img src="<?php the_field('partnership_logo'); ?>" alt="<?php the_title(); ?>">
                </div>
            <?php endif; ?>
            <?php if (get_field('video')): ?>
                <video controls>
                    <source src="<?php the_field('video'); ?>" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            <?php endif; ?>
            <div class="copy">
                <?php the_content(); ?>
            </div>
            <?php if (get_field('linkedin_url')): ?>
                <a href="<?php the_field('linkedin_url'); ?>" target="_blank">LinkedIn Profile</a>
            <?php endif; ?>
        </div>
        <!--Team-->

    <?php } ?>

    <div class="nav">
        <div class="closeBut button">Close</div> /
        <?php
        $nextPost = get_next_post(true);
        if ($nextPost) {
            $nextPostID = $nextPost->ID;
        } else {
            $first_post = get_posts(array(
                'posts_per_page' => 1,
                'order' => 'ASC',
                'category' => 2,
            ));
            $nextPostID = $first_post[0]->ID;
        }
        ?>
        <div class="backBut button post-link" rel="<?php echo $nextPostID; ?>">Back</div>
            /
        <?php
        $previousPost = get_previous_post(true);
        if ($previousPost) {
            $previousPostID = $previousPost->ID;
        } else {
            $latest_post = get_posts(array(
                'posts_per_page' => 1,
                'order' => 'DESC',
                'category' => 2,
            ));
            $previousPostID = $latest_post[0]->ID;
        }
        ?>
        <div class="backBut button post-link" rel="<?php echo $previousPostID; ?>">Next</div>

    </div>
</div>
