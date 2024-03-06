<?php

namespace App\Http\Controllers\backend;

use App\Category;
use App\Events\UserLogs;
use Validator;
use Illuminate\Http\Request;
use TCG\Voyager\Facades\Voyager;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(!Voyager::can('browse_categories'))
            return redirect()->back()->with(['message'=>__('messages.permissions.access'),'alert_danger'=>'info']);

        $this->data['categories'] = Category::all();
        return view('categories.index',$this->data);
    }

    /**
     * Display a listing of products.
     *
     * @return \Illuminate\Http\Response
     */
    public function products($id = 0)
    {
         if(!Voyager::can('show_products'))
            return redirect()->back()->with(['message'=>__('messages.permissions.access'),'alert_danger'=>'info']);

        $category = Category::find($id);
        if (!$category) {
            // flash(trans("categories.products_not_found"), 'danger');

            return redirect()->back();
        }

        $this->data['page_title'] = trans("categories.backend_page_title");
        $this->data['page_header'] = trans("categories.backend_page_create_header");
        $this->data['data'] = $category->products()->get();
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


        if(!Voyager::can('add_categories'))
            return redirect()->back()->with(['message'=>__('messages.permissions.access'),'alert_danger'=>'info']);

        $slug = str_slug($request->name);
        if (Category::where('slug', '=', str_slug($request->name))->exists()) {
            $slug = str_slug($request->name)."-".rand(1, 99);
   
           }

        $this->validate($request,[
           'name'=>'required|string|min:1|max:50',
        ]);

        $category = Category::create([
            'name'=>$request->name,
            'parent_id'=>$request->parent_id,
            'slug'=> $slug,
            'order'=>1,
        ]);

           $logs =[
            'action' => 'create_category',
            'notes' => 'user_create_category', 
            'attrs' => [
                'category' => $category->id
             ],

        ];
        event(new UserLogs($logs));

       //UserLogs::all();  get all users activities
       

        return redirect()->back()->with(['message'=> __('messages.categories.create')]);
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
    public function edit($id = 0)
    {

        if(!Voyager::can('edit_categories'))
            return redirect()->back()->with(['message'=>__('messages.permissions.access'),'alert_danger'=>'info']);

        $category = Category::find($id);
        // if (!$category) {
        //     flash(trans("categories.id_not_found"), 'danger');

        //     return redirect()->back();
        // }

        $this->data['page_title'] = trans("categories.backend_page_title");
        $this->data['page_header'] = trans("categories.backend_page_create_header");
         $this->data['categories'] = Category::all();
        $this->data['data'] = $category;

        return view("categories.partials.edit", $this->data);
    }


    public function ajax_edit($id = 0)
    {

        if(!Voyager::can('edit_categories'))
            return redirect()->back()->with(['message'=>__('messages.permissions.access'),'alert_danger'=>'info']);
        $category = Category::find($id);
        $this->data['categories'] = Category::all();
        $this->data['data'] = $category;

        return view("categories.partials.edit", $this->data);
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
        $category = Category::find($id);
        if (!$category) {
            return redirect()->back()->with(['message' => trans("categories.id_not_found"), 'alert-type' => 'error']);
        }

         $this->validate($request,[
           'name'=>'required|string|min:1|max:50',
        ]);



        $category->name = $request->input('name');
        $category->parent_id = $request->input('parent_id');
        $category->slug = str_slug($request->input('name'));
        $category->save();

        $logs =[
            'action' => 'update_category',
            'notes' => 'user_update_category',
            'attrs' => [
                'category' => $category->id
            ],

        ];
        event(new UserLogs($logs));


      
        return redirect()->back()->with(['message' => __('messages.categories.update'), 'alert-type' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Voyager::can('delete_categories'))
            return redirect()->back()->with(['message'=>__('messages.permissions.access'),'alert_danger'=>'info']);

        Category::findOrFail($id)->delete();


        $logs =[
            'action' => 'delete_category',
            'notes' => 'user_delete_category',
            'attrs' => [
                'category' => $id
            ],

        ];
        event(new UserLogs($logs));

        return redirect()->back()->with(['message'=>__('messages.categories.delete')]);
    }
}
