<?php

namespace Theme\PostTypes;

use WPKit\Registry\PostType;

class Test extends PostType {
	
	public $options = [
		'menu_icon' => 'dashicons-groups',
		'show_in_rest' => true,
		'supports' => ['title', 'editor', 'excerpt', 'thumbnail', 'page-attributes']
	];
    
}
