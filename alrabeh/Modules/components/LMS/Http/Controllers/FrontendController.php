<?php

namespace Modules\Components\LMS\Http\Controllers;

use Modules\Components\LMS\Traits\SEOTools;
use Modules\Foundation\Http\Controllers\PublicBaseController;
use Modules\Components\LMS\Facades\LMS;
use Modules\Components\LMS\Http\Requests\PageRequest;
use Modules\Components\LMS\Models\Category;
use Modules\Components\LMS\Models\Content;
use Modules\Components\LMS\Models\Course;
use Modules\Components\LMS\Models\Tag;
use Modules\Components\Subscriptions\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends PublicBaseController
{ 
    use SEOTools;

    /**
     * @param Request $request
     * @return $this
     */
    public function index(Request $request)
    {
        $slug = \Settings::get('home_page_slug', 'home');

        $item = Content::where('slug', str_slug($slug))->published()->first();

        if (!$item) {
            abort(404);
        }

        $this->lmsSEO($item, null, url('/'), 'website');
        $home = true;
        $template = $item->template ?: 'full';
        return view('templates.' . $template)->with(compact('item', 'home'));
    }

    private function lmsSEO($item, $image, $url = null, $type = 'article')
    {
        $seoItem = [
            'title' => $item->title,
            'meta_description' => $item->meta_description,
            'url' => $url ?: url($item->slug),
            'type' => $type,
            'image' => $image ?? \Settings::get('site_logo'),
            'meta_keywords' => $item->meta_keywords
        ];

        $this->setSEO((object)$seoItem);
    }

    public function show(Request $request, $slug = '')
    {
        \Actions::do_action('pre_show_front_end_page_by_slug', $slug);

        if ($page = $this->isSpecialPageSlug($slug)) {
            return $this->{$page}($request);
        }

        $item = Content::where('slug', str_slug($slug))->published()->first();


        if (!$item) {
            abort(404);
        }

        if (!isSuperUser()) {
            if ($item->private) {
                if (!user()) {
                    abort(404);
                } else if (!$item->users->contains(user())) {
                    abort(404);

                }
            }
            if ($item->categories->count() > 0) {
                foreach ($item->categories as $category) {
                    $subscription_plans = $category->subscribable_plans;
                    if ($subscription_plans) {
                        foreach ($subscription_plans as $subscription_plan) {
                            if (!user() || !user()->subscriptions->contains($subscription_plan->id)) {
                                abort(404);

                            }
                        }
                    }
                }
            }
        }

        if (!is_null($item->template)) {
            $view = 'templates.' . $item->template;
        } else {
            $view = $item->type == 'course' ? 'course' : 'templates.default';
        }

        $blog = null;
        $home = null;
        if ($item->type == 'course') {
            $blog = $this->getBlog();
        }

        $featured_image = LMS::getContentFeaturedImage($item);

        $this->lmsSEO($item, $featured_image);

        return view($view)->with(compact('item', 'featured_image', 'blog', 'home'));
    }


    public function blog(Request $request)
    {
        $blog = $this->getBlog();


        $courses = Course::whereHas('categories', function ($categories) {
            $categories->where('status', 'active');
        });


        $not_available_categories = \LMS::getNotAvailableCategories();

        if ($not_available_categories) {
            //$exclude_courses = Course::whereHas('categories', function ($categories) use ($not_available_categories) {
            //    $categories->whereIn('id', $not_available_categories);
            //})->pluck('id')->toArray();

            $courses->whereRaw(' `courses`.`id` NOT IN(SELECT course_id from category_course where category_id in(' . implode(',', $not_available_categories) . ') )');

        }


        $courses = $this->getCourses($courses, $request);


        $featured_image = LMS::getContentFeaturedImage($blog);

        $this->lmsSEO($blog, $featured_image);

        $title = null;
        if ($request->has('query')) {
            $title = $this->formatTitle($request->get('query'), 'Search Result for');
        }

        return view('blog')->with(compact('blog', 'courses', 'title', 'featured_image'));
    }

    public function pricing(Request $request)
    {
        $slug = \Settings::get('pricing_page_slug', 'pricing');

        $pricing = Content::where('slug', str_slug($slug))->published()->first();

        if (!$pricing) {
            abort(404);
        }

        $products = [];

        if (\Modules::isModuleActive('developnet-subscriptions')) {
            $products = Product::active()->get();
        }

        $featured_image = LMS::getContentFeaturedImage($pricing);

        $this->lmsSEO($pricing, $featured_image);

        return view('pricing_public')->with(compact('pricing', 'products', 'featured_image'));
    }

    protected function isSpecialPageSlug($slug)
    {
        $home = \Settings::get('home_page_slug', 'home');
        $blog = \Settings::get('blog_page_slug', 'blog');
        $pricing = \Settings::get('pricing_page_slug', 'pricing');

        switch ($slug) {
            case $home:
                return 'index';
            case $blog:
                return 'blog';
            case $pricing:
                return 'pricing';
            default:
                return false;
        }
    }

    protected function getBlog()
    {
        $slug = \Settings::get('blog_page_slug', 'blog');

        $blog = Content::where('slug', str_slug($slug))->published()->first();

        if (!$blog) {
            abort(404);
        }

        return $blog;
    }

    protected function getCourses($courses, Request $request)
    {
        $courses = $courses->published();

        if (!user()) {
            $courses = $courses->public();
        }

        if ($request->has('query')) {
            $query = $request->get('query');
            $courses = $courses->where('title', 'like', "%$query%")->orWhere('content', 'like', "%$query%");
        }

        $courses = $courses->paginate(config('lms.frontend.page_limit'));

        return $courses;
    }

    /**
     * @param Request $request
     * @param string $slug
     * @return $this
     */
    public function category(Request $request, $slug = '')
    {
        $blog = $this->getBlog();

        $category = Category::active()->where('slug', $slug)->first();

        if (!$category) {
            abort(404);
        }

        $courses = $category->courses();

        $courses = $this->getCourses($courses, $request);

        $item = new \stdClass();

        $item->title = $category->name;

        $item->meta_description = $blog->meta_description;
        $item->meta_keywords = $blog->meta_keywords;

        $this->lmsSEO($item, null, url('category/' . $slug));

        $title = $this->formatTitle($category->name);

        return view('blog')->with(compact('blog', 'courses', 'title'));
    }

    /**
     * @param Request $request
     * @param string $slug
     * @return $this
     */
    public function tag(Request $request, $slug = '')
    {
        $blog = $this->getBlog();

        $tag = Tag::active()->where('slug', $slug)->first();

        if (!$tag) {
            abort(404);
        }

        $courses = $tag->courses();

        $courses = $this->getCourses($courses, $request);

        $item = new \stdClass();

        $item->title = $tag->name;

        $item->meta_description = $blog->meta_description;
        $item->meta_keywords = $blog->meta_keywords;

        $this->lmsSEO($item, null, url('tag/' . $slug));

        $title = $this->formatTitle($tag->name);

        return view('blog')->with(compact('blog', 'courses', 'title'));
    }

    /**
     * @param $title
     * @param string $prefix
     * @return string
     */
    private function formatTitle($title, $prefix = '')
    {
        return $formattedTitle = $prefix . " [{$title}] Blog Items:";
    }

    /**
     * @param PageRequest $request
     * @param string $slug
     * @return mixed
     */
    public function adminShow(PageRequest $request, $slug = '')
    {
        $item = Content::where('slug', str_slug($slug))->firstOrFail();

        if (!is_null($item->template)) {
            $view = 'templates.' . $item->template;
        } else {
            $view = $item->type == 'course' ? 'course' : 'templates.default';
        }

        $featured_image = LMS::getContentFeaturedImage($item);

        $this->lmsSEO($item, $featured_image);

        $blog = null;
        $home = null;
        if ($item->type == 'course') {
            $blog = $this->getBlog();
        }

        return view($view)->with(compact('item', 'featured_image', 'blog', 'home'));
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function contactEmail(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required'
        ]);

        \Mail::send('emails.contact',
            array(
                'name' => $request->course('name'),
                'email' => $request->course('email'),
                'phone' => @$request->course('phone'),
                'company' => @$request->course('company'),
                'subject' => $request->course('subject'),
                'user_message' => $request->course('message')
            ), function ($message) {
                $message->to(\Settings::get('contact_form_email'), \Settings::get('site_name', 'Modules'))
                    ->subject('Contact Submission');
            });

        return \Response::json(['message' => trans('LMS::labels.message.email_sent_success'), 'class' => 'alert-success']);
    }

}