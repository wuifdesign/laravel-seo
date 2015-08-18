<?php
namespace WuifDesign\SEO;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Log;

class SEOElement
{
    /**
     * The application instance.
     *
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    /**
     * Display logs
     *
     * @var boolean
     */
    protected $logging;

    /**
     * Name of the config
     *
     * @var string
     */
    protected $configName;

    /**
     * Array to default config settings
     *
     * @var array
     */
    protected $config;

    /**
     * @var array
     */
    protected $properties = [];

    /**
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->logging = $this->app['config']['seo.enable_logging'];
        $this->config = $this->app['config']['seo.'.$this->configName];

        $this->setDefault();
    }

    /**
     * Set default values
     */
    protected function setDefault() { }

    /**
     * Renders all meta tags
     *
     * @return string
     */
    public function render()
    {
        return $this->getProperties();
    }

    /**
     * Add or update property.
     *
     * @param string $key
     * @param string $value
     * @param string $name
     *
     * @return SEOElement
     */
    public function addProperty($key, $value, $name = 'name')
    {
        $this->properties[$key] = $value;
        return $this;
    }

    /**
     * Removes a property
     *
     * @param string $key
     *
     * @return SEOElement
     */
    public function removeProperty($key)
    {
        array_forget($this->properties, $key);
        return $this;
    }

    /**
     * Get all properties
     *
     * @return SEOElement
     */
    protected function getProperties()
    {
        $return = array();
        foreach(array_filter($this->properties) as $key => $value) {
            $return[] = $this->getProperty($key, $value);
        }
        return implode(PHP_EOL, $return);
    }

    /**
     * Get a string of a property
     *
     * @param $key
     * @param $value
     *
     * @return string
     */
    protected function getProperty($key, $value) { return ''; }

    /**
     * Set the title
     *
     * @param string $title
     *
     * @return SEOElement
     */
    public function setTitle($title)
    {
        return $this->addProperty('title', strip_tags($title));
    }

    /**
     * Set the description
     *
     * @param string $description
     *
     * @return SEOElement
     */
    public function setDescription($description)
    {
        if($this->logging) {
            if(strlen($description) > 160) {
                Log::notice('Meta Description too long - '.strlen($description).' characters - use less than 160 characters');
            }
            if(strlen($description) < 120) {
                Log::notice('Meta Description too short - '.strlen($description).' characters - try to use between 150-160 characters');
            }
        }

        return $this->addProperty('description', strip_tags($description));
    }
}