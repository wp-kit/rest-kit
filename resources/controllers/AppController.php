<?php
	
	namespace Theme\Controllers;
	
	use WPKit\Invoker\Controller;
	use Illuminate\Support\Facades\Request;
	
	class AppController extends Controller {
		
		protected $scripts_action = 'admin_enqueue_scripts';
		
		public function beforeFilter(Request $request) {
			
			filter( 'block_categories', function($categories, $post) {
				return array_merge(
					$categories,
					array(
						array(
							'slug' => 'rest-kit-example-blocks',
							'title' => 'Rest Kit Examples',
						),
					)
				);
			}, 10, 2);
			
			filter( 'site_url', function( $url ) {

				return str_replace( get_option( 'siteurl' ) . "wp-login.php?action=rp&", get_option( 'homeurl' ) . "reset-password?", $url );
				
			});
			
			filter( 'upload_mimes', function($types) {
				
				$types['json'] = 'application/json';
				$types['svg'] = 'image/svg+xml';
				
				return $types;
				
			}, 1);
			
			parent::beforeFilter($request);
			
		}
		
		/**
	     * Output block HTML
	     *
	     * @return string
	     */
		public static function renderBlock($block, $inner_blocks) {
			
			echo view('blocks.' . $block['name'], compact('block', 'inner_blocks'));
			
		}
		
	}
