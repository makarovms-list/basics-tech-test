<?php

add_action( 'wp_enqueue_scripts', 'understrap_child_styles' );
function understrap_child_styles() {
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/css/style.css', array(), null  );
    wp_enqueue_script( 'child-js', get_stylesheet_directory_uri() . '/js/main.js', array(), null);
}

add_action( 'init', 'register_news_post_type' );
function register_news_post_type(){
    // тип поста “Недвижимость”
    register_post_type( 'estate', [
		'label'  => null,
		'labels' => [
			'name'               => 'Недвижимость',
			'singular_name'      => 'Недвижимость',
			'add_new'            => 'Добавить объект',
			'add_new_item'       => 'Добавление объекта',
			'edit_item'          => 'Редактирование объекта',
			'new_item'           => 'Новый объект',
			'view_item'          => 'Смотреть объект',
			'search_items'       => 'Искать объект',
			'not_found'          => 'Не найдено',
			'not_found_in_trash' => 'Не найдено в корзине',
			'menu_name'          => 'Недвижимость',
		],
		'description'         => 'Объекты недвижимости',
		'public'              => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => false,
		'show_ui'             => true,
		'show_in_nav_menus'   => true,
		'show_in_menu'        => true,
		'show_in_admin_bar'   => true,
		'show_in_rest'        => true,
		'rest_base'           => null,
		'menu_position'       => 21,
		'menu_icon'           => 'dashicons-portfolio',
		'hierarchical'        => false, 
		'rewrite'             => true,
		'query_var'           => true,
        'has_archive'         => 'dela',
        'supports'            => [ 'title', 'editor', 'thumbnail'], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
	] );

    register_taxonomy( 'type_estate', [ 'estate' ], [ 
		'label'                 => '', // определяется параметром $labels->name
        'description'           => 'Тип недвижимости',
		'labels'                => [
			'name'              => 'Тип недвижимости',
			'singular_name'     => 'Тип недвижимости',
			'search_items'      => 'Поиск типа недвижимости',
			'all_items'         => 'Все типы недвижимости',
			'view_item '        => 'Смотреть тип недвижимости',
			'parent_item'       => 'Родительский тип недвижимости',
			'parent_item_colon' => 'Родительский тип недвижимости',
			'edit_item'         => 'Изменить тип недвижимости',
			'update_item'       => 'Обновить тип недвижимости',
			'add_new_item'      => 'Добавить новый тип недвижимости',
			'new_item_name'     => 'Новое название типа недвижимости',
			'menu_name'         => 'Тип недвижимости',
		],
        'public'                => true,
        'show_in_rest'          => true,
        'rest_base'             => 'url_mark',
        'rest_controller_class' => 'WP_REST_Terms_Controller',
        'meta_box_cb'           => 'post_categories_meta_box',
        'show_admin_column'     => true,
        'show_in_quick_edit'    => true,
        'hierarchical'          => true,
		'rewrite'               => true,
	] );
    // тип поста “Города”
    register_post_type( 'city', [
		'label'  => null,
		'labels' => [
			'name'               => 'Города',
			'singular_name'      => 'Города',
			'add_new'            => 'Добавить город',
			'add_new_item'       => 'Добавление города',
			'edit_item'          => 'Редактирование города',
			'new_item'           => 'Новый город',
			'view_item'          => 'Смотреть город',
			'search_items'       => 'Искать город',
			'not_found'          => 'Не найдено',
			'not_found_in_trash' => 'Не найдено в корзине',
			'menu_name'          => 'Города',
		],
		'description'         => 'Города',
		'public'              => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => false,
		'show_ui'             => true,
		'show_in_nav_menus'   => true,
		'show_in_menu'        => true,
		'show_in_admin_bar'   => true,
		'show_in_rest'        => true,
		'rest_base'           => null,
		'menu_position'       => 21,
		'menu_icon'           => 'dashicons-portfolio',
		'hierarchical'        => false, 
		'rewrite'             => true,
		'query_var'           => true,
        'has_archive'         => 'dela',
        'supports'            => [ 'title', 'editor', 'thumbnail'], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
	] );
}

// Метабокс выбора города к объекту недвижимости
add_action('add_meta_boxes', function () {
	add_meta_box( 'city_estate', 'Город', 'city_estate_metabox', 'estate', 'side', 'low'  );
}, 1);
function city_estate_metabox( $post ){
	$cities = get_posts(array( 'post_type'=>'city', 'posts_per_page'=>-1, 'orderby'=>'post_title', 'order'=>'ASC' ));

	if( $cities ){
		echo '
		<div style="max-height:200px; overflow-y:auto;">
			<ul>
		';
		
		foreach( $cities as $city ){
			echo '
			<li><label>
				<input type="radio" name="post_parent" value="'. $city->ID .'" '. checked($city->ID, $post->post_parent, 0) .'> '. esc_html($city->post_title) .'
			</label></li>
			';
		}

		echo '
			</ul>
		</div>';
	}
	else
		echo 'Городов еще нет...';
}

// Метабокс прилинковонных объектов недвижимости к городу (Сделал это чтобы можно было проверить что действительно объекты линкуются к городам)
add_action('add_meta_boxes', function(){
	add_meta_box( 'estate_city', 'Объекты недвижимости', 'estate_city_metabox', 'city', 'side', 'low'  );
}, 1);

function estate_city_metabox( $post ){
	$estates = get_posts(array( 'post_type'=>'estate', 'post_parent'=>$post->ID, 'posts_per_page'=>-1, 'orderby'=>'post_title', 'order'=>'ASC' ));

	if( $estates ){
		foreach( $estates as $estate ){
			echo $estate->post_title .'<br>';
		}
	}
	else
		echo 'Объектов ещё нет...';
}

// Ajax-событие для юобавления объекта недвижимости
function add_estate(){
    $city = $_POST["city"];
    $estate_type = $_POST["estate_type"];
    $square = $_POST["square"];
    $cost = $_POST["cost"];
    $address = $_POST["address"];
    $living_area = $_POST["living_area"];
    $floor = $_POST["floor"];
    
    $estate_arr = array(
        'post_title' => 'Объект недвижимости от '.date("d-m-Y H:i:s"),
        'post_type' => 'estate',
        'post_parent' => $city,
        'post_status' => 'publish'
    );
    $estate_id = wp_insert_post($estate_arr);
    
    update_post_meta($estate_id, 'square', $square);
    update_post_meta($estate_id, 'cost', $cost);
    update_post_meta($estate_id, 'address', $address);
    update_post_meta($estate_id, 'living_area', $living_area);
    update_post_meta($estate_id, 'floor', $floor);
    wp_set_post_terms($estate_id, array($estate_type), 'type_estate', true );
    
    
    echo json_encode(array("post_id" => $estate_id));
	die();
}
add_action('wp_ajax_add_estate', 'add_estate');
add_action('wp_ajax_nopriv_add_estate', 'add_estate');








?>