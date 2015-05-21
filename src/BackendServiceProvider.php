<?php namespace Jai\Backend;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Route;
use Illuminate\Translation;
use Illuminate\Foundation;

class BackendServiceProvider extends ServiceProvider {



	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	public function boot()
	{
		// Load views
		$this->loadViewsFrom(realpath(__DIR__.'/../views'), 'BackendViews');

		// Setup Routes
		$this->setupRoutes($this->app->router);

		// Publish Config
		$this->publishes([
				__DIR__.'/config/backend.php' => config_path('backend.php'),
		]);
		// Publish your migrations
		$this->publishes([__DIR__ . '/../database/migrations/' => database_path('/migrations')], 'migrations');


        // Giving out Alia Load
		AliasLoader::getInstance()->alias('backend', 'Jai\Backend');

		// Load language
		$this->loadTranslationsFrom(base_path() . '/packages/jai/backend/lang', 'panel');
		$this->loadTranslationsFrom(base_path() . '/vendor/zofe/rapyd/lang', 'rapyd');
		//$this->package('jai/Blog',null, __DIR__); //  this  has to be specified for psr-4  compatibility
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		// register  zofe\rapyd
		$this->app->register('Zofe\Rapyd\RapydServiceProvider');
		// register html service provider
		$this->app->register('Illuminate\Html\HtmlServiceProvider');

		$this->app->register('LucaDegasperi\OAuth2Server\Storage\FluentStorageServiceProvider');
		$this->app->register('LucaDegasperi\OAuth2Server\OAuth2ServerServiceProvider');

		/*
		 * Create aliases for the dependency.
		 */
		$loader = AliasLoader::getInstance();
		$loader->alias('Form', 'Illuminate\Html\FormFacade');
		$loader->alias('Html', 'Illuminate\Html\HtmlFacade');
		$loader->alias('Authorizer', 'LucaDegasperi\OAuth2Server\Facades\AuthorizerFacade');

		$this->registerBackend();
		config([
				'config/backend.php',
		]);

		$this->publishes([
				__DIR__.'/../public' => public_path('packages/jai/backend')
		], 'assets');

	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return [];
	}

	private function registerBackend(){

		$this->app->bind('backend',function($app){
			return new Backend($app);
		});
	}

	/**
	 * Define the routes for the application.
	 *
	 * @param  \Illuminate\Routing\Router  $router
	 * @return void
	 */
	public function setupRoutes(Router $router)
	{
		$router->group(['namespace' => 'Jai\Backend\Http\Controllers'], function($router)
		{
			require __DIR__ . '/Http/routes.php';
		});
	}


}
