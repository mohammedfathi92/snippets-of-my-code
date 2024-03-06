<?php

namespace Modules\Components\LMS\Contracts;

/**
 * SEOTools.
 *
 * @author `Vinicius Reis`
 */
interface SEOTools
{
    /**
     * @return \Modules\Components\LMS\Contracts\MetaTags
     */
    public function metatags();

    /**
     * @return \Modules\Components\LMS\Contracts\OpenGraph
     */
    public function opengraph();

    /**
     * @return \Modules\Components\LMS\Contracts\TwitterCards
     */
    public function twitter();

    /**
     * Setup title for all seo providers.
     *
     * @param string $title
     *
     * @return \Modules\Components\LMS\Contracts\SEOTools
     */
    public function setTitle($title);

    /**
     * Setup description for all seo providers.
     *
     * @param string $description
     *
     * @return \Modules\Components\LMS\Contracts\SEOTools
     */
    public function setDescription($description);

    /**
     * Sets the canonical URL.
     *
     * @param string $url
     *
     * @return \Modules\Components\LMS\Contracts\SEOTools
     */
    public function setCanonical($url);

    /**
     * Add one or more images urls.
     *
     * @param array|string $urls
     *
     * @return \Modules\Components\LMS\Contracts\SEOTools
     */
    public function addImages($urls);

    /**
     * Get current title from metatags.
     *
     * @param bool $session
     *
     * @return string
     */
    public function getTitle($session = false);

    /**
     * Generate from all seo providers.
     * 
     * @param bool $minify
     *
     * @return string
     */
    public function generate($minify = false);
}
