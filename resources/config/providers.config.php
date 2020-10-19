<?php
/**
 * Define a list of service providers to use in your theme.
 */
return [
	Theme\Providers\ErrorServiceProvider::class,
	Theme\Providers\FunctionsServiceProvider::class,
	Theme\Providers\SupportServiceProvider::class,
	WPKit\Invoker\InvokerServiceProvider::class,
	Illuminate\View\ViewServiceProvider::class,
	Illuminate\Events\EventServiceProvider::class,
	Illuminate\Filesystem\FilesystemServiceProvider::class,
	Theme\Providers\HttpServiceProvider::class,
    WPKit\Registry\RegistryServiceProvider::class,
    WPKit\Integrations\Acf\AcfServiceProvider::class
];
