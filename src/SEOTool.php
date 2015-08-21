<?php
namespace WuifDesign\SEO;

class SEOTool
{
    /**
     * Prefixes to be included to the html tag
     *
     * @var array
     */
    protected $prefixes = array(
        'og'      => 'og: http://ogp.me/ns#',
        'fb'      => 'fb: http://ogp.me/ns/fb#',
        'music'   => 'music: http://ogp.me/ns/music#',
        'video'   => 'video: http://ogp.me/ns/video#',
        'article' => 'article: http://ogp.me/ns/article#',
        'book'    => 'book: http://ogp.me/ns/book#',
        'website' => 'profile: http://ogp.me/ns/website#',
    );

    /**
     * @return MetaTags
     */
    public function metatags()
    {
        return app('metaTags');
    }

    /**
     * @return OpenGraph
     */
    public function opengraph()
    {
        return app('openGraph');
    }

    /**
     * @return TwitterCard
     */
    public function twitter()
    {
        return app('twitterCard');
    }

    /**
     * Setup title for all seo providers
     *
     * @param string $title
     *
     * @return SEOTool
     */
    public function setTitle($title)
    {
        $this->metatags()->setTitle($title);
        $this->opengraph()->setTitle($title);
        $this->twitter()->setTitle($title);
        return $this;
    }

    /**
     * Setup description for all seo providers
     *
     * @param $description
     *
     * @return SEOTool
     */
    public function setDescription($description)
    {
        $this->metatags()->setDescription($description);
        $this->opengraph()->setDescription($description);
        $this->twitter()->setDescription($description);
        return $this;
    }

    /**
     * @param string $url
     *
     * @return SEOTool
     */
    public function addImage($url)
    {
        $this->opengraph()->addImage($url);
        $this->twitter()->addImage($url);
        return $this;
    }

    /**
     * Generate from all seo providers
     *
     * @return string
     */
    public function render()
    {
        $html = $this->metatags()->render();
        if(app('config')['seo.opengraph.enabled']) {
            $html .= PHP_EOL . PHP_EOL . $this->opengraph()->render();
        }
        if(app('config')['seo.twitter.enabled']) {
            $html .= PHP_EOL . PHP_EOL . $this->twitter()->render();
        }
        return $html;
    }

    /**
     * Generate from all seo providers
     *
     * @return string
     */
    public function renderPrefixes()
    {
        $return = array();
        foreach(app('config')['seo.used_prefixes'] as $prefix) {
            if(isset($this->prefixes[$prefix])) {
                $return[] = $this->prefixes[$prefix];
            }
        }
        return implode(' ', $return);
    }

    /**
     * Renders the schema for the given key
     *
     * @param $key
     * @return string
     */
    public function renderSchema($key)
    {
        return app('schema')->renderSchema($key);
    }
}