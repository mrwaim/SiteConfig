<?php namespace Klsandbox\SiteConfig;

use Illuminate\Support\ServiceProvider;
use Klsandbox\SiteConfig\Services\SiteConfig;

class SiteConfigServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	protected $siteConfig;

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		if (!$this->siteConfig)
		{
			$this->siteConfig = new SiteConfig();
		}

		view()->composer('*', function ($view) {
			$view->with('config', $this->siteConfig);
		});
		
		$this->app['router']->middleware('config', \Klsandbox\SiteConfig\Http\Middleware\ConfigMiddleware::class);
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		//
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

}
