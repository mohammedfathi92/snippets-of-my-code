<?php

namespace Modules\Components\LMS\Http\Controllers;

use Modules\Foundation\Http\Controllers\BaseController;
use Modules\Components\LMS\DataTables\CertificatesDataTable;
use Modules\Components\LMS\Http\Requests\CertificateRequest;
use Modules\Components\LMS\Models\Certificate;
use Modules\Components\LMS\Models\Tag;

class CertificatesController extends BaseController
{
    public function __construct()
    {
        $this->resource_url = config('lms.models.certificate.resource_url');
        $this->title = 'LMS::module.certificate.title';
        $this->title_singular = 'LMS::module.certificate.title_singular';

        parent::__construct();
    }

    /**
     * @param CertificateRequest $request
     * @param CertificatesDataTable $dataTable
     * @return mixed
     */
    public function index(CertificateRequest $request, CertificatesDataTable $dataTable)
    {
        return $dataTable->render('LMS::certificates.index');
    }

    /**
     * @param CertificateRequest $request
     * @return $this
     */
    public function create(CertificateRequest $request)
    {
        $certificate = new Certificate();

        $this->setViewSharedData(['title_singular' => trans('Modules::labels.create_title', ['title' => $this->title_singular])]);

        return view('LMS::certificates.create_edit')->with(compact('certificate'));
    }

    /**
     * @param CertificateRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CertificateRequest $request)
    {
        try {


            $data = $request->except(['image', 'seal', 'signature', 'site_logo']);

            // $data['author_id'] = user()->id;

            $certificate = Certificate::create($data);

             if ($request->hasFile('site_logo')) {
                $certificate->addMedia($request->file('site_logo'))
                    ->withCustomProperties(['root' => 'user_' . user()->hashed_id])
                    ->toMediaCollection('lms-certificate-site_logo');
                   }

           if ($request->hasFile('image')) {
                $certificate->addMedia($request->file('image'))
                    ->withCustomProperties(['root' => 'user_' . user()->hashed_id])
                    ->toMediaCollection('lms-certificate-image');
                   }

            if ($request->hasFile('seal')) {
                $certificate->addMedia($request->file('seal'))
                    ->withCustomProperties(['root' => 'user_' . user()->hashed_id])
                    ->toMediaCollection('lms-certificate-seal');
                   } 

           if ($request->hasFile('signature')) {
                $certificate->addMedia($request->file('signature'))
                    ->withCustomProperties(['root' => 'user_' . user()->hashed_id])
                    ->toMediaCollection('lms-certificate-signature');
                   }             


            flash(trans('Modules::messages.success.created', ['item' => $this->title_singular]))->success();
        return redirectTo($this->resource_url.'/'.$certificate->hashed_id.'/show');
        } catch (\Exception $exception) {
            log_exception($exception, Certificate::class, 'created');
        }

        return redirectTo($this->resource_url);
    }

    // /**
    //  * @param CertificateRequest $request
    //  * @param Certificate $certificate
    //  * @return $this
    //  */
    // public function show(CertificateRequest $request, Certificate $certificate)
    // {
    //     return redirect('admin-preview/' . $certificate->slug);
    // }


        /**
     * @param CertificateRequest $request
     * @param Certificate $certificate
     * @return $this
     */
    public function show($hashed_id)
    {

        $id = hashids_decode($hashed_id);

        $certificate = Certificate::find($id);
        
        $this->setViewSharedData(['title_singular' => trans('Modules::labels.show_title', ['title' => $certificate->title])]);

        return view('LMS::certificates.show')->with(compact('certificate'));
    }


    /**
     * @param CertificateRequest $request
     * @param Certificate $certificate
     * @return $this
     */
    public function edit(CertificateRequest $request, Certificate $certificate)
    {
        $this->setViewSharedData(['title_singular' => trans('Modules::labels.update_title', ['title' => $certificate->title])]);

        return view('LMS::certificates.create_edit')->with(compact('certificate'));
    }

    /**
     * @param CertificateRequest $request
     * @param Certificate $certificate
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(CertificateRequest $request, Certificate $certificate)
    {
        try {

      

          $data = $request->except(['image', 'clear_image','seal','clear_seal', 'signature', 'clear_signature', 'site_logo', 'clear_site_logo']);

            // $data['author_id'] = user()->id;
            $certificate->update($data);

            

            if ($request->has('clear_site_logo') || $request->hasFile('site_logo')) {
                $certificate->clearMediaCollection('lms-certificate-site_logo');
            }

           if ($request->hasFile('site_logo')) {
                $certificate->addMedia($request->file('site_logo'))
                    ->withCustomProperties(['root' => 'user_' . user()->hashed_id])
                    ->toMediaCollection('lms-certificate-site_logo');
                   }

            if ($request->has('clear_image') || $request->hasFile('image')) {
                $certificate->clearMediaCollection('lms-certificate-image');
            }

           if ($request->hasFile('image')) {
                $certificate->addMedia($request->file('image'))
                    ->withCustomProperties(['root' => 'user_' . user()->hashed_id])
                    ->toMediaCollection('lms-certificate-image');
                   }

        if ($request->has('clear_seal') || $request->hasFile('seal')) {
                $certificate->clearMediaCollection('lms-certificate-seal');
            }

           if ($request->hasFile('seal')) {
                $certificate->addMedia($request->file('seal'))
                    ->withCustomProperties(['root' => 'user_' . user()->hashed_id])
                    ->toMediaCollection('lms-certificate-seal');
                   }
        
        if ($request->has('clear_signature') || $request->hasFile('signature')) {
                $certificate->clearMediaCollection('lms-certificate-signature');
            }

           if ($request->hasFile('signature')) {
                $certificate->addMedia($request->file('signature'))
                    ->withCustomProperties(['root' => 'user_' . user()->hashed_id])
                    ->toMediaCollection('lms-certificate-signature');
                   } 


         

            flash(trans('Modules::messages.success.updated', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Certificate::class, 'update');
        }

         return redirectTo($this->resource_url.'/'.$certificate->hashed_id.'/show');

    }




    /**
     * @param CertificateRequest $request
     * @param Certificate $certificate
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(CertificateRequest $request, Certificate $certificate)
    {
        try {
            $certificate->clearMediaCollection('lms-certificate-featured-image');
            $certificate->delete();

            $message = ['level' => 'success', 'message' => trans('Modules::messages.success.deleted', ['item' => $this->title_singular])];
        } catch (\Exception $exception) {
            log_exception($exception, Certificate::class, 'destroy');
            $message = ['level' => 'error', 'message' => $exception->getMessage()];
        }

        return response()->json($message);
    }
}