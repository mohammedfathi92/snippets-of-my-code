<?php

namespace Modules\Components\LMS\Widgets;

use ConsoleTVs\Charts\Facades\Charts;

class CurrentVisitorCountWidget
{

    function __construct()
    {
    }

    function run($args)
    {
        try {
            $chart = Charts::realtime(url('lms/active-users'), 2000, 'gauge', 'justgage')
                ->values([0, 10, 100])
                ->labels(['First', 'Second', 'Third'])
                ->elementLabel(trans('LMS::labels.lms_widget.active'))
                ->interval(120000)
                ->title(trans('LMS::labels.lms_widget.current_visitors'))
                ->valueName('value'); //This determines the json index for the value
            return $chart->render();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

}