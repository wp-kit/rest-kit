<?php
	
	namespace Theme\Controllers;
	
	use WPKit\Invoker\Controller;
	use Illuminate\Support\Facades\Input;
	use GutesObjectPlugin\GutesObjectPlugin\Database;
	
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
			
			action('after_switch_theme', function() {
			
				(new Database())->activate_gutes_array_save();
				
			});
			
			action('switch_theme', function() {
			
				(new Database())->deactivate_gutes_array_save();
				
			});
			
			parent::beforeFilter($request);
			
		}
		
		protected function getScripts() {
			
			$manifest = get_stylesheet_directory() . '/manifest.json';
			
			if( ! file_exists( $manifest ) ) {
	
				wp_die('Npm run build has not been run');
				
			}
			
			$scripts = (array) json_decode(file_get_contents($manifest));
			
			if( ! $scripts ) {
	
				wp_die('Manifest file is corrupt');
				
			}
			
			$this->scripts = [
				$scripts['main.js'],
				$scripts['main.css']
			];
			
			return parent::getScripts();
			
		}
		
	}