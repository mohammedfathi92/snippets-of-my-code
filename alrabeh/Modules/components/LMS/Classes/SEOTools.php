<?php

namespace Modules\Components\LMS\Classes;

use Modules\Components\LMS\Contracts\MetaTags;
use Modules\Components\LMS\Contracts\SEOTools as SEOContract;

class SEOTools implements SEOContract
{
    /**
     * @return MetaTags|\Illuminate\Foundation\Application|mixed
     */
    public function metatags()
    {
        return app('seotools.metatags');
    }

    /**
     * @return \Modules\Components\LMS\Contracts\OpenGraph
     */
    public function opengraph()
    {
        return app('seotools.opengraph');
    }

    /**
     * @return \Modules\Components\LMS\Contracts\TwitterCards
     */
    public function twitter()
    {
        return app('seotools.twitter');
    }

    /**
     * Setup title for all seo providers.
     *
     * @param string $title
     *
     * @return \Modules\Components\LMS\Contracts\SEOTools
     */
    public function setTitle($title)
    {
        $this->metatags()->setTitle($title);
        $this->opengraph()->setTitle($title);
        $this->twitter()->setTitle($title);

        return $this;
    }

    /**
     * Setup description for all seo providers.
     *
     * @param $description
     *
     * @return \Modules\Components\LMS\Contracts\SEOTools
     */
    public function setDescription($description)
    {
        $this->metatags()->setDescription($description);
        $this->opengraph()->setDescription($description);
        $this->twitter()->setDescription($description);

        return $this;
    }

    /**
     * Setup keywords for all seo providers.
     *
     * @param $keywords
     *
     * @return \Modules\Components\LMS\Contracts\SEOTools
     */
    public function setKeywords($keywords)
    {
        $this->metatags()->setKeywords($keywords);
        
        return $this;
    }

    /**
     * Sets the canonical URL.
     *
     * @param string $url
     *
     * @return \Modules\Components\LMS\Contracts\SEOTools
     */
    public function setCanonical($url)
    {
        $this->metatags()->setCanonical($url);

        return $this;
    }

    /**
     * @param array|string $urls
     *
     * @return \Modules\Components\LMS\Contracts\SEOTools
     */
    public function addImages($urls)
    {
        if (is_array($urls)) {
            $this->opengraph()->addImages($urls);
        } else {
            $this->opengraph()->addImage($urls);
        }

        $this->twitter()->addImage($urls);

        return $this;
    }

    /**
     * Get current title from metatags.
     *
     * @param bool $session
     *
     * @return string
     */
    public function getTitle($session = false)
    {
        if ($session) {
            return $this->metatags()->getTitleSession();
        }

        return $this->metatags()->getTitle();
    }

    /**
     * Generate from all seo providers.
     *
     * @param bool $minify
     *
     * @return string
     */
    public function generate($minify = false)
    {
        $html = $this->metatags()->generate();
        $html .= PHP_EOL;
        $html .= $this->opengraph()->generate();
        $html .= PHP_EOL;
        $html .= $this->twitter()->generate();

        return ($minify) ? str_replace(PHP_EOL, '', $html) : $html;
    }
}
