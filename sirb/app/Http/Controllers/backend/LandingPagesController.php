<?php

namespace Sirb\Http\Controllers\backend;

use Sirb\Category;
use Sirb\LandingPage;
use Sirb\LandingBlock;
use Sirb\BlockPart;
use Sirb\Media;
use URL;
use DB;
use Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Validator;
use Illuminate\Http\Request;

use Sirb\Http\Requests;
use Sirb\Http\Controllers\backend\BackendBaseController;

class LandingPagesController extends BackendBaseController
{
    function index()
    {

        if (!Auth::user()->can("show builder")) {

            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $this->data['page_title'] = trans("pages.backend_page_title");
        $this->data['page_header'] = trans("pages.backend_page_header");

        return view("backend.landing_pages.index", $this->data);
    }

    function create()
    {
        // if (!Auth::user()->can("create builder")) {
        //     return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        // }

        $this->data['page_title'] = trans("pages.backend_page_title");
        $this->data['page_header'] = trans("pages.backend_page_create_header");
        return view("backend.landing_pages.create", $this->data);
    }





    function store(Request $request)
    {
        if (!Auth::user()->can("create builder")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            $rules["name.$locale"] = "required|max:255";
            $rules["meta_keywords.$locale"] = "max:255";
            $rules["meta_description.$locale"] = "max:255";
            $messages["name.$locale.required"] = trans("pages.validation_name_locale_required", ['locale' => $properties['native']]);
        }
        $rules["slug"] = "required|max:255|unique:landing_pages,slug";
        $rules["menu_id"] = "required|integer";

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $page = new LandingPage();
        $page->slug = str_slug($request->input('slug')); 
        $page->menu_id = (int)$request->input('menu_id');
        // $page->footer_id = $request->input('footer_id'); 
        //$page->in_menu = (boolean)$request->input('in_menu');
        $page->status = (boolean)$request->input('status');

        if ($request->input('photo')) {
            $page->photo = $request->input('photo');
        }


        if ($page->save()) {

            foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
                $page->translateOrNew($locale)->name = $request->input('name.' . $locale);
                $page->translateOrNew($locale)->description = $request->input('description.' . $locale);
                $page->translateOrNew($locale)->meta_keywords = $request->input('meta_keywords.' . $locale);
                $page->translateOrNew($locale)->meta_description = $request->input('meta_description.' . $locale);
            }

            $page->save();

        }

       return redirect($this->data['backend_uri'] . "/landing-pages")->with(['message' => trans("pages.success_created"), 'alert-type' => 'success']);
        // return redirect()->back()->with(['message' => trans("pages.success_created"), 'alert-type' => 'success']);


    }





    function edit($id = 0)
    {
        if (!Auth::user()->can("edit builder")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $page = LandingPage::find($id);
        if (!$page) {
            flash(trans("pages.id_not_found"), 'danger');

            return redirect()->back();
        }

        $this->data['page_title'] = trans("pages.backend_page_title");
        $this->data['page_header'] = trans("pages.backend_page_create_header");
        $this->data['data'] = $page;

        return view("backend.landing_pages.edit", $this->data);
    }

    function update(Request $request, $id = 0)
    {
        if (!Auth::user()->can("edit builder")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $page = LandingPage::find($id);
        if (!$page) {

            return redirect()->back()->with(['message' => trans("pages.id_not_found"), 'alert-type' => 'error']);
        }

        foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            $rules["name.$locale"] = "required|max:255";
            $rules["meta_keywords.$locale"] = "max:255";
            $rules["meta_description.$locale"] = "max:255";
            $messages["name.$locale.required"] = trans("pages.validation_name_locale_required", ['locale' => $properties['native']]);
        }
        $rules["slug"] = "required|max:255|min:3|unique:pages,slug,{$id}";
        $rules["menu_id"] = "required|integer";

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        $page->slug = str_slug($request->input('slug'));
        $page->menu_id = (int)$request->input('menu_id');
        $page->status = (boolean)$request->input('status');
        $page->menu_id = $request->input('menu_id');
        // $page->footer_id = $request->input('footer_id'); 

        if ($request->input('photo')) {
            $page->photo = $request->input('photo');
        }


        if ($page->save()) {

            foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
                $page->translateOrNew($locale)->name = $request->input('name.' . $locale);
                $page->translateOrNew($locale)->description = $request->input('description.' . $locale);
                $page->translateOrNew($locale)->meta_keywords = $request->input('meta_keywords.' . $locale);
                $page->translateOrNew($locale)->meta_description = $request->input('meta_description.' . $locale);
            }

            $page->save();

        }

       return redirect($this->data['backend_uri'] . "/landing-pages")->with(['message' => trans("pages.success_updated"), 'alert-type' => 'success']);
        // return redirect()->back()->with(['message' => trans("pages.success_updated"), 'alert-type' => 'success']);


    }


function ajax_topics(Request $request, $country_id = 0, $city_id = 0, $type = null)
    {
           if($type == 'hotels'){
                       $items = \Sirb\Hotel::published();
               }elseif($type == 'places') {
                  $items = \Sirb\Place::published();
              
               }elseif($type == 'packages') {
                  $items = \Sirb\Package::published();
               }else{

                 $items = \Sirb\PackageType::published();
                   
               }

                if ($country_id != 0) {

                
                $items->whereHas("country", function($c) use ($country_id){
                            $c->whereId($country_id);
                        });

            // $items->where("country_id", $country_id);
                         

            }
            if($city_id != 0 && $type != 'packages' && $type != 'packagesType' && $type != 'articles'){
                $items->whereHas("city", function($t) use ($city_id){
                            $t->whereId($city_id);
                        });
               // $items->where("city_id", $city_id);
            }

            

            


           
            return response()->json(['success' => true, 'data' => $items->get()]);
    }

    function ajax_articles(Request $request, $country_id = 0, $cat_id = 0)
    {

        $items = \Sirb\Article::published();


                if ($country_id != 0) {

                
               $items->whereHas("category", function ($q) use ($country_id) {
                    $q->whereHas("country", function ($c) use ($country_id) {
                        $c->whereId($country_id);
                    });
                });

            // $items->where("country_id", $country_id);
                         

            }
            if($cat_id != 0){
                $items->whereHas("category", function($t) use ($cat_id){
                            $t->whereId($cat_id);
                        });
               // $items->where("city_id", $city_id);
            }


            


           
            return response()->json(['success' => true, 'data' => $items->get()]);
    }



    function delete(Request $request, $id = 0)
    {
        if (!Auth::user()->can("delete builder")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $page = LandingPage::find($id);
        if (!$page) {
            return redirect()->back()->with(['message' => trans("pages.id_not_found"), 'alert-type' => 'error']);
        }

        // get Page photos
        $defaultPhoto = $page->photo;
        $gallery = $page->gallery;

        if ($page->delete()) {
            $uploader = new UploaderController();
            $uploader->delete($defaultPhoto);
            // delete photos from storage and database
            if ($gallery) {

                foreach ($gallery as $file) {
                    $uploader->delete($file->name);
                }
            }

            return redirect()->back()->with(['message' => trans("pages.success_deleted"), 'alert-type' => 'success']);
        }
        return redirect()->back()->with(['message' => trans("pages.error_delete"), 'alert-type' => 'error']);

    }

    function multiDelete(Request $request)
    {
        if (!Auth::user()->can("delete builder")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        if ($request->input('items') && is_array($request->input('items'))) {
            $deleted = 0;
            foreach ($request->input('items') as $id) {
                $page = LandingPage::find($id);

                if ($page) {
                    $defaultPhoto = $page->photo;
                    $gallery = $page->gallery;

                    if ($page->delete()) {
                        $uploader = new UploaderController();
                        $uploader->delete($defaultPhoto);
                        // delete photos from storage and database
                        if ($gallery) {
                            foreach ($gallery as $file) {

                                $uploader->delete($file->name);
                            }
                        }
                    }

                    $deleted++;
                }
            }

            return redirect()->back()->with(["message" => trans("pages.success_multi_delete", ['count' => $deleted]), "alert-type" => "success"]);
        }

        return redirect()->back()->with(["message" => trans("pages.error_multi_delete_empty"), "alert-type" => "error"]);

    }


    function build($id = 0)
    {
        if (!Auth::user()->can("edit builder")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $page = LandingPage::findOrFail($id);
        if (!$page) {
            return redirect()->back()->with(['message' => 'Not found the page', 'alert-type' => 'error']);
        }


        $this->data['page_title']  = trans("pages.backend_page_title");
        $this->data['page_header'] = trans("pages.backend_page_header");
        $this->data['page'] = $page;


        return view("backend.landing_pages.show", $this->data);

    }

    function duplicate(Request $request)
    {
        if (!Auth::user()->can("create builder")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

       // dd($request->all());
$id = (int)$request->input("page_id");

 //duplicate page
  $page = LandingPage::find($id);

$newPage = $page->replicate();
$newPage->slug = $page->slug."_".$id.date('Y-m-d H:i:s').rand(10, 10000);
$newPage->save();

if($newPage->save()){

 foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
                $newPage->translateOrNew($locale)->name = $page->{"name:".$locale}."(copy)";
                $newPage->translateOrNew($locale)->description = $page->{"description:".$locale};
                $newPage->translateOrNew($locale)->meta_keywords = $page->{"meta_keywords:".$locale};
                $newPage->translateOrNew($locale)->meta_description = $page->{"meta_description:".$locale};
            }

            $newPage->save();
            }
        
    // duplicate blocks
      if($page->blocks()->count()){     
     foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
               
                  
    foreach($page->blocks()->where("lang", $locale)->get() as $b)
    {
       

       
        $block = LandingBlock::where('landing_blocks.id',$b->id)->where("lang", $locale)->first();
        $newBlock = $block->replicate();
        $newBlock->page_id = $newPage->id;
        $newBlock->lang = $locale;
        $newBlock->save();


          
     }
     } 
     } 

     foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {

     if ($newPage->blocks()->where('lang',$locale)->count() < 1) {
             $newPage->translateOrNew($locale)->lang_status = false;
             $newPage->save();   
          }else{
            $newPage->translateOrNew($locale)->lang_status = true;
             $newPage->save(); 
          }
      }

     return redirect()->back()->with(['message' => 'Successfully Created New Block', 'alert-type' => 'success']);


    }

    function page_color(Request $request, $id = 0, $color = null)
    {


        // if (!Auth::user()->can("edit builder")) {
        //     return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        // }

        $lang = $request->get('lang')?:"ar";

    

    
       $page = DB::table('landing_page_translations')->where("lang", $lang)->where('landing_page_id', $id);

        if (!$page) {
            return response()->json(['success' => false, 'msg' => 'Error happen ... .']);
        }
    
    $page->update(["page_color" => $color]);

      


    return response()->json(['success' => true, 'msg' => 'Color saved ... .']);

    
    }

    function create_block(Request $request, $id = 0)
    {

        if (!Auth::user()->can("edit builder")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

         $lang = $request->get('lang')?:"ar";

        $page = LandingPage::findOrFail($id);
        if (!$page) {
            return redirect()->back()->with(['message' => 'Not found the page', 'alert-type' => 'error']);
        }

        $myReq = [];
        $myReq = $request->all();

        if($request->has('_token')){
            unset($myReq['_token']);
        }

        if(count($page->blocks)){
        $last_block = $page->blocks()->orderBy('order', 'DESC')->where("lang", $lang)->first();

        $order = intval($last_block->order) + 1;

        if(!$request->has('order')){
            $request->merge(['order' => $order]);
        }

        }

       
        
        $block_content =json_encode($myReq);

       
     
       $block = new LandingBlock();
       $block->page_id = $id;
       $block->is_dynamic = (bool)$request->input('is_dynamic')?:false;
       $block->block_type = $request->input('block_type');
       $block->description = $request->input('description');
       $block->amount = (int)$request->input('data_amount')?:8;
       $block->content = $block_content;
       if ($request->has('country_items')) {
         $block->country_id = (int)$request->input('country_items')?:null;
       
       }else{
       $block->country_id = (int)$request->input('country')?:null;
      }
       $block->city_id = (int)$request->input('city')?:null;
       $block->category_id = (int)$request->input('category')?:null;
       $block->order = (int)$request->input('order')?:0;
       $block->lang = $lang;
       $block->save();

       if ($block->save()) {
        $updatedPage = LandingPage::findOrFail($id);
        $updatedPage->translateOrNew($lang)->lang_status = true;
        $updatedPage->save();
        $i = 1;
           foreach ($page->blocks()->where("lang", $lang)->orderBy('order', 'asc')->get() as $row) {
               $row->update(["order" => $i]);

               $i++;
           }
       }


    $redirect_url = URL::route('landing_page.show',['id' => $id]) . '?lang='.$lang.'#block_'.$block->id;
    return Redirect::to($redirect_url)->with(['message' => 'Successfully Created New Block', 'alert-type' => 'success', "page"=>$page]);
    // return redirect()->back()->with(['message' => 'Successfully Created New Block', 'alert-type' => 'success']);
    
    }



    function update_block(Request $request, $id = 0, $block_id = 0)
    {
       
        if (!Auth::user()->can("edit builder")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }



$lang = $request->get('lang')?:"ar";
        $page = LandingPage::findOrFail($id);
        if (!$page) {
            return redirect()->back()->with(['message' => 'Not found the page', 'alert-type' => 'error']);
        }

         $block = LandingBlock::findOrFail($block_id);
        if (!$block) {
            return redirect()->back()->with(['message' => 'Not found the page', 'alert-type' => 'error']);
        }

        $myReq = [];
        $myReq = $request->all();

        if($request->has('_token')){
            unset($myReq['_token']);
        }

        // if(count($page->blocks)){
        // $last_block = $page->blocks()->orderBy('order', 'DESC')->first();

        // $order = intval($last_block->order) + 1;

        // if(!$request->has('order')){
        //     $request->merge(['order' => $order]);
        // }

        // }

       
        
       $block_content =json_encode($myReq);
     
       $block->page_id = $id;
       $block->is_dynamic = (bool)$request->input('is_dynamic')?:false;
       $block->block_type = $request->input('block_type');
       $block->amount = (int)$request->input('data_amount')?:8;
       $block->description = $request->input('description');
       $block->content = $block_content;
       $block->country_id = (int)$request->input('country')?:null;
       $block->city_id = (int)$request->input('city')?:null;
       $block->category_id = (int)$request->input('category')?:null;
       $block->order = (int)$request->input('order')?:0;
       $block->lang = $lang;
       $block->save();

       

       if ($block->save()) {
        $updatedPage = LandingPage::findOrFail($id);
        $i = 1;
           foreach ($updatedPage->blocks()->orderBy('order', 'asc')->where("lang", $lang)->get() as $row) {
               $row->update(["order" => $i]);

               $i++;
           }
       }


    $redirect_url = URL::route('landing_page.show',['id' => $id]) . '?lang='.$lang .'#block_'.$block->id;
    return Redirect::to($redirect_url)->with(['message' => 'Successfully Deleted New Block', 'alert-type' => 'success', "page"=>$page]);
    // return redirect()->back()->with(['message' => 'Successfully Created New Block', 'alert-type' => 'success']);
        
    }

    function delete_block(Request $request, $id = 0, $block_id = 0)
    {
        if (!Auth::user()->can("edit builder")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $lang = $request->get('lang')?:"ar";

        $page = LandingPage::findOrFail($id);
        if (!$page) {
            return redirect()->back()->with(['message' => 'Not found the page', 'alert-type' => 'error']);
        }

        $block = LandingBlock::findOrFail($block_id);

        if (!$block) {
            return redirect()->back()->with(['message' => 'Not found the Block', 'alert-type' => 'error']);
        }



        $block->delete();
        
            $pageUpdated = LandingPage::findOrFail($id);

          if ($pageUpdated->blocks()->where('lang',$lang)->count() < 1) {
             $pageUpdated->translateOrNew($lang)->lang_status = false;
             $pageUpdated->save();   
          }
            
        

        return redirect()->back()->with(['message' => 'Successfully Created New Block', 'alert-type' => 'success']);


        
    }


}
