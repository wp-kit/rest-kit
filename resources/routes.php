<?php

	invoke( 'AppController', 'init' );
	invoke( 'ApiController', 'rest_api_init' );
	
	rest_route( 'wp/v2', '/menu', [Theme\Controllers\ApiController::class, 'getMenu'] );
