<?php
/**
 * Created by PhpStorm.
 * User: mohammed
 * Date: 12/29/16
 * Time: 2:13 AM
 */

namespace Sirb\Http\Controllers;

use App;
use Carbon\Carbon;
use URL;
use Sirb\Http\Controllers\Controller;

class SitemapController extends Controller
{


    function index()
    {
        $appUrl = env('APP_URL') ?: \Settings::get('url');
        // create sitemap
        $sitemap = App::make("sitemap");

        // set cache
        // $sitemap->setCache('laravel.sitemap-index', 3600);

        // add sitemaps (loc, lastmod (optional))
        $sitemap->addSitemap(URL::to($appUrl . '/countries-sitemap.xml'), Carbon::yesterday());
        $sitemap->addSitemap(URL::to($appUrl . '/cities-sitemap.xml'), Carbon::yesterday());
        $sitemap->addSitemap(URL::to($appUrl . '/hotels-sitemap.xml'), Carbon::yesterday());
        $sitemap->addSitemap(URL::to($appUrl . '/places-sitemap.xml'), Carbon::yesterday());
        $sitemap->addSitemap(URL::to($appUrl . '/packages-sitemap.xml'), Carbon::yesterday());
        $sitemap->addSitemap(URL::to($appUrl . '/news-sitemap.xml'), Carbon::yesterday());
        $sitemap->addSitemap(URL::to($appUrl . '/pages-sitemap.xml'), Carbon::yesterday());
        $sitemap->addSitemap(URL::to($appUrl . '/guide-sitemap.xml'), Carbon::yesterday());
        $sitemap->addSitemap(URL::to($appUrl . '/faq-sitemap.xml'), Carbon::yesterday());
        $sitemap->addSitemap(URL::to($appUrl . '/main-urls-sitemap.xml'), Carbon::yesterday());
        $sitemap->addSitemap(URL::to($appUrl . '/landing-pages-sitemap.xml'), Carbon::yesterday());


        // show sitemap
        return $sitemap->render('sitemapindex');

    }

    function hotels()
    {
        $appUrl = env('APP_URL') ?: \Settings::get('url');
        $sitemap_hotels = App::make("sitemap");

//        $sitemap_hotels->setCache('laravel.sitemap-hotels', 3600);

        $hotels = \Sirb\Hotel::orderBy('created_at', 'desc')->where('status', 1)->get();

        foreach ($hotels as $row) {

            $pageUrl = $appUrl . "/hotels/" . $row->id . "/" . make_slug($row->{"name:ar"});
            $pageUrl_en = $appUrl . "/en/hotels/" . $row->id . "/" . str_slug($row->{"name:en"});
            $translations = [
//                ['language' => 'en', 'url' => URL::to($pageUrl_en)],
            ];
            $images = [];
            if ($row->gallery) {
                foreach ($row->gallery as $photo) {
                    $images[] = ['url' => URL::to(route("files.url", $photo->name)), 'title' => $row->name, 'caption' => $row->name, 'geo_location' => $row->address];

                }
            }


            $sitemap_hotels->add(URL::to($pageUrl), Carbon::createFromFormat('Y-m-d H:i:s', $row->updated_at), '0.85', 'daily', $images, null, $translations);
        }

        return $sitemap_hotels->render('xml');

    }

    function places()
    {
        $appUrl = env('APP_URL') ?: \Settings::get('url');
        $sitemap_places = App::make("sitemap");

//        $sitemap_places->setCache('laravel.sitemap-places', 3600);

        $places = \Sirb\Place::orderBy('created_at', 'desc')->where('status', 1)->get();

        foreach ($places as $row) {
            $pageSlug = make_slug($row->{"name:ar"});
            $pageUrl = $appUrl . "/places/" . $row->id . "/" . $pageSlug;
            $pageUrl_en = $appUrl . "/en/places/" . $row->id . "/" . str_slug($row->{"name:en"});
            $translations = [
//                ['language' => 'en', 'url' => URL::to($pageUrl_en)],
            ];

            $images = [];
            if ($row->gallery) {
                foreach ($row->gallery as $photo) {
                    try {
                        if ($photo->name) {
                            $images[] = ['url' => URL::to($appUrl . "/files/$photo->name"), 'title' => $row->name, 'caption' => $row->name, 'geo_location' => $row->map];

                        }
                    } catch (\Exception $e) {

                    }


                }
            }

            $sitemap_places->add(URL::to($pageUrl), Carbon::createFromFormat('Y-m-d H:i:s', $row->updated_at), '0.85', 'daily', $images, null, $translations);
        }

        return $sitemap_places->render('xml');

    }

    function packages()
    {
        $appUrl = env('APP_URL') ?: \Settings::get('url');
        $sitemap_packages = App::make("sitemap");

//        $sitemap_packages->setCache('laravel.sitemap-packages', 3600);

        $packages = \Sirb\Package::orderBy('created_at', 'desc')->where('status', 1)->get();
        $packagesType = \Sirb\PackageType::orderBy('created_at', 'desc')->where('status', 1)->get();

        foreach ($packages as $row) {
            $pageSlug = make_slug($row->{"name:ar"});
            $pageUrl = $appUrl . "/packages/" . $row->id . "/" . $pageSlug;
            $pageUrl_en = $appUrl . "/en/packages/" . $row->id . "/" . str_slug($row->{"name:en"});
            $translations = [
//                ['language' => 'en', 'url' => URL::to($pageUrl_en)],
            ];
            $images = [];
            if ($row->gallery) {
                foreach ($row->gallery as $photo) {
                    $images[] = ['url' => URL::to(route("files.url", $photo->name)), 'title' => $row->name, 'caption' => $row->name, 'geo_location' => $row->country->name];
                }
            }

            $sitemap_packages->add(URL::to($pageUrl), Carbon::createFromFormat('Y-m-d H:i:s', $row->updated_at), '0.85', 'daily', $images, null, $translations);
        }

        foreach ($packagesType as $row) {
            $pageSlug = make_slug($row->{"name:ar"});
            $pageUrl = $appUrl . "/packages/type/" . $row->id . "/" . $pageSlug;
            $pageUrl_en = $appUrl . "/en/packages/type/" . $row->id . "/" . str_slug($row->{"name:en"});
            $translations = [
//                ['language' => 'en', 'url' => URL::to($pageUrl_en)],
            ];

            $sitemap_packages->add(URL::to($pageUrl), Carbon::createFromFormat('Y-m-d H:i:s', $row->updated_at), '0.85', 'daily', [], null, $translations);
        }


        return $sitemap_packages->render('xml');

    }

    function news()
    {
        $appUrl = env('APP_URL') ?: \Settings::get('url');
        $sitemap_news = App::make("sitemap");

//        $sitemap_news->setCache('laravel.sitemap-news', 3600);

        $news = \Sirb\News::orderBy('created_at', 'desc')->where('status', 1)->get();

        foreach ($news as $row) {
            $pageSlug = make_slug($row->{"name:ar"});
            $pageUrl = $appUrl . "/news/" . $row->id . "/" . $pageSlug;
            $pageUrl_en = $appUrl . "/en/news/" . $row->id . "/" . str_slug($row->{"name:en"});
            $translations = [
//                ['language' => 'en', 'url' => URL::to($pageUrl_en)],
            ];
            $images = [];
            if ($row->gallery) {
                foreach ($row->gallery as $photo) {
                    $images[] = ['url' => URL::to(route("files.url", $photo->name)), 'title' => $row->name, 'caption' => $row->name];
                }
            }
            $sitemap_news->add(URL::to($pageUrl), Carbon::createFromFormat('Y-m-d H:i:s', $row->updated_at), '0.85', 'daily', $images, null, $translations);
        }

        return $sitemap_news->render('xml');

    }

     function landing_pages()
    {
        $appUrl = env('APP_URL') ?: \Settings::get('url');
        $sitemap_landing_pages = App::make("sitemap");

//        $sitemap_landing_pages->setCache('laravel.sitemap-landing-pages', 3600);

        $landing_pages = \Sirb\LandingPage::orderBy('created_at', 'desc')->where('status', 1)->get();

        foreach ($landing_pages as $row) {
            $pageSlug = $row->slug;
            $pageUrl = $appUrl . "/my/" . $pageSlug;
            $pageUrl_en = $appUrl . "/en/my/" . $pageSlug;
            $translations = [
//                ['language' => 'en', 'url' => URL::to($pageUrl_en)],
            ];

            $images = [];
            if ($row->gallery) {
                foreach ($row->gallery as $photo) {
                    $images[] = ['url' => URL::to(route("files.url", $photo->name)), 'title' => $row->name, 'caption' => $row->name];
                }
            }

            $sitemap_landing_pages->add(URL::to($pageUrl), Carbon::createFromFormat('Y-m-d H:i:s', $row->updated_at), '0.85', 'daily', [], null, $translations);
        }

        return $sitemap_landing_pages->render('xml');

    }

    function pages()
    {
        $appUrl = env('APP_URL') ?: \Settings::get('url');
        $sitemap_pages = App::make("sitemap");

//        $sitemap_pages->setCache('laravel.sitemap-pages', 3600);

        $pages = \Sirb\Page::orderBy('created_at', 'desc')->where('status', 1)->get();

        foreach ($pages as $row) {
            $pageSlug = $row->slug;
            $pageUrl = $appUrl . "/page/" . $pageSlug;
            $pageUrl_en = $appUrl . "/en/page/" . $pageSlug;
            $translations = [
//                ['language' => 'en', 'url' => URL::to($pageUrl_en)],
            ];

            $images = [];
            if ($row->gallery) {
                foreach ($row->gallery as $photo) {
                    $images[] = ['url' => URL::to(route("files.url", $photo->name)), 'title' => $row->name, 'caption' => $row->name];
                }
            }

            $sitemap_pages->add(URL::to($pageUrl), Carbon::createFromFormat('Y-m-d H:i:s', $row->updated_at), '0.85', 'daily', [], null, $translations);
        }

        return $sitemap_pages->render('xml');

    }

    function guide()
    {
        $appUrl = env('APP_URL') ?: \Settings::get('url');
        $sitemap = App::make("sitemap");

//        $sitemap_guide->setCache('laravel.sitemap-guide', 3600);

        $categories = \Sirb\Category::orderBy('created_at', 'desc')->where('status', 1)->get();

        foreach ($categories as $row) {

            $pageSlug = make_slug($row->{"name:ar"});
            $pageUrl = $appUrl . "/guide/" . $row->id . "/" . $pageSlug;
            $pageUrl_en = $appUrl . "/en/guide/" . $row->id . "/" . str_slug($row->{"name:en"});
            $translations = [

//                ['language' => 'en', 'url' => URL::to($pageUrl_en)],
            ];

            $images = [];
            if ($row->gallery) {
                foreach ($row->gallery as $photo) {
                    $images[] = ['url' => URL::to(route("files.url", $photo->name)), 'title' => $row->name, 'caption' => $row->name];
                }
            }

            $sitemap->add(URL::to($pageUrl), Carbon::createFromFormat('Y-m-d H:i:s', $row->updated_at), '0.85', 'daily', $images, null, $translations);

        }

        $topics = \Sirb\Article::orderBy('created_at', 'desc')->where('status', 1)->get();

        foreach ($topics as $topic) {

            $topicUrl = $appUrl . "/guide/" . $topic->category_id . "/topic/" . $topic->id . "/" . make_slug($topic->{"name:ar"});
            $topicUrl_en = $appUrl . "/en/guide/" . $topic->category_id . "/topic/" . $topic->id . "/" . str_slug($topic->{"name:en"});
            $translations2 = [
//                ['language' => 'en', 'url' => URL::to($topicUrl_en)],
            ];
            $images = [];
            if ($topic->photo) {

                $images[] = ['url' => URL::to(route("files.url", $row->photo)), 'title' => $topic->name, 'caption' => $row->name];

            }

            $sitemap->add(URL::to($topicUrl), Carbon::createFromFormat('Y-m-d H:i:s', $topic->updated_at), '0.85', 'daily', $images, null, $translations2);
        }


        return $sitemap->render('xml');

    }

    function faq()
    {
        $appUrl = env('APP_URL') ?: \Settings::get('url');
        $sitemap_faq = App::make("sitemap");

//        $sitemap_faq->setCache('laravel.sitemap-faq', 3600);

        $faq = \Sirb\FAQ::orderBy('created_at', 'desc')->where('status', 1)->get();

        foreach ($faq as $row) {
            $pageSlug = $row->slug;
            $pageUrl = $appUrl . "/faq/" . $pageSlug;
            $pageUrl_en = $appUrl . "/en/faq/" . $pageSlug;
            $translations = [
//                ['language' => 'en', 'url' => URL::to($pageUrl_en)],
            ];


            $sitemap_faq->add(URL::to($pageUrl), Carbon::createFromFormat('Y-m-d H:i:s', $row->updated_at), '0.85', 'daily', [], null, $translations);
        }

        return $sitemap_faq->render('xml');

    }

    function countries()
    {
        $appUrl = env('APP_URL') ?: \Settings::get('url');
        $sitemap_countries = App::make("sitemap");

//        $sitemap_countries->setCache('laravel.sitemap-countries', 3600);

        $countries = \Sirb\Country::orderBy('created_at', 'desc')->where('status', 1)->get();

        foreach ($countries as $row) {
            $pageSlug_en = str_slug($row->{"name:en"});
            $trans_country = [
//                ['language' => 'en', 'url' => URL::to($appUrl . "/en/country/" . $row->id . "/" . $pageSlug_en)],
            ];
            $trans_guide = [
//                ['language' => 'en', 'url' => URL::to($appUrl . "/en/country/" . $row->id . "/" . $pageSlug_en . "/guide")],
            ];
            $trans_hotels = [
//                ['language' => 'en', 'url' => URL::to($appUrl . "/en/country/" . $row->id . "/" . $pageSlug_en . "/hotels")],
            ];
            $trans_places = [
//                ['language' => 'en', 'url' => URL::to($appUrl . "/en/country/" . $row->id . "/" . $pageSlug_en . "/places")],
            ];
            $trans_cities = [
//                ['language' => 'en', 'url' => URL::to($appUrl . "/en/country/" . $row->id . "/" . $pageSlug_en . "/cities")],
            ];
            $trans_test_video = [
//                ['language' => 'en', 'url' => URL::to($appUrl . "/en/testimonials/videos/destination/" . $row->id . "/" . $pageSlug_en)],
            ];
            $trans_test_all = [
//                ['language' => 'en', 'url' => URL::to($appUrl . "/en/testimonials/destination/" . $row->id . "/" . $pageSlug_en)],
            ];
            $images = [];
            if ($row->gallery) {
                foreach ($row->gallery as $photo) {
                    $images[] = ['url' => URL::to(route("files.url", $photo->name)), 'title' => $row->name, 'caption' => $row->name, 'geo_location' => $row->map];
                }
            }
            $sitemap_countries->add(URL::to($appUrl . "/country/" . $row->id . "/" . make_slug($row->{"name:ar"})), Carbon::createFromFormat('Y-m-d H:i:s', $row->updated_at), '0.85', 'daily', $images, null, $trans_country);
            $sitemap_countries->add(URL::to($appUrl . "/country/" . $row->id . "/" . make_slug($row->{"name:ar"}) . "/cities"), Carbon::createFromFormat('Y-m-d H:i:s', $row->updated_at), '0.85', 'daily', [], null, $trans_cities);
            $sitemap_countries->add(URL::to($appUrl . "/country/" . $row->id . "/" . make_slug($row->{"name:ar"}) . "/guide"), Carbon::createFromFormat('Y-m-d H:i:s', $row->updated_at), '0.85', 'daily', [], null, $trans_guide);
            $sitemap_countries->add(URL::to($appUrl . "/country/" . $row->id . "/" . make_slug($row->{"name:ar"}) . "/hotels"), Carbon::createFromFormat('Y-m-d H:i:s', $row->updated_at), '0.85', 'daily', [], null, $trans_hotels);
            $sitemap_countries->add(URL::to($appUrl . "/country/" . $row->id . "/" . make_slug($row->{"name:ar"}) . "/places"), Carbon::createFromFormat('Y-m-d H:i:s', $row->updated_at), '0.85', 'daily', [], null, $trans_places);
            $sitemap_countries->add(URL::to($appUrl . "/testimonials/videos/destination/" . $row->id . "/" . make_slug($row->{"name:ar"})), Carbon::createFromFormat('Y-m-d H:i:s', $row->updated_at), '0.85', 'daily', [], null, $trans_test_video);
            $sitemap_countries->add(URL::to($appUrl . "/testimonials/destination/" . $row->id . "/" . make_slug($row->{"name:ar"})), Carbon::createFromFormat('Y-m-d H:i:s', $row->updated_at), '0.85', 'daily', [], null, $trans_test_all);


        }

        return $sitemap_countries->render('xml');

    }

    function cities()
    {
        $appUrl = env('APP_URL') ?: \Settings::get('url');
        $sitemap_cities = App::make("sitemap");

//        $sitemap_cities->setCache('laravel.sitemap-cities', 3600);

        $cities = \Sirb\City::orderBy('created_at', 'desc')->where('status', 1)->get();

        foreach ($cities as $row) {
            $pageSlug = make_slug($row->{"name:ar"});
            $trans_city = [
//                ['language' => 'en', 'url' => URL::to($appUrl . "/en/city/" . $row->id . "/" . str_slug($row->{"name:en"}))],
            ];

            $trans_hotels = [
//                ['language' => 'en', 'url' => URL::to($appUrl . "/en/city/" . $row->id . "/" . str_slug($row->{"name:en"}) . "/hotels")],
            ];
            $trans_places = [
//                ['language' => 'en', 'url' => URL::to($appUrl . "/en/city/" . $row->id . "/" . str_slug($row->{"name:en"}) . "/places")],
            ];
            $images = [];
            if ($row->gallery) {
                foreach ($row->gallery as $photo) {
                    $images[] = ['url' => URL::to(route("files.url", $photo->name)), 'title' => $row->name, 'caption' => $row->name, 'geo_location' => $row->map];
                }
            }
            $sitemap_cities->add(URL::to($appUrl . "/city/" . $row->id . "/" . $pageSlug), Carbon::createFromFormat('Y-m-d H:i:s', $row->updated_at), '0.85', 'daily', $images, null, $trans_city);
            $sitemap_cities->add(URL::to($appUrl . "/city/" . $row->id . "/" . $pageSlug . "/hotels"), Carbon::createFromFormat('Y-m-d H:i:s', $row->updated_at), '0.85', 'daily', [], null, $trans_hotels);
            $sitemap_cities->add(URL::to($appUrl . "/city/" . $row->id . "/" . $pageSlug . "/places"), Carbon::createFromFormat('Y-m-d H:i:s', $row->updated_at), '0.85', 'daily', [], null, $trans_places);


        }

        return $sitemap_cities->render('xml');

    }

    function main_urls()
    {
        $appUrl = env('APP_URL') ?: \Settings::get('url');
        $sitemap_main_urls = App::make("sitemap");

//        $sitemap_main_urls->setCache('laravel.sitemap-main_urls', 3600);
        $trans_site_en = [
//            ['language' => 'en', 'url' => URL::to($appUrl . "/en")],
        ];
        $trans_hotels = [
//            ['language' => 'en', 'url' => URL::to($appUrl . "/en/hotels")],
        ];
        $trans_places = [
//            ['language' => 'en', 'url' => URL::to($appUrl . "/en/places")],
        ];
        $trans_packages = [
//            ['language' => 'en', 'url' => URL::to($appUrl . "/en/packages")],
        ];
        $trans_news = [
//            ['language' => 'en', 'url' => URL::to($appUrl . "/en/news")],
        ];
        $trans_news_search = [
//            ['language' => 'en', 'url' => URL::to($appUrl . "/en/news/search")],
        ];
        $trans_faq = [
//            ['language' => 'en', 'url' => URL::to($appUrl . "/en/faq")],
        ];
        $trans_faq_search = [
//            ['language' => 'en', 'url' => URL::to($appUrl . "/en/faq/search")],
        ];
        $trans_testimonials = [
//            ['language' => 'en', 'url' => URL::to($appUrl . "/en/testimonials")],
        ];
        $trans_testimonials_video = [
//            ['language' => 'en', 'url' => URL::to($appUrl . "/en/testimonials/videos")],
        ];
        $trans_contact = [
//            ['language' => 'en', 'url' => URL::to($appUrl . "/en/contact-us")],
        ];
        $trans_booking = [
//            ['language' => 'en', 'url' => URL::to($appUrl . "/en/booking")],
        ];

        $sitemap_main_urls->add(URL::to($appUrl), Carbon::yesterday(), '0.85', 'daily');
        $sitemap_main_urls->add(URL::to($appUrl . ""), Carbon::yesterday(), '0.85', 'daily', [], null, $trans_site_en);
        $sitemap_main_urls->add(URL::to($appUrl . "/hotels"), Carbon::yesterday(), '0.85', 'daily', [], null, $trans_hotels);
        $sitemap_main_urls->add(URL::to($appUrl . "/places"), Carbon::yesterday(), '0.85', 'daily', [], null, $trans_places);
        $sitemap_main_urls->add(URL::to($appUrl . "/packages"), Carbon::yesterday(), '0.85', 'daily', [], null, $trans_packages);
        $sitemap_main_urls->add(URL::to($appUrl . "/faq"), Carbon::yesterday(), '0.85', 'daily', [], null, $trans_faq);
        $sitemap_main_urls->add(URL::to($appUrl . "/faq/search"), Carbon::yesterday(), '0.85', 'daily', [], null, $trans_faq_search);
        $sitemap_main_urls->add(URL::to($appUrl . "/news"), Carbon::yesterday(), '0.85', 'daily', [], null, $trans_news);
        $sitemap_main_urls->add(URL::to($appUrl . "/news/search"), Carbon::yesterday(), '0.85', 'daily', [], null, $trans_news_search);
        $sitemap_main_urls->add(URL::to($appUrl . "/testimonials"), Carbon::yesterday(), '0.85', 'daily', [], null, $trans_testimonials);
        $sitemap_main_urls->add(URL::to($appUrl . "/testimonials/videos"), Carbon::yesterday(), '0.85', 'daily', [], null, $trans_testimonials_video);
        $sitemap_main_urls->add(URL::to($appUrl . "/contact-us"), Carbon::yesterday(), '0.85', 'daily', [], null, $trans_contact);
        $sitemap_main_urls->add(URL::to($appUrl . "/booking"), Carbon::yesterday(), '0.85', 'daily', [], null, $trans_booking);


        return $sitemap_main_urls->render('xml');

    }


}
