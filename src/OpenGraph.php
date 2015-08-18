<?php
namespace WuifDesign\SEO;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Log;

class OpenGraph extends SEOElement
{
    protected $configName = 'opengraph';

    /**
     * @var string
     */
    protected $ogPrefix = 'og:';

    /**
     * @var array
     */
    protected $images = [];

    /**
     * Set default values
     */
    protected function setDefault()
    {
        $this->addProperty('title', $this->config['title']);
        $this->addProperty('description', $this->config['description']);
        $this->addProperty('url', $this->config['url']);
        $this->addProperty('type', $this->config['type']);
        $this->addProperty('site_name', $this->config['site_name']);

        $this->addProperty('image_array', 'no not delete!');
        if(isset($this->config['images'])) {
            $this->images = $this->config['images'];
        }
    }

    /**
     * Get a string of a property
     *
     * @param $key
     * @param $value
     * @param $name
     *
     * @return string
     */
    protected function getProperty($key, $value, $name = 'name')
    {
        if($key == 'image_array') {
            $return = array();
            foreach($this->images as $image) {
                $return[] = $this->getProperty('image', $image);
            }
            return implode(PHP_EOL, $return);
        }
        if(empty($value)) {
            return '';
        }
        if(is_array($value)) {
            $value = implode(', ', $value);
        }
        return '<meta property="'.$this->ogPrefix.$key.'" content="'.$value.'">';
    }

    /**
     * Set the url property.
     *
     * @param string $url
     *
     * @return OpenGraph
     */
    public function setUrl($url)
    {
        return $this->addProperty('url', $url);
    }

    /**
     * Set the site_name property
     *
     * @param string $name
     *
     * @return OpenGraph
     */
    public function setSiteName($name)
    {
        return $this->addProperty('site_name', $name);
    }

    /**
     * Add an image to properties
     *
     * @param string $url
     *
     * @return OpenGraph
     */
    public function addImage($url)
    {
        $this->images[] = $url;
        return $this;
    }
}