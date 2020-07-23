<?php
	
	namespace Theme\Controllers;
	
	use WPKit\Invoker\Controller;
	use Illuminate\Support\Facades\Request;
	
	class ApiController extends Controller  {
		
		public function beforeFilter(Request $request) {
			
			register_rest_field(
				['test', 'post'],
				'featured_image_url',
				array(
					'get_callback'    => array($this, 'getFeaturedImageUrl'),
					'update_callback' => null,
					'schema'          => null,
				)
			);
			
			filter('rest_prepare_page', function($data) {
				if(!is_admin()) {
					unset($data->data['content']);
				}
				return $data;
			});
			
			filter('acf/format_value/type=post_object', 'convertPostToResponse');
			filter('acf/format_value/type=relationship', function($value) {
				$value = is_array($value) ? $value : [];
				foreach($value as &$post) {
					$post = $this->convertPostToResponse($post);
				}
				return $value;
			});
			
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
		
		public function convertPostToResponse($value) {
			
			if($value instanceof \WP_Post) {
				$response = (new \WP_REST_Posts_Controller($value->post_type))->prepare_item_for_response($value, ['context' => 'view']);
				$value = $response->data;
			}
			return $value;
			
		}
		
	}
