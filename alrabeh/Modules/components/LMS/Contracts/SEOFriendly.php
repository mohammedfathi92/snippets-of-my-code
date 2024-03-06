<?php

namespace Modules\Components\LMS\Contracts;

interface SEOFriendly
{
    /**
     * Performs SEO settings.
     *
     * @param SEOTools $SEOTools
     */
    public function loadSEO(SEOTools $SEOTools);
}
