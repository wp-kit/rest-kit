<?php
	
	// In theme/resources/config/acf.config.php

	return [
	
	    /*
	    |--------------------------------------------------------------------------
	    | ACF Options Args
	    |--------------------------------------------------------------------------
	    |
	    | Tell the Service Provider which pages to register in the admin area
	    |
	    */
	
	    'pages' => [
		    [
			    'type' => 'page',
			    'args' => [
					'page_title' => 'Global Settings'
				]
		    ]
	    ],
	    
	    'blocks' => [
		    [
			    'name' => 'example-block',
			    'title' => 'Example Block',
			    'category' => 'rest-kit-example-blocks',
			    'icon' => 'welcome-widgets-menus',
			    'description' => 'An example block',
			    'has_inner_blocks' => true
		    ],
		    [
			    'name' => 'slider-block',
			    'title' => 'Slider Block',
			    'category' => 'rest-kit-example-blocks',
			    'icon' => 'welcome-widgets-menus',
			    'description' => 'Used to display sliders'
		    ]
		],
		
		'block_categories' => [
		    [
				'slug' => 'rest-kit-example-blocks',
				'title' => 'Rest Kit Examples',
			]
	   	],
	
	    /*
	    |--------------------------------------------------------------------------
	    | ACF JSON Path
	    |--------------------------------------------------------------------------
	    |
	    | Tell the Server Provider where to find JSON files to save and load
	    | configurations from. By default the below function loads from:
	    |
	    | ~/theme/resources/acf/
	    |
	    */
	
	    'json_path' => resources_path('acf')
	
	];
