<?php
/*
Plugin Name: GingerGear Mobile Map 
Plugin URI: http://gingergear.com/mobile-map
Version: 0.1
Author: Yuncheng Mao 
Description: You can use this to generate map for mobile and desktop
Text Domain: Mobile Map
Domain Path: /languages
*/

/******************** Start enqueue scripts and styles for admin ********************/
	add_action( 'admin_head', 'enqueue_mobile_map_admin');

	function enqueue_mobile_map_admin () {
		$current_screen = get_current_screen();
		if( 'mobile_maps' == $current_screen->post_type ){
			wp_enqueue_media();
			wp_enqueue_script(mobile_map_deps, plugins_url('js/jquery-1.9.1.min.js', __FILE__), array(), '1.9.1');
			wp_enqueue_script(mobile_map, plugins_url('js/jquery.smoothZoom.min.js', __FILE__), array('mobile_map_deps'), '1.0.0');
			wp_enqueue_script(mobile_map_media_manager, plugins_url('js/media-manager.js', __FILE__), array('media-views'));
			wp_enqueue_script(mobile_map_js, plugins_url('js/mobile-map.js', __FILE__), array(), '1.0.0');
			wp_enqueue_style(mobile_map_css, plugins_url('css/mobile-map.css', __FILE__), array(), '1.0.0');
			wp_enqueue_style(admin_mobile_map_css, plugins_url('css/admin-mobile-map.css', __FILE__), array(), '1.0.0');
		}
	}
/******************** End enqueue ********************/

/******************** Start enqueue scripts and styles for front end ********************/
/******************** End enqueue ********************/

/******************** Start create map post type ********************/
	add_action( 'init', 'create_mobile_map' );
	
	function create_mobile_map () {
		register_post_type('mobile_maps', 
			array(
				'labels' => array(
					'name' => __( 'All Mobile Maps' ),
					'singular_name' => __( 'Mobile Map' ),
					'add_new' => __( 'Add New' ),
					'add_new_item' => __( 'Add New Mobile Map' ),
					'edit' => __( 'Edit' ),
					'edit_item' => __( 'Edit Mobile Map' ),
					'new_item' => __( 'New Mobile Map' ),
					'view' => __( 'View Mobile Map' ),
					'view_item' => __( 'View Mobile Map' ),
					'search_items' => __( 'Search Mobile Maps' ),
					'not_found' => __( 'No Mobile Maps found' ),
					'not_found_in_trash' => __( 'No Mobile Maps found in Trash' ),
					'parent' => __( 'Parent Mobile Map' ),
				),
				'public' => true,
				'menu_position' => 20, 
				'supports' => array('title'),
				'taxonomies' => array(),
				'menu_icon' => 'dashicons-location-alt',
			)
		);
	}
/******************** End post type ********************/

/******************** Start meta box for create map ********************/
	function metabox_remove_and_add() {
		remove_meta_box( 'submitdiv' , 'mobile_maps' , 'normal' ); 
		add_meta_box('mobile-map-div', 'Map', 'map_html', 'mobile_maps', 'normal');
	}

	function map_html () {
	?>
		<div id="map-container" class="map-container">
			<fieldset id="map-sample" class="map-field map-sample">
				<legend>Map Sample:</legend>
				<div id="sample-area" class="sample-area">
					<img id="mobile-map" src="" />
					<p>No Image Selected</p>
					<input type="hidden" id="sample-width" value="">
					<input type="hidden" id="sample-height" value="">
					<input type="hidden" id="sample-ratio" value="">
				</div>
			</fieldset>
		</div>
		<div id="map-manipulator" class="map-controller">
			<fieldset id="map-detail" class="map-field map-detail">
				<legend>Map Setting:</legend>
				<span>Select A Map:</span><input type="button" class="button open-media-button" id="open-media-lib" value="Open Media Library" data-title="Select A Map" data-button-text="Select" /> 
				<br style="clear: both;" /> 			
				<span>Width:</span><input type="text" id="map-width" placeholder="use % or px to represent width"/> 
				<br style="clear: both;" /> 
				<span>Height:</span><input type="text" id="map-height" placeholder="use only px to represent height"/> 
				<br style="clear: both;" />
				



				<input type="button" id="map-generator" class="button" value="Generate map"> 
			</fieldset>
			<br style="clear: both;" />
			<fieldset id="map-status" class="map-field map-status">
				<legend>Map Status:</legend>
				<input type="button" id="map-status-generator" class="button" value="Generate map status"> <br /><br />
				<span id="map-status-data"></span>
			</fieldset>
		</div>
		<br style="clear: both;" />
	<?php	
	}

	add_action( 'admin_menu' , 'metabox_remove_and_add' );
/******************** End meta box ********************

?>
