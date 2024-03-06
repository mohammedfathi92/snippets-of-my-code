<?php

namespace App\Mail;

use App\Action;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MesurReportCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $report;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($report)
    {
        $this->report = $report;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $reportActions = $this->report->actions ? collect(json_decode($this->report->actions, true)) : null;
        $actions = Action::whereIn("id", $reportActions->pluck('type'))->get();
        return $this->view('emails.manager_Mesur_report')->with(['report' => $this->report, 'actions' => $actions]);
    }
}
