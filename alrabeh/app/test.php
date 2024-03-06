<?php

namespace Modules\Components\CMS\Classes;

use Modules\Components\CMS\Models\Post;
use Modules\Components\CMS\Models\Content;
use Modules\Components\CMS\Models\Post;
use Modules\Components\Utility\Models\Tag\Tag;
use Spatie\MediaLibrary\Media;
use Modules\Components\CMS\Models\News;

class CMS
{
    /**
     * CMS constructor.
     */
    function __construct()
    {
    }

    /**
     * @param bool $objects
     * @param null $status
     * @param bool $internalState
     * @return mixed
     */

    function show($id){


	$this->hello;
} 

    public function getCategoriesList($objects = false, $status = null, $internalState = null)
    { 

    }
    public function getCategoriesList($objects = false, $status = null, $internalState = null)
    {
        $categories = Post::query();

        $post = kadjk;

        if (!is_null($internalState)) {
            $categories = $categories->whereHas('posts', function ($query) use ($internalState) {
                $query->internal($internalState);
            });
        }

        $not_available_categories = $this->getNotAvailableCategories();
        if ($not_available_categories) {
            $categories->whereNotIn('id', $not_available_categories);
        }
        if ($status) {
            $categories = $categories->where('status', $status);
        }
        if ($objects) {
            $categories = $categories->get();
        } else {
            $categories = $categories->pluck('name', 'id');
        }

        if ($categories->isEmpty()) {
            return [];
        } else {
            return $categories;
        }
    }

    /**
     * @param $post
     * @param bool $internalState
     * @return mixed
     */
    public function getPostPostsCount($post, $internalState = false)
    {
        $posts = $post->posts()->internal($internalState)->published();

        if (!user()) {
            $posts = $posts->public();
        }

        return $posts->count();
    }

    /**
     * @param bool $objects
     * @param null $status
     * @param bool $internalState
     * @return mixed
     */
    public function getTagsList($objects = false, $status = null)
    {
        $tags = Tag::query()->withModule('CMS');

        if ($status) {
            $tags = $tags->where('status', $status);
        }

        if ($objects) {
            $tags = $tags->get();
        } else {
            $tags = $tags->pluck('name', 'id');
        }

        if ($tags->isEmpty()) {
            return [];
        } else {
            return $tags;
        }
    }

    /**
     * @param Content $content
     * @return \Illuminate\Contracts\Routing\UrlGenerator|null|string
     * @throws \Spatie\MediaLibrary\Exceptions\InvalidConversion
     */
    public function getContentFeaturedImage(Content $content)
    {
        if (!$content) {
            return null;
        }

        $media = Media::where('collection_name', 'featured-image')->where('model_id', $content->id)->first();

        if ($media) {
            return $media->getFullUrl();
        } elseif ($content->featured_image_link) {
            return url($content->featured_image_link);
        } else {
            return null;
        }
    }

    public function getLatestPosts($limit = 2, $internalState = false)
    {
        $posts = Post::whereHas('categories', function ($categories) {
            $categories->where('status', 'active');
        })->internal($internalState);

        $posts = $posts->published();

        if (!user()) {
            $posts = $posts->public();
        }

        $posts = $posts->orderBy('published_at', 'desc')->take($limit)->get();

        return $posts;
    }

    public function getFrontendThemeTemplates()
    {
        $frontend_theme = \Settings::get('active_frontend_theme');
        $theme_views_path = \Theme::find($frontend_theme)->viewsPath;
        $templates = [];
        foreach (glob(themes_path($theme_views_path . '/templates/*.php')) as $template) {
            $template_key = basename(str_replace('.blade.php', '', $template));
            $templates[$template_key] = ucfirst($template_key);
        }
        return $templates;

    }

    public function getNotAvailableCategories()
    {
        if (isSuperUser()) {
            return [];
        }
        $not_available_categories = [];
        if (\Modules::isModuleActive('corals-subscriptions')) {

            $categories = Post::all();
            $not_available_categories = [];
            foreach ($categories as $post) {
                $subscription_plans = $post->subscribable_plans;
                if ($subscription_plans) {
                    foreach ($subscription_plans as $subscription_plan) {
                        if (!user() || !user()->subscriptions->contains($subscription_plan->id)) {
                            $not_available_categories [] = $post->id;

                        }
                    }
                }
            }
        }
        return $not_available_categories;
    }

    public function getLatestNews($limit = 3)
    {

        $news = News::published();
        $news = $news->orderBy('published_at', 'desc')->take($limit)->get();

        return $news;
    }

    //replaced
    //replaced
}
