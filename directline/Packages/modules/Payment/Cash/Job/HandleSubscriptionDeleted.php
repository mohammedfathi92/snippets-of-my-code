<?php

namespace Packages\Modules\Payment\Cash\Job;


use Carbon\Carbon;
use Packages\Modules\Payment\Cash\Exception\CashWebhookFailed;
use Packages\Modules\Payment\Models\Invoice;
use Packages\Modules\Payment\Payment;
use Packages\Modules\Subscriptions\Models\Subscription;
use Packages\Modules\Payment\Models\WebhookCall;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;

class HandleSubscriptionDeleted implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var \Packages\Modules\Payment\Models\WebhookCall
     */
    public $webhookCall;

    /**
     * HandleInvoiceCreated constructor.
     * @param WebhookCall $webhookCall
     */
    public function __construct(WebhookCall $webhookCall)
    {
        $this->webhookCall = $webhookCall;
    }


    public function handle()
    {
        logger('Invoice Created job, webhook_call: ' . $this->webhookCall->id);

        try {

            if ($this->webhookCall->processed) {
                throw CashWebhookFailed::processedCall($this->webhookCall);
            }

            $payload = $this->webhookCall->payload;
            if ($payload) {

                $subscription_reference = $payload['id'];
                $subscription = Subscription::where('subscription_reference', $subscription_reference)->first();

                if (!$subscription) {
                    throw CashWebhookFailed::invalidCashSubscription($this->webhookCall);
                }
                \Actions::do_action('pre_webhook_cancel_subscription', $subscription);

                $subscription->setStatus('canceled');
                $subscription->markAsCancelled();


                $this->webhookCall->markAsProcessed();
            } else {
                throw CashWebhookFailed::invalidCashPayload($this->webhookCall);
            }
        } catch (\Exception $exception) {
            log_exception($exception);
            $this->webhookCall->saveException($exception);
        }
    }
}