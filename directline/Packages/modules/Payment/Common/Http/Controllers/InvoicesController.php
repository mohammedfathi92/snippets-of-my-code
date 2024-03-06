<?php

namespace Packages\Modules\Payment\Common\Http\Controllers;

use Packages\Foundation\Http\Controllers\BaseController;
use Packages\Modules\Payment\DataTables\InvoicesDataTable;
use Packages\Modules\Payment\DataTables\MyInvoicesDataTable;
use Packages\Modules\Payment\Http\Requests\InvoiceRequest;
use Packages\Modules\Payment\Models\Invoice;
use Illuminate\Http\Request;

class InvoicesController extends BaseController
{
    public function __construct()
    {
        $this->resource_url = config('payment_common.models.invoice.resource_url');
        $this->title = 'Payment::module.invoice.title';
        $this->title_singular = 'Payment::module.invoice.title_singular';

        parent::__construct();
    }

    /**
     * @param InvoiceRequest $request
     * @param InvoicesDataTable $dataTable
     * @return mixed
     */
    public function index(InvoiceRequest $request, InvoicesDataTable $dataTable)
    {
        return $dataTable->render('Payment::invoices.index');
    }

    /**
     * @param InvoiceRequest $request
     * @param Invoice $invoice
     * @return $this
     */
    public function edit(InvoiceRequest $request, Invoice $invoice)
    {
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.update_title', ['title' => $invoice->code])]);

        return view('Payment::invoices.create_edit')->with(compact('invoice'));
    }

    /**
     * @param InvoiceRequest $request
     * @param Invoice $invoice
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(InvoiceRequest $request, Invoice $invoice)
    {
        try {
            $data = $request->all();
            $invoice->update($data);
            flash(trans('Packages::messages.success.updated', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Invoice::class, 'update');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param InvoiceRequest $request
     * @param Invoice $invoice
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(InvoiceRequest $request)
    {
        try {
            $data = $request->except('invoicable_resource_url','invoicable_hashed_id');
            Invoice::create($data);
            flash(trans('Packages::messages.success.created', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Invoice::class, 'create');
        }
        if ($request->input('invoicable_resource_url')) {
            return redirectTo(url($request->input('invoicable_resource_url') . '/' . $request->input('invoicable_hashed_id')));
        } else {
            return redirectTo($this->resource_url);

        }
    }

    public function myInvoices(Request $request, MyInvoicesDataTable $dataTable)
    {
        return $dataTable->renderAjaxAndActions();
    }

    public function download(InvoiceRequest $request, Invoice $invoice)
    {
        $pdf = \PDF::loadView('Payment::invoices.invoice', ['invoice' => $invoice]);
        return $pdf->download("invoice_{$invoice->code}.pdf");
    }
}