<?php

namespace Modules\Components\CMS\Contracts;

/**
 * SEOTools.
 *
 * @author `Vinicius Reis`
 */
interface SEOTools
{
    /**
     * @return \Modules\Components\CMS\Contracts\MetaTags
     */
    public function metatags();

    /**
     * @return \Modules\Components\CMS\Contracts\OpenGraph
     */
    public function opengraph();

    /**
     * @return \Modules\Components\CMS\Contracts\TwitterCards
     */
    public function twitter();

    /**
     * Setup title for all seo providers.
     *
     * @param string $title
     *
     * @return \Modules\Components\CMS\Contracts\SEOTools
     */
    public function setTitle($title);

    /**
     * Setup description for all seo providers.
     *
     * @param string $description
     *
     * @return \Modules\Components\CMS\Contracts\SEOTools
     */
    public function setDescription($description);

    /**
     * Sets the canonical URL.
     *
     * @param string $url
     *
     * @return \Modules\Components\CMS\Contracts\SEOTools
     */
    public function setCanonical($url);

    /**
     * Add one or more images urls.
     *
     * @param array|string $urls
     *
     * @return \Modules\Components\CMS\Contracts\SEOTools
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
