<?php

namespace Modules\Components\LMS\Observers;

use Modules\Components\LMS\Models\Certificate;

class CertificateObserver
{

    /**
     * @param Certificate $certificate
     */
    public function created(Certificate $certificate)
    {
    }
}