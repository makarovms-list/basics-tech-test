<section class="form-add-estate">
    <div class="container">
        <div class="feedback__wrap">
            <h2>Добавить объект недвижимости</h2>
            <div class="feedback-form-cnt">
                <form id="feedback-form" class="feedback-form">
                    <input type="hidden" name="attach_file" value="">
                    <input type="hidden" name="action" value="add_estate">
                    <div class="form__row city">
                        <label for="city">Город <span class="error-svg"></span></label>
                        <select id="city" name="city">
                            <?php
                                $city_posts = get_posts( array(
                                	'numberposts' => -1,
                                	'orderby'     => 'date',
                                	'order'       => 'DESC',
                                	'post_type'   => 'city',
                                ) );
                    
                                global $post;
                                foreach( $city_posts as $key => $post ){
                                	setup_postdata( $post );
                            ?>
                                <option value="<?php echo $post->ID; ?>"><?php echo $post->post_title; ?></option>
                            <?php
                                }
                                wp_reset_postdata();
                            ?> 
                        </select>
                    </div>
                    
                    <div class="form__row estate_type">
                        <label for="estate_type">Тип недвижимости <span class="error-svg"></span></label>
                        <select id="estate_type" name="estate_type">
                            <?php
                                $args = array( 
	                                'taxonomy' => 'type_estate',
	                                'hide_empty' => false
                                );
                                $estate_type = get_terms( $args );

                                foreach( $estate_type as $key => $value ){
                            ?>
                                <option value="<?php echo $value->term_id; ?>"><?php echo $value->name; ?></option>
                            <?php
                                }
                            ?> 
                        </select>
                    </div>
                    
                    <div class="form__row square">
                        <label for="square">Площадь <span class="error-svg"></span></label>
                        <input type="text" name="square" class="form-field-callback" value="" id="square" placeholder="" />
                        <span class="not-valid-tip hidden">Поле обязательно для заполнения.</span>
                    </div>
                    <div class="form__row cost">
                        <label for="cost">Цена <span class="error-svg"></span></label>
                        <input type="text" name="cost" class="form-field-callback" value="" id="cost" placeholder="" />
                        <span class="not-valid-tip hidden">Поле обязательно для заполнения.</span>
                    </div>
                    <div class="form__row address">
                        <label for="address">Адрес <span class="error-svg"></span></label>
                        <input type="text" name="address" class="form-field-callback" value="" id="address" placeholder="" />
                        <span class="not-valid-tip hidden">Поле обязательно для заполнения.</span>
                    </div>
                    <div class="form__row living_area">
                        <label for="living_area">Жилая площадь <span class="error-svg"></span></label>
                        <input type="text" name="living_area" class="form-field-callback" value="" id="living_area" placeholder="" />
                        <span class="not-valid-tip hidden">Поле обязательно для заполнения.</span>
                    </div>
                    <div class="form__row floor">
                        <label for="floor">Этаж <span class="error-svg"></span></label>
                        <input type="text" name="floor" class="form-field-callback" value="" id="floor" placeholder="" />
                        <span class="not-valid-tip hidden">Поле обязательно для заполнения.</span>
                    </div>
                    <div class="form__row">
                        <button class="btn">Отправить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>