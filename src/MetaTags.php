<?php
namespace WuifDesign\SEO;

class MetaTags extends SEOElement
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
        parent::setDefault();
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
     * @return MetaTags
     */
    public function setPageTitle($pageTitle)
    {
        $this->pageTitle = $pageTitle;
        return $this;
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
            return null;
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
        $pageTitle = $this->config['tags']['title'];
        if($this->pageTitle != null) {
            $pageTitle = $this->pageTitle;
        }

        if($title === null) {
            $return = $this->config['tags']['title'];
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