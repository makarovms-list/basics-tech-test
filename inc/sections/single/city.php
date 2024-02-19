<section class="single-city">
    <div class="container">
        <h1>Объявления в городе: <?php echo $post->post_title; ?></h1>
        <div class="estate-cnt">
            <?php
                $estate_posts = get_posts( array(
                	'numberposts' => 10,
                	'orderby'     => 'date',
                	'order'       => 'DESC',
                	'post_type'   => 'estate',
                	'post_parent' => $post->ID,
                ) );
    
                global $post;
                foreach( $estate_posts as $post ){
                	setup_postdata( $post );
            ?>
                <div class="estate-item">
                    <div class="image">
                        <?php if (has_post_thumbnail( $post->ID ) ): ?>
                            <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
                            <picture>
                                <a href="<?php echo get_permalink( $post->ID ); ?>"><img src="<?php echo $image[0]; ?>" alt="<?php echo $post->post_title; ?>"></a>
                            </picture>
                        <?php endif; ?>
                    </div>
                    <div class="estate-name"><a href="<?php echo get_permalink( $post->ID ); ?>"><?php echo $post->post_title; ?></a></div>
                    <div class="estate-city">Город: <?php echo get_the_title( $post->post_parent ); ?></div>
                    <div class="square">
                        <span class="title">Площадь:</span><span class="value"><?php echo get_field( "square", $post->ID ); ?> м</span>
                    </div>
                    <div class="cost">
                        <span class="title">Цена:</span><span class="value"><?php echo number_format(get_field( "cost", $post->ID ), 0, '.', ' '); ?> рублей</span>
                    </div>
                    <div class="address">
                        <span class="title">Адрес:</span><span class="value"><?php echo get_field( "address", $post->ID ); ?></span>
                    </div>
                    <div class="living_area">
                        <span class="title">Жилая площадь:</span><span class="value"><?php echo get_field( "living_area", $post->ID ); ?> м</span>
                    </div>
                    <div class="floor">
                        <span class="title">Этаж:</span><span class="value"><?php echo get_field( "floor", $post->ID ); ?></span>
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