<?php if (is_singular('post')) : ?>
    <div class="post-gallery">
        <?php $gallery = get_field('gallery');
        if ($gallery) :
            foreach ($gallery as $image) : ?>
                <img src="<?php echo esc_url($image['sizes']['thumbnail']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
            <?php endforeach;
        endif; ?>
    </div>
<?php endif; ?>