<?php
namespace WuifDesign\SEO;

class SEOTool
{
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
        $html = $this->metatags()->render().PHP_EOL.PHP_EOL;
        $html .= $this->opengraph()->render().PHP_EOL.PHP_EOL;
        $html .= $this->twitter()->render();
        return $html;
    }
}