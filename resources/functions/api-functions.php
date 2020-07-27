<?php
	
	use WPKit\Invoker\Invoker;
	
	function rest_route( $namespace, $route, $callback, $methods = 'GET' ) {
		
		$methods = is_array( $methods ) ? array_map('strtoupper', $methods) : strtoupper($methods);
		
		add_action( 'rest_api_init', function() use($namespace, $callback, $route, $methods) {
		
			register_rest_route( $namespace, $route, [
				'methods' => $methods,
				'callback' => function($request) use($callback) {
					
					return app(Invoker::class)->registerCallback($callback)( $request );
					
				},
			] );
			
		} );
		
	}
