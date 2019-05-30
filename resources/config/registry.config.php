<?php
	
return [

	/*
    |--------------------------------------------------------------------------
    | Registry
    |--------------------------------------------------------------------------
    |
    | Tell the Service Provider which post types to register
    |
    */
    'post_types' => [
        'test' => Theme\PostTypes\Test::class
    ],	
    
    /*
    |--------------------------------------------------------------------------
    | Registry
    |--------------------------------------------------------------------------
    |
    | Tell the Service Provider which taxonomies to register
    |
    */
    'taxonomies' => [],
    
    /*
    |--------------------------------------------------------------------------
    | Allowed Blocks
    |--------------------------------------------------------------------------
    |
    | Tell the Service Provider which blocks to allow
    |
    */
    'blocks' => []

];