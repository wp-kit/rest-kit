<?php
	
	namespace Theme\Controllers;
	
	use WPKit\Invoker\Controller;
	use Illuminate\Support\Facades\Request;
	
	class ApiController extends Controller  {
		
		/**
	     * Default controller method when controller is invoked
	     *
	     * @return void
	     */
		public function boot(Request $request) {
			
			$post_types = get_post_types_by_support( [ 'editor' ] );
			foreach ( $post_types as $post_type ) {
				if ( use_block_editor_for_post_type( $post_type ) ) {
					register_rest_field(
						$post_type,
						'blocks',
						['get_callback' => function ( array $post ) {
							return $this->transform( json_decode( json_encode( parse_blocks( $post['content']['raw'] ) ) ) );
						}]
					);
				}
			}
			
			register_rest_field(
				['test', 'post'],
				'featured_image_url',
				[
					'get_callback'    => [$this, 'getFeaturedImageUrl'],
					'update_callback' => null,
					'schema'          => null,
				]
			);
			
			filter('rest_prepare_page', function($data) {
				if(!is_admin()) {
					unset($data->data['content']);
				}
				return $data;
			});
			
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
		
		protected function transform( $blocks ) {
	
			foreach($blocks as &$block) {
				
				$block->innerText = trim(preg_replace('/\s\s+/', ' ', strip_tags( $block->innerHTML )));
				
				if(strpos($block->blockName, 'acf/') === 0) {
				
					acf_setup_meta( json_decode(json_encode($block->attrs->data), true), $block->attrs->id, true );
					
					$id = $block->attrs->id;
					
					unset($block->attrs->name);
					unset($block->attrs->id);
					unset($block->attrs->data);
					
					$block = (object) [
						'name' => $block->blockName,
						'innerBlocks' => $block->innerBlocks,
						'innerText' => $block->innerText,
						'data' => (object) array_merge((array) $block->attrs, get_fields($id))
					];
				}
				else {
					$block = (object) [
						'name' => $block->blockName,
						'innerBlocks' => $block->innerBlocks,
						'innerText' => $block->innerText,
						'data' => $block->attrs
					];
				}
				
				if(!empty($block->innerBlocks) && is_array($block->innerBlocks)) {
					$block->innerBlocks = $this->transform($block->innerBlocks);
				}
			}
			
			return array_values(array_filter($blocks, fn($block) => $block->name));
			
		}
		
	}
