<?php
	
	namespace Theme\Controllers;
	
	use WPKit\Invoker\Controller;
	use Illuminate\Support\Facades\Request;
	use WPKit\Invoker\Traits\LoadsManifest;
	
	class AppController extends Controller {
		
		use LoadsManifest;
		
		protected $scripts_action = 'admin_enqueue_scripts';
		
		/**
	     * Default controller method when controller is invoked
	     *
	     * @return void
	     */
		public function boot(Request $request) {
			
			filter( 'site_url', function( $url ) {

				return str_replace( get_option( 'siteurl' ) . "wp-login.php?action=rp&", get_option( 'homeurl' ) . "reset-password?", $url );
				
			});
			
			filter( 'upload_mimes', function($types) {
				
				$types['json'] = 'application/json';
				$types['svg'] = 'image/svg+xml';
				
				return $types;
				
			}, 1);
			
		}
		
		protected function getScripts() {
			
			$this->loadManifest(['main.js', 'main.css']);
			
			return parent::getScripts();
			
		}
		
	}
