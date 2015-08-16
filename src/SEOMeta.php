<?php
namespace WuifDesign\SEO;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Log;

class SEOMeta
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
     * Array to default config settings
     *
     * @var array
     */
    protected $config;

    /**
     * @var string
     */
    protected $title = null;

    /**
     * @var string
     */
    protected $description = null;

    /**
     * @var string
     */
    protected $keywords = null;

    /**
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->logging = $this->app['config']['wuifdesign-seo.enable_logging'];
        $this->config = $this->app['config']['wuifdesign-seo.meta'];
    }

    /**
     * Renders all meta tags
     *
     * @return string
     */
    public function render()
    {
        $return =  $this->getTitle();
        $return .= $this->getDescription();
        $return .= $this->getKeywords();
        return $return;
    }

    /**
     * Set the keywords
     *
     * @param array $keywords
     * @param bool|false $append Append to the default keywords
     */
    public function setKeywords($keywords, $append = false)
    {
        if($append) {
            $this->keywords = array_merge($this->config['keywords'], $keywords);
        } else {
            $this->keywords = $keywords;
        }
    }

    /**
     * Get keywords meta tag
     *
     * @return string
     */
    public function getKeywords()
    {
        $keywords = $this->keywords;
        if($this->keywords === null) {
            $keywords = $this->config['keywords'];
        }

        if($this->logging && count($keywords) > 10) {
            Log::notice('Too many keywords - '.count($keywords).' keywords - use less than 10 keywords');
        }

        if(count($keywords)) {
            return '<meta name="keywords" content="'.implode(', ', $keywords).'">'.PHP_EOL;
        }
        return '';
    }

    /**
     * Set the title
     *
     * @param string $title

     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Get title meta tag
     *
     * @param string $styling Styling of the title
     * @return string
     */
    public function getTitle($styling = null)
    {
        if($styling === null) {
            $styling = $this->config['title_styling'];
        }
        if($this->title === null) {
            $title = $this->config['title'];
        } else {
            $title = str_replace(
                array('%title%', '%subtitle%'),
                array($this->config['title'], $this->title),
                $styling
            );
        }
        if($title != '') {
            return '<title>'.$title.'</title>'.PHP_EOL;
        }
        return '';
    }

    /**
     * Set the title
     *
     * @param string $description

     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get title meta tag
     *
     * @param string $styling Styling of the title
     * @return string
     */
    public function getDescription()
    {
        $description = $this->description;
        if($description === null) {
            $description = $this->config['description'];
        }

        if($this->logging) {
            if(strlen($description) > 160) {
                Log::notice('Meta Description too long - '.strlen($description).' characters - use less than 160 characters');
            }
            if(strlen($description) < 120) {
                Log::notice('Meta Description too short - '.strlen($description).' characters - try to use between 150-160 characters');
            }
        }
        if($description != '') {
            return '<meta name="description" content="'.$description.'">'.PHP_EOL;
        }
        return '';
    }
}