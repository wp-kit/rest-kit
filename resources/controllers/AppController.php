<?php
	
	namespace Theme\Controllers;
	
	use WPKit\Invoker\Controller;
	use Illuminate\Support\Facades\Input;
	
	class AppController extends Controller {
		
		protected $scripts_action = 'admin_enqueue_scripts';
		
		public function beforeFilter(Input $request) {
			
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
		
	}
