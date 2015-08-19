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
        $this->app->singleton('metaTags', function ($app) {
            return new MetaTags($app);
        });

        $this->app->singleton('openGraph', function ($app) {
            return new OpenGraph($app);
        });

        $this->app->singleton('twitterCard', function ($app) {
            return new TwitterCard($app);
        });

        $this->app->singleton('seoTools', function ($app) {
            return new SEOTools($app);
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
            'metaTags',
            'openGraph',
            'twitterCard',
            'seoTools'
        );
    }
}
