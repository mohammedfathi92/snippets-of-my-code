<?php

namespace Modules\Components\LMS\Http\Controllers\Frontend;

use Modules\Components\LMS\Models\Plan;
use Modules\Components\LMS\Models\Category;
use Modules\Foundation\Http\Controllers\PublicBaseController;
use Modules\Components\CMS\Traits\SEOTools;
use Validator;

class PlansController extends PublicBaseController
{
   use SEOTools;

    public function __construct()
    {

        parent::__construct();

    }


    function index()
    {

        // all plans  
        $plans = Plan::where('status', 1)->with('courses')->with('quizzes')->with('categories');

        return view('plans.index')->with(compact('plans'));


    }

    function show($hashed_id)
    {
      $id = hashids_decode($hashed_id);

        $plan = Plan::where('id', $id)->with(['categories', 'courses', 'quizzes', 'books'])->first();
        if(!$plan){
            return abort(404);
        }
        $categories = $plan->categories()->get();

        $page_title = $plan->title;
        $item = [
            'title'            => $plan->title,
            'meta_description' => str_limit(strip_tags($plan->meta_description), 500),
            'url'              => route('courses.show', $plan->hashed_id),
            'type'             => 'course',
            'image'            => $plan->thumbnail,
            'meta_keywords'    => $plan->meta_keywords
        ];

        $this->setSEO((object)$item);

        $courses = $plan->courses()->where('lms_courses.status','>', 0)->paginate(5, ['*'], 'courses');

        $quizzes = $plan->quizzes()->where('lms_quizzes.status','>', 0)->paginate(5, ['*'], 'quizzes');

        $books = $plan->books()->where('lms_books.status','>', 0)->paginate(5, ['*'], 'books');


        return view('plans.show')->with(compact('courses', 'quizzes','books', 'page_title'
        , 'plan','categories'));
    }


    function category($plan_hashed_id, $category_hashed_id)
    {

        $plan_id = hashids_decode($plan_hashed_id);
        $category_id = hashids_decode($category_hashed_id);
        $plan = Plan::find($plan_id);
        if(!$plan){
            return abort(404);
        }
        $category = Category::where('id', $category_id)->with(['categories', 'courses', 'quizzes', 'books'])->first();


                if(!$category){
            return abort(404);
        }



        $child_categories = Category::where('parent_id',$category_id)->get();

        $page_title = $category->name;
        $item = [
            'title'            => $category->name,
            'meta_description' => str_limit(strip_tags($category->meta_description), 500),
            'url'              => route('courses.show', $category->hashed_id),
            'type'             => 'course',
            'image'            => $category->thumbnail,
            'meta_keywords'    => $category->meta_keywords
        ];

        $this->setSEO((object)$item);

        $courses = $category->courses()->where('status', true)->paginate(5, ['*'], 'courses');

        $quizzes = $category->quizzes()->where([['status', true], ['is_standlone', true]])->paginate(5, ['*'], 'quizzes');

        $books = $category->books()->where('status', true)->paginate(5, ['*'], 'books');

        $countries =  ["أفغانستان" , "ألبانيا" , "الجزائر" , "ساموا الأمريكية" , "أندورا" , "أنغولا" , "أنغيلا" , "أنتاركتيكا" , "أنتيغوا وبربودا" , "الأرجنتين" , "الأرجنتين" , "أروبا "," أستراليا "," النمسا "," أذربيجان "," جزر البهاما "," البحرين "," بنغلاديش "," بربادوس "," بيلاروسيا "," بلجيكا "," بليز "," بنين "," برمودا ", "بوتان" , "بوليفيا" , "البوسنة والهرسك" , "بوتسوانا" , "جزيرة بوفيت" , "البرازيل" , "إقليم المحيط الهندي البريطاني" , "بروناي دار السلام" , "بلغاريا" , "بوركينا فاسو" , "بوروندي "," كمبوديا "," الكاميرون "," كندا "," الرأس الأخضر "," جزر كايمان "," جمهورية إفريقيا الوسطى "," تشاد "," تشيلي "," الصين "," جزيرة كريسماس "," كوكوس ( كيلينغ) جزر "," كولومبيا "," جزر القمر "," الكونغو "," الكونغو وجمهورية كوك "," جزر كوك "," كوستاريكا "," ساحل العاج "," كرواتيا (هرفاتسكا) " , "كوبا" , "قبرص" , "جمهورية التشيك" , "الدنمارك" , "جيبوتي" , "دومينيكا" , "جمهورية الدومينيكان" , "تيمور الشرقية" , "إكوادور" , "مصر" , "السلفادور" , "غينيا الاستوائية" , "إريتريا" , "إستونيا" , "إثيوبيا" , "جزر فوكلاند (مالفيناس)" , "جزر فارو" , "فيجي "," فنلندا "," فرنسا "," فرنسا متروبوليتان "," غيانا الفرنسية "," بولينيزيا الفرنسية "," الأقاليم الجنوبية الفرنسية "," الغابون "," غامبيا "," جورجيا "," ألمانيا "," غانا " , "جبل طارق" , "اليونان" , "غرينلاند" , "غرينادا" , "غوادلوب" , "غوام" , "غواتيمالا" , "غواتيمالا" , "غينيا بيساو" , "غيانا" , "هايتي" , "هيرد و جزر دونالد "," الكرسي الرسولي (دولة مدينة الفاتيكان) "," هندوراس "," هونج كونج "," المجر "," أيسلندا "," الهند "," إندونيسيا "," إيران (جمهورية الإسلامية) "," العراق "," أيرلندا "," إسرائيل "," إيطاليا "," جامايكا "," اليابان "," الأردن "," كازاخستان "," كينيا "," كيريباتي "," كوريا ، جمهورية كوريا الديمقراطية الشعبية "," ، جمهورية "," الكويت "," قيرغيزستان "," لاو ، الجمهورية الديمقراطية الشعبية "," لاتفيا "," لبنان "," ليسوتو "," ليبر "," الجماهيرية العربية الليبية "," ليختنشتاين "," ليتوانيا "," لوكسمبورغ "," ماكاو "," مقدونيا ، جمهورية يوغوسلافيا السابقة "," مدغشقر "," ملاوي "," ماليزيا "," جزر المالديف " , "مالي" , "مالطا" , "جزر مارشال" , "مارتينيك" , "موريتانيا" , "موريشيوس" , "جزيرة مايوت" , "المكسيك" , "ميكرونيزيا ، ولايات" , "مولدوفا ، جمهورية" , " موناكو "," منغوليا "," مونتسيرات "," المغرب "," موزمبيق "," ميانمار "," ناميبيا "," ناورو "," نيبال "," هولندا "," جزر الأنتيل الهولندية "," كاليدونيا الجديدة "," نيوزيلندا "," نيكاراغوا "," النيجر "," نيجيريا "," نيوي "," جزيرة نورفولك "," جزر ماريانا الشمالية "," النرويج "," عُمان "," باكستان "," بالاو "," بنما " , "بابوا غينيا الجديدة" , "باراغواي" , "بيرو" , "الفلبين" , "بيتكيرن" , "بولندا" , "البرتغال" , "بورتوريكو" , "قطر" , "ريونيون" , "رومانيا" , "روسية اتحاد "," رواندا "," سانت كيتس ونيفيس "," سانت لوسيا "," سانت فنسنت وجرينادين إيناس "," ساموا "," سان مارينو "," سان تومي وبرينسيبي "," السعودية "," السنغال "," سيشل "," سيراليون "," سنغافورة "," سلوفاكيا (جمهورية سلوفاكيا) "," سلوفينيا "," جزر سليمان "," الصومال "," جنوب إفريقيا "," جورجيا الجنوبية وجزر ساندويتش الجنوبية "," إسبانيا "," سريلانكا "," سانت شارع هيلينا "," بيير وميكلون "," السودان "," سورينام "," جزر سفالبارد وجان ماين "," سوازيلاند "," السويد "," سويسرا "," الجمهورية العربية السورية "," تايوان ، مقاطعة الصين "," طاجيكستان " , "تنزانيا ، جمهورية" , "تايلاند" , "توغو" , "توكيلاو" , "تونغا" , "ترينيداد وتوباغو" , "تونس" , "تركيا" , "تركمانستان" , "جزر تركس وكايكوس" , "توفالو" , "أوغندا" , "أوكرانيا" , "الإمارات العربية المتحدة" , "المملكة المتحدة" , "الولايات المتحدة" , "جزر الولايات المتحدة البعيدة الصغيرة" , "أوروغواي" , "أوزبكستان" , "فانواتو" , "فنزويلا "," فيتنام "," جزر فيرجن (البريطانية) "," جزر فيرجن (الولايات المتحدة) "," جزر واليس وفوتونا "," الصحراء الغربية "," اليمن "," يوغوسلافيا "," زامبيا "," زيمبابوي "];


       // dd($countries);

        return view('plans.category')->with(compact('courses', 'quizzes','books','plan', 'page_title'
        , 'category','child_categories'));


    }



}
