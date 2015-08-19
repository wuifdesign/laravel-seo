<?php
namespace WuifDesign\SEO\Facades;

use Illuminate\Support\Facades\Facade;

class SEOTool extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'seoTool';
    }
}