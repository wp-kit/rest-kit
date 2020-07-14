<?php
	
	namespace Theme\Controllers;
	
	use WPKit\Invoker\Controller;
	use Illuminate\Support\Facades\Request;
	use GutesObjectPlugin\Database;
	use GutesObjectPlugin\GutesObjectPlugin;
	
	class GutenbergController extends Controller {
		
		protected $scripts_action = 'admin_enqueue_scripts';
		
		public function beforeFilter(Request $request) {
			
			if( empty( $GLOBALS['gutenbergObjectPlugin'] ) ) {
			
				GutesObjectPlugin::init();
				
			}
			
			action('after_switch_theme', function() {
			
				(new Database())->activate_gutes_array_save();
				
			});
			
			action('switch_theme', function() {
			
				(new Database())->deactivate_gutes_array_save();
				
			});
			
			filter('gutenberg_object_plugin_data', function($blocks) {
				
				foreach($blocks as $block) {
					
					if(strpos($block->name, 'acf/') === 0) {
						
						$data = &$block->data->attributes->data;
						
						$this->handleBlockData($data);
						
					}
					
				}
				
				return $blocks;
				
			});
			
			parent::beforeFilter($request);
			
		}
		
		protected function handleBlockData(&$data) {
			
			$data = (array) $data;
			
			foreach($data as $key => &$value) {
				
				if(is_object($value)) {
					
					$value = (array) $value;
					
				}
							
				if(strpos($key, 'field_') === 0) {
					
					$field = (object) get_field_object($key);
					
					$data[$field->name] = $data[$key];
					unset($data[$key]);
					
					if($field->type == 'repeater') {
						
						$data[$field->name] = array_values($value);
						
					}
					
				}
				
				if(is_array($value)) {
					
					$this->handleBlockData($value);
					
				} else if(strpos($value, 'field_') === 0 && strpos($key, '_') === 0 && is_numeric($data[substr($key, 1)]) && ((object) get_field_object($value))->type == 'repeater') {
				
					$k = substr($key, 1);
					$length = $data[$k];
					$data[$k] = [];
					
					unset($data[$key]);
					
					$keys = array_filter(array_keys($data), function($key) use($k) {
						return strpos($key, "{$k}_") === 0;	
					});
					
					foreach($keys as $key) {
						
						list($i, $prop) = explode('_', str_replace("{$k}_", '', $key));
						
						$data[$k][$i] = [
							$prop => $data[$key]
						];
						
						unset($data[$key]);
						unset($data["_{$key}"]);
						
					}
					
				}
				
			}
			
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
