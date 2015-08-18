<?php
namespace WuifDesign\SEO;

use \Illuminate\Support\ServiceProvider as IlluminateServiceProvider;

class ServiceProvider extends IlluminateServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('seoMeta', function ($app) {
            return new SEOMeta($app);
        });

        $this->app->singleton('openGraph', function ($app) {
            return new OpenGraph($app);
        });
    }

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/wuifdesign-seo.php' => config_path('seo.php'),
        ]);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array(
            'seoMeta'
        );
    }
}
