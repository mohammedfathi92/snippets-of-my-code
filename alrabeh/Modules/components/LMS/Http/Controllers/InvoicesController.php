<?php

namespace Modules\Components\LMS\Http\Controllers;

use Modules\Foundation\Http\Controllers\BaseController;
use Modules\Components\LMS\DataTables\InvoicesDataTable;
use Modules\Components\LMS\Http\Requests\InvoiceRequest;
use Modules\Components\LMS\Models\Invoice;
use Illuminate\Http\Request;

class InvoicesController extends BaseController
{
    public function __construct()
    {
        $this->resource_url = config('lms.models.invoice.resource_url');
        $this->title = 'LMS::module.invoice.title';
        $this->title_singular = 'LMS::module.invoice.title_singular';

        parent::__construct();
    }

    /**
     * @param InvoiceRequest $request
     * @param InvoicesDataTable $dataTable
     * @return mixed
     */
    public function index(InvoiceRequest $request, InvoicesDataTable $dataTable)
    {
        return $dataTable->render('LMS::invoices.index');
    }

    /**
     * @param InvoiceRequest $request
     * @return $this
     */
    public function create(InvoiceRequest $request)
    {
        $invoice = new Invoice();

        $session_id = \LMS::codeGenerator(5, true ,'invoice_',user()->hashed_id);



        $this->setViewSharedData(['title_singular' => trans('Modules::labels.create_title', ['title' => $this->title_singular])]);

        return view('LMS::invoices.create_edit')->with(compact('invoice', 'session_id'));
    }


        /**
     * @param InvoiceRequest $request
     * @return $this
     */
    public function change_status(InvoiceRequest $request, Invoice $invoice)
    {

        $this->setViewSharedData(['title_singular' => trans('Modules::labels.create_title', ['title' => $this->title_singular])]);

        return view('LMS::invoices.partials.change_status')->with(compact('invoice'));
    }

    /**
     * @param InvoiceRequest $request
     * @return $this
     */
    public function update_status(Request $request, $hashed_id)
    {
         if (!user()->hasPermissionTo('LMS::invoice.update')) {
            abort(404);
        }

        $this->validate($request, ['status' => 'required']);

        try {
        $data = $request->all();
        $id = hashids_decode($hashed_id);

        $invoice = Invoice::find($id);

        $invoice->update([
                'status' => $data['status'],
               
            ]);

        $invoiceItems = $invoice->invoicables()->get();
if($invoiceItems){
   foreach ($invoiceItems as $item) {
    if($data['status'] == 'paid'){
            $paid = $item->price;
        }else{
            $paid = 0.00;
        }
      $item->update([
        'paid' => $paid,
          
            ]);
   }

   }

        $invoice->subscriptions()->update([
            'status' => ($data['status'] == 'paid')?1:0,
        ]);


     flash(trans('Modules::messages.success.updated', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Order::class, 'update');
        }

                return redirectTo($this->resource_url);

    }

    /**
     * @param InvoiceRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(InvoiceRequest $request)
    {
        try {

            $data = $request->except(['thumbnail', 'plan', 'course', 'quiz']);
            $invoice = Invoice::create($data);
            if ($request->hasFile('thumbnail')) {
                $course->addMedia($request->file('thumbnail'))
                    ->withCustomProperties(['root' => 'user_' . user()->hashed_id])
                    ->toMediaCollection($invoice->mediaCollectionName);
                   }

            $invoice->categories()->sync($request->input('categories', []));
            $invoice->courses()->sync($request->input('courses', []));
            $invoice->quizzes()->sync($request->input('quizzes', []));

            $tags = $this->getTags($request);

            $invoice->tags()->sync($tags);


            flash(trans('Modules::messages.success.created', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Invoice::class, 'created');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param InvoiceRequest $request
     * @param Invoice $invoice
     * @return $this
     */
    public function show(InvoiceRequest $request, Invoice $invoice)
    {
        return redirect('admin-preview/' . $invoice->slug);
    }


    /**
     * @param InvoiceRequest $request
     * @param Invoice $invoice
     * @return $this
     */
    public function edit(InvoiceRequest $request, Invoice $invoice)
    {
        $this->setViewSharedData(['title_singular' => trans('Modules::labels.update_title', ['title' => $invoice->title])]);

        return view('LMS::invoices.create_edit')->with(compact('invoice'));
    }

    /**
     * @param InvoiceRequest $request
     * @param Invoice $invoice
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(InvoiceRequest $request, Invoice $invoice)
    {
        try {
        $data = $request->except(['thumbnail', 'plan', 'course', 'quiz', 'clear']);

            // $data['author_id'] = user()->id;
            $invoice->update($data);

           if ($request->has('clear') || $request->hasFile('thumbnail')) {
                $invoice->clearMediaCollection('thumbnail');
            }

           if ($request->hasFile('thumbnail')) {
                $invoice->addMedia($request->file('thumbnail'))
                    ->withCustomProperties(['root' => 'user_' . user()->hashed_id])
                    ->toMediaCollection($invoice->mediaCollectionName);
                   }

           $invoice->categories()->sync($request->input('categories', []));
            $invoice->courses()->sync($request->input('courses', []));
            $invoice->quizzes()->sync($request->input('quizzes', []));

            $tags = $this->getTags($request);

            $invoice->tags()->sync($tags);

            flash(trans('Modules::messages.success.updated', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Invoice::class, 'update');
        }

        return redirectTo($this->resource_url);
    }


      private function getTags($request)
    {
        $tags = [];

        $requestTags = $request->get('tags', []);

        foreach ($requestTags as $tag) {
            if (is_numeric($tag)) {
                array_push($tags, $tag);
            } else {
                try {
                    $newTag = Tag::create([
                        'name' => $tag,
                        'slug' => str_slug($tag)
                    ]);

                    array_push($tags, $newTag->id);
                } catch (\Exception $exception) {
                    continue;
                }
            }
        }

        return $tags;
    }


    /**
     * @param InvoiceRequest $request
     * @param Invoice $invoice
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(InvoiceRequest $request, Invoice $invoice)
    {
        try {
            $invoice->clearMediaCollection('featured-image');
            $invoice->delete();

            $message = ['level' => 'success', 'message' => trans('Modules::messages.success.deleted', ['item' => $this->title_singular])];
        } catch (\Exception $exception) {
            log_exception($exception, Invoice::class, 'destroy');
            $message = ['level' => 'error', 'message' => $exception->getMessage()];
        }

        return response()->json($message);
    }
}