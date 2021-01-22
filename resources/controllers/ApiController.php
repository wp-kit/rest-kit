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
			
			/* Add Gutenberg Blocks field as gblocks */
			if ( ! function_exists( 'use_block_editor_for_post_type' ) ) {
				require ABSPATH . 'wp-admin/includes/post.php';
			}
			
			$post_types = get_post_types_by_support( [ 'editor' ] );
			foreach ( $post_types as $post_type ) {
				if ( use_block_editor_for_post_type( $post_type ) ) {
					register_rest_field(
						$post_type,
						'gblocks',
						['get_callback' => function ( array $post ) {
							$blocks = apply_filters( 'rest_response_parse_blocks', json_decode( json_encode( parse_blocks( $post['content']['raw'] ) ) ), $post, $post_type );
							return array_values(array_filter($blocks, fn($block) => $block->blockName));
						}]
					);
				}
			}
			
			/* Example, add field */
			register_rest_field(
				['test', 'post'],
				'featured_image_url',
				[
					'get_callback'    => [$this, 'getFeaturedImageUrl'],
					'update_callback' => null,
					'schema'          => null,
				]
			);
			
		}
		
		public function getFeaturedImageUrl( $object, $field_name, $request ) {
			$thumbnail_id = get_post_thumbnail_id( $object->ID );
			return wp_get_attachment_image_url($thumbnail_id, 'large');
		}
	}
