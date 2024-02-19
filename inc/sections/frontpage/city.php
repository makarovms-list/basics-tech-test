<section class="city">
    <div class="container">
        <h2>Города</h2>
        <div class="city-cnt">
            <?php
                $city_posts = get_posts( array(
                	'numberposts' => 10,
                	'orderby'     => 'date',
                	'order'       => 'DESC',
                	'post_type'   => 'city',
                ) );
    
                global $post;
                foreach( $city_posts as $post ){
                	setup_postdata( $post );
            ?>
                <div class="city-item">
                    <div class="image">
                        <?php if (has_post_thumbnail( $post->ID ) ): ?>
                            <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
                            <picture>
                                <a href="<?php echo get_permalink( $post->ID ); ?>"><img src="<?php echo $image[0]; ?>" alt="<?php echo $post->post_title; ?>"></a>
                            </picture>
                        <?php endif; ?>
                    </div>
                    <div class="city-name"><a href="<?php echo get_permalink( $post->ID ); ?>"><?php echo $post->post_title; ?></a></div>
                    <div class="city-desc">
                        <?php the_content(); ?>
                    </div>
                </div>
            <?php
                	// формат вывода the_title() ...
                }
                
                wp_reset_postdata(); // сброс
            ?> 
        </div>
    </div>
</section>









    </div>
</section>