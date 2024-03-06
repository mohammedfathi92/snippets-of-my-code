<?php
  
namespace Modules\Components\LMS\Http\Controllers\Frontend;

use Modules\Foundation\Http\Controllers\PublicBaseController;
use Illuminate\Http\Request;
use Validator;
use Modules\Components\LMS\Models\Book;
use Modules\Components\LMS\Models\Subscription;
use Modules\Components\LMS\Models\Plan;
use Modules\Components\LMS\Models\UserLMS;
use Illuminate\Support\Facades\Auth;
use Modules\Components\CMS\Traits\SEOTools;

class BooksController extends PublicBaseController
{ 
  use SEOTools;

    public function index(){

    $page_title = \LMS::setGeneralPagesTitle('books');

      \LMS::setGeneralPagesSeo('books', route('books.index'), null, 'books');

        // all books
      $books = Book::where('status', 1)->paginate(10);


        return view('books.index')->with(compact('books', 'page_title'));


    }


    public function show(Request $request, $hashed_id){

           $id = hashids_decode($hashed_id);

        $book =Book::find($id);

        if(empty($book)){
           abort(404);
        }

        $page_title = $book->title;
          $item = [
            'title' => $book->title,
            'meta_description' => str_limit(strip_tags($book->meta_description), 500),
            'url' => route('courses.show', $book->hashed_id),
            'type' => 'book',
            'image' => $book->thumbnail,
            'meta_keywords' => $book->meta_keywords
        ];

        $this->setSEO((object)$item);

        /*******  Related Courses*********/
        $relatedIds = $book->categories->pluck('id')->toArray();
        $relatedBooks = Book::whereHas('categories',  function ($q)use ($relatedIds) {
            $q->whereIn('id',$relatedIds);
        })->where('status', true);
         /******* Side bar*********/
        $user = null;
        $subscriptionStatus = ['success' => false, 'status' =>  0, 'message' => 'not subscribed'];
        $enroll_status = false;

        if(!user()){
           return view('books.show')->with(compact('book',
            'relatedBooks',
            'subscriptionStatus'

        ));
        }

         
        $user = UserLMS::find(Auth()->id());

        $moduleArray = [
        'module' => 'book',
        'module_id' => $id,
        'user' => $user,
        'parent' => [],
       
      ];

        $subscriptionStatus = \Subscriptions::check_subscription($moduleArray);

        // if($subscriptionStatus['success'] && $subscriptionStatus['status'] > 0){
        //     \Logs::enroll($moduleArray);
        
        // }

        return view('books.show')->with(compact('book',
            'relatedBooks',
            'subscriptionStatus'

        ));
    }


    




    public function preview(Request $request, $hashed_id){

    if(!Auth::check()){
          return redirect()->back()->with(['message' =>'عفوًا ! ... يجب تسجيل الدخول اولًا.', 'alert_type' => 'danger']);
        
        }

      $id = hashids_decode($hashed_id);

       $book =Book::find($id);

        if(empty($book)){
           abort(404);
        }

    $moduleArray = [
        'module' => 'book',
        'module_id' => $book->id,
        'user' => userLMS(user()->id),
        'parent' => [],
       
      ];

        $subscriptionStatus = \Subscriptions::check_subscription($moduleArray);

         if(!$subscriptionStatus['success'] && $subscriptionStatus['status'] < 1){
        return redirect()->route('books.show', $book->hashed_id)->with(['message' =>'عفوًا ! ... غير مصرح لك بعرض هذه الصفحة  ... تأكد من تفعيل اشتراكك', 'alert_type' => 'danger']);

        
        }


        return view('books.preview')->with(compact('book'));

       

    }

    

}
