<?php

namespace App\Http\Controllers\manage;

use App\Opportunity;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Excel;
use PDF;


class ReportsController extends ManageController
{
    function index()
    {
        $this->data['page_title'] = trans("main.link_reports");
        $this->data['page_header'] = trans("main.link_reports");
        return view("manage.reports.index", $this->data);

    }

    function products(Request $request)
    {
        $this->data['page_title'] = trans("reports.page_title");
        $this->data['page_header'] = trans("reports.page_header");
        $products = Product::latest()->paginate(20);
        $this->data['data'] = $products;
        if ($request->input('export')) {
            return $this->exportData($request->input('export'), "manage.reports.exportProducts");
        }
        return view("manage.reports.products", $this->data);
    }

    function opportunities(Request $request)
    {
        $this->data['page_title'] = trans("reports.page_title");
        $this->data['page_header'] = trans("reports.page_header");
        $opportunities = Opportunity::latest()->paginate(20);
        $this->data['data'] = $opportunities;
        if ($request->input('export')) {
            return $this->exportData($request->input('export'), "manage.reports.exportOpportunities");
        }
        return view("manage.reports.opportunities", $this->data);
    }

    function productOpportunities(Request $request, $id = 0)
    {


        $product = $products = Product::find($id);

        if (!$product)
            return redirect()->back()->withErrors(trans("opportunities.error_id_not_found"));

        $this->data['page_title'] = trans("reports.page_title");
        $this->data['page_header'] = trans("reports.title_product_opportunities");
        $opportunities = $product->validOpportunities()->paginate(20);

        $this->data['data'] = $opportunities;
        $this->data['product'] = $product;
        if ($request->input('export')) {
            return $this->exportData($request->input('export'), "manage.reports.exportProductsOpportunities");
        }
        return view("manage.reports.productOpportunities", $this->data);
    }

    function distributors(Request $request)
    {


        $users = User::where("permission", ">", 1)->orderBy("name", "desc")->paginate(15);

        if (!$users)
            return redirect()->back()->withErrors(trans("users.error_id_not_found"));

        $this->data['page_title'] = trans("reports.page_title");
        $this->data['page_header'] = trans("reports.title_product_opportunities");


        $this->data['data'] = $users;

        if ($request->input('export')) {
            return $this->exportData($request->input('export'), "manage.reports.exportProductsOpportunities");
        }
        return view("manage.reports.distributors", $this->data);
    }

    function distributorOpportunities(Request $request, $id = 0)
    {


        $user = User::find($id);

        if (!$user)
            return redirect()->back()->withErrors(trans("users.error_id_not_found"));

        $this->data['page_title'] = trans("reports.page_title");
        $this->data['page_header'] = trans("reports.title_distributor_opportunities");
        $opportunities = $user->opportunities()->paginate(20);

        $this->data['data'] = $opportunities;
        $this->data['distributor'] = $user;
        if ($request->input('export')) {
            return $this->exportData($request->input("export"), "manage.reports.exportDistributorsOpportunities");
        }
        return view("manage.reports.distributorsOpportunities", $this->data);
    }

    private function exportData($type = 'print', $view = null)
    {
        switch ($type) {
            case "print":
                return view($view, $this->data);
                break;
            case "excel":
                Excel::create($this->data['page_header'], function ($excel) use ($view) {

                    $excel->setTitle('sheet1');
                    $excel->sheet('sheet1', function ($sheet) use ($view) {

                        $sheet->loadView($view, $this->data);
                    });

                })->export('xls');

                break;
            case "pdf":
                $pdf = PDF::loadView($view, $this->data);
                return $pdf->download($this->data['page_header'] . ".pdf");

                break;
        }
    }

}
