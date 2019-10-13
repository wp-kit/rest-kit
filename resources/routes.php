<?php

	if( defined('GUTENBERG_OBJECT_PLUGIN_CPTS') ) {

		invoke( 'GutenbergController', 'init' );
		
	}

	invoke( 'AppController', 'init' );
	invoke( 'ApiController', 'rest_api_init' );
	
	rest_route( 'wp/v2', '/menu', array(Theme\Controllers\ApiController::class, 'getMenu') );
