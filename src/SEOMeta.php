<?php
namespace WuifDesign\SEO;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Log;

class SEOMeta extends SEOElement
{
    protected $configName = 'meta';

    /**
     * @var string
     */
    protected $pageTitle = null;

    /**
     * Available webmaster tags
     *
     * @var array
     */
    protected $webmasterTags = [
        'google'   => "google-site-verification",
        'bing'     => "msvalidate.01",
        'alexa'    => "alexaVerifyID",
        'pintrest' => "p:domain_verify",
        'yandex'   => "yandex-verification"
    ];

    /**
     * Set default values
     */
    protected function setDefault()
    {
        $this->addProperty('title', null);
        $this->addProperty('description', $this->config['description']);
        $this->addProperty('keywords', $this->config['keywords']);
        $this->setWebMasterTags();
    }

    /**
     * Load an add webmaster tags from config
     */
    protected function setWebMasterTags()
    {
        if(!isset($this->config['webmaster_tags'])) {
            return;
        }
        foreach ($this->config['webmaster_tags'] as $name => $value):
            if (!empty($value)):
                $meta = array_get($this->webmasterTags, $name, $name);
                $this->addProperty($meta, $value);
            endif;
        endforeach;
    }

    /**
     * Set the Page Title
     *
     * @param string $pageTitle
     *
     * @return SEOMeta
     */
    public function setPageTitle($pageTitle)
    {
        $this->pageTitle = $pageTitle;
        return $this;
    }

    /**
     * Set the keywords
     *
     * @param array $keywords
     * @param bool|false $append Append to the default keywords
     *
     * @return SEOMeta
     */
    public function setKeywords($keywords, $append = false)
    {
        if($append) {
            $keywords = array_merge($this->config['keywords'], $keywords);
        }

        if($this->logging && count($keywords) > 10) {
            Log::notice('Too many keywords - '.count($keywords).' keywords - use less than 10 keywords');
        }

        return $this->addProperty('keywords', $keywords);
    }

    /**
     * Add a custom meta tag
     *
     * @param string $name
     * @param string $value
     * @param string $key
     *
     * @return SEOMeta
     */
    public function setMeta($name, $value = null, $key = 'name')
    {
        return $this->addProperty($name, $value, $key);
    }

    /**
     * Remove a meta tag
     *
     * @param string $name
     *
     * @return SEOMeta
     */
    public function removeMeta($name)
    {
        return $this->removeProperty($name);
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
        if($key == 'title') {
            return '<title>'.$this->parseTitle($value).'</title>';
        }
        if(empty($value)) {
            return '';
        }
        if(is_array($value)) {
            $value = implode(', ', $value);
        }
        return '<meta '.$name.'="'.$key.'" content="'.$value.'">';
    }

    /**
     * Parse the title string
     *
     * @param $title
     *
     * @return string
     */
    public function parseTitle($title)
    {
        $pageTitle = $this->config['title'];
        if($this->pageTitle != null) {
            $pageTitle = $this->pageTitle;
        }

        if($title === null) {
            $return = $this->config['title'];
        } else {
            $return = str_replace(
                array('%title%', '%subtitle%'),
                array($pageTitle, $title),
                $this->config['title_styling']
            );
        }

        return $return;
    }
}