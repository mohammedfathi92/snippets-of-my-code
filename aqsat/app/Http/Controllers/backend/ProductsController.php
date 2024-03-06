<?php

namespace App\Http\Controllers\backend;

use App\Category;
use App\Events\UserLogs;
use App\Product;
use Illuminate\Http\Request;
use TCG\Voyager\Facades\Voyager;
use App\Http\Controllers\Controller;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(!Voyager::can('show_products'))
            return redirect()->back()->with(['message'=> __('messages.permissions.access'),'alert_danger'=>'info']);

        $this->data['data'] = Product::all();
        $this->data['categories'] = Category::all();
        return view('products.index',$this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if(!Voyager::can('create_products'))
            return redirect()->back()->with(['message'=>__('messages.permissions.access'),'alert_danger'=>'info']);

        $this->validate($request,[
            'name'=>'required|string|max:50',
            'category_id'=>'required',
        ]);

         $product = Product::create($request->all());

        $logs =[
            'action' => 'create_product',
            'notes' => 'user_create_product',
            'attrs' => [
                'product' => $product->id
            ],

        ];
        event(new UserLogs($logs));

        return redirect()->back()->with(['message'=>  __('messages.products.create')]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }


      public function ajax_edit($id = 0)
    {
        if(!Voyager::can('edit_products'))
            return redirect()->back()->with(['message'=>__('messages.permissions.access'),'alert_danger'=>'info']);

        $product = Product::find($id);
        $this->data['categories'] = Category::all();
        $this->data['data'] = $product;

        return view("products.partials.edit", $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Voyager::can('delete_products'))
            return redirect()->back()->with(['message'=>__('messages.permissions.access'),'alert_danger'=>'info']);

        Product::findOrFail($id)->delete($id);


        $logs =[
            'action' => 'delete_product',
            'notes' => 'user_delete_product',
            'attrs' => [
                'product' => $id
            ],

        ];
        event(new UserLogs($logs));

        return redirect()->back()->with(['message'=>  __('messages.products.delete')]);
    }
}
