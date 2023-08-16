<div class="partner post-link width_<?php the_field('size');?>" rel="<?php the_ID(); ?>" data-url="<?php the_permalink();?>">
    <div class="name">
        <?php the_title();?>
        <?php
        $thumb_url = get_the_post_thumbnail_url();
        $thumb_low = strtolower($thumb_url);
        if (stripos($thumb_low, '.gif') === false){
            $thumb_size = 'large';
        } else {
            $thumb_size = 'full';
        }
        ?>
        <img src="<?php echo $thumb_url; ?>" data-origianl-src="<?php echo $thumb_url ?>" />
    </div>
</div>