<article class="member post-link" rel="<?php the_ID(); ?>" data-url="<?php the_permalink(); ?>">
    <div class="img" id="playOnHover-<?php echo $post_id; ?>" data-animation="">
        <?php
        $thumb_url = get_the_post_thumbnail_url();
        $thumb_low = strtolower($thumb_url);
        if (strpos($thumb_low, '.gif') === false) {
            $thumb_size = 'large';
        } else {
            $thumb_size = 'full';
        }
        ?>
        <?php
        // Get the hover effect image URL for a specific post
        $post_id = get_the_ID();

        // Generate a unique ID for the img element
        $img_id = 'playOnHover-' . $post_id;
        ?>
        <?php echo do_shortcode('[custom_hover_image post_id="' . $post_id . '" default_image="' . $thumb_url . '"]'); ?>
    </div>
    <div class="name" id="demo">
        <?php the_title(); ?>
    </div>
    <div class="position" id="demo">
        <?php the_field('roles'); ?>
    </div>
</article>
