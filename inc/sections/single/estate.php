<section class="estate-item">
    <div class="container">
        <div class="flat-item">
            <h1><?php echo $post->post_title; ?></h1>
            <div class="image">
                <?php if (has_post_thumbnail( $post->ID ) ): ?>
                    <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
                    <picture>
                        <a href="<?php echo get_permalink( $post->ID ); ?>"><img src="<?php echo $image[0]; ?>" alt="<?php echo $post->post_title; ?>"></a>
                    </picture>
                <?php endif; ?>
            </div>
            <div class="flat-square">
                <span class="title">Площадь:</span><span class="value"><?php echo get_field( "square", $post->ID ); ?> м</span>
            </div>
            <div class="flat-cost">
                <span class="title">Цена:</span><span class="value"><?php echo number_format(get_field( "cost", $post->ID ), 0, '.', ' '); ?> рублей</span>
            </div>
            <div class="flat-address">
                <span class="title">Адрес:</span><span class="value"><?php echo get_field( "address", $post->ID ); ?></span>
            </div>
            <div class="flat-living-area">
                <span class="title">Жилая площадь:</span><span class="value"><?php echo get_field( "living_area", $post->ID ); ?> м</span>
            </div>
            <div class="flat-floor">
                <span class="title">Этаж:</span><span class="value"><?php echo get_field( "floor", $post->ID ); ?></span>
            </div>
        </div>    
    </div>
</section>
    