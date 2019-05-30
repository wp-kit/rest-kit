<?php
/**
 * Define a list of service providers to use in your theme.
 */
return [
	Theme\Providers\ErrorServiceProvider::class,
	Theme\Providers\FunctionsServiceProvider::class,
	Theme\Providers\SupportServiceProvider::class,
	WPKit\Invoker\InvokerServiceProvider::class,
	Theme\Providers\HttpServiceProvider::class,
	Illuminate\Filesystem\FilesystemServiceProvider::class,
    WPKit\Registry\RegistryServiceProvider::class
];
