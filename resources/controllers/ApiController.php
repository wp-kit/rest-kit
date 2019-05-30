<?php
	
	namespace Theme\Controllers;
	
	use WPKit\Invoker\Controller;
	use Illuminate\Support\Facades\Input;
	
	class ApiController extends Controller  {
		
		public function beforeFilter(Input $request) {
			
			register_rest_field(
				['test', 'post'],
				'featured_image_url',
				array(
					'get_callback'    => array($this, 'getFeaturedImageUrl'),
					'update_callback' => null,
					'schema'          => null,
				)
			);
			
			parent::beforeFilter($request);
			
		}
		
		/**
		 * Get the value of the "featured_image_url" field
		 *
		 * @param array $object Details of current post.
		 * @param string $field_name Name of field.
		 * @param WP_REST_Request $request Current request
		 *
		 * @return mixed
		 */
		public function getFeaturedImageUrl( $object, $field_name, $request ) {
			$thumbnail_id = get_post_thumbnail_id( $object->ID );
			return wp_get_attachment_image_url($thumbnail_id, 'large');
		}
		
		public static function getMenu($request) {
			
			$menu = [];

            foreach(get_nav_menu_items_by_location($request->get_param('menu')) as $item) {

                $item->path = parse_url($item->url, PHP_URL_PATH);

                array_push($menu, $item);
            }

            return $menu;
			
		}
		
	}