<?php

namespace Sirb\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Tags\Url;

class GenerateSiteMap extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the sitemap.';

    /**
     * Create a new command instance.
     *
     * @return void
     */

    protected $sitemap;


    public function __construct()
    {
        parent::__construct();
        $appUrl = env('APP_URL') ?: \Settings::get('url');
        $this->sitemap = SitemapGenerator::create($appUrl)->getSitemap();
    }


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {


        \Log::info("Start Generating a new Sitemap at :" . date("Y-m-d H:i:s"));


        $appUrl = env('APP_URL') ?: \Settings::get('url');


        $this->sitemap
            ->add(Url::create($appUrl . "/ar/hotels")
                ->setLastModificationDate(Carbon::now())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                ->setPriority(0.85)
                ->addAlternate($appUrl . "/en/hotels", "en"))
            ->add(Url::create($appUrl . "/ar/places")
                ->setLastModificationDate(Carbon::now())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                ->setPriority(0.85)
                ->addAlternate($appUrl . "/en/places", "en"))
            ->add(Url::create($appUrl . "/ar/packages")
                ->setLastModificationDate(Carbon::now())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                ->setPriority(0.85)
                ->addAlternate($appUrl . "/en/packages", "en"))
            ->add(Url::create($appUrl . "/ar/faq")
                ->setLastModificationDate(Carbon::now())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                ->setPriority(0.85)
                ->addAlternate($appUrl . "/en/faq", "en"))
            ->add(Url::create($appUrl . "/ar/faq/search")
                ->setLastModificationDate(Carbon::now())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                ->setPriority(0.7)
                ->addAlternate($appUrl . "/en/faq/search", "en"))
            ->add(Url::create($appUrl . "/ar/news/search")
                ->setLastModificationDate(Carbon::now())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                ->setPriority(0.85)
                ->addAlternate($appUrl . "/en/news/search", "en"))
            ->add(Url::create($appUrl . "/ar/news/search")
                ->setLastModificationDate(Carbon::now())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                ->setPriority(0.7)
                ->addAlternate($appUrl . "/en/news/search", "en"))
            ->add(Url::create($appUrl . "/ar/testimonials")
                ->setLastModificationDate(Carbon::now())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                ->setPriority(0.85)
                ->addAlternate($appUrl . "/en/testimonials", "en"))
            ->add(Url::create($appUrl . "/ar/testimonials/videos")
                ->setLastModificationDate(Carbon::now())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                ->setPriority(0.85)
                ->addAlternate($appUrl . "/en/testimonials/videos", "en"))
            ->add(Url::create($appUrl . "/ar/contact-us")
                ->setLastModificationDate(Carbon::now())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                ->setPriority(0.85)
                ->addAlternate($appUrl . "/en/contact-us", "en"))
            ->add(Url::create($appUrl . "/ar/booking")
                ->setLastModificationDate(Carbon::now())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                ->setPriority(0.85)
                ->addAlternate($appUrl . "/en/booking", "en"));

        foreach (\Sirb\FAQ::orderBy('id', 'DESC')->get() as $row) {
            echo "FAQ-" . $row->id;
            $this->sitemap
                ->add(Url::create($appUrl . "/ar/faq/" . $row->slug)
                    ->setLastModificationDate(Carbon::createFromFormat('Y-m-d H:i:s', $row->updated_at))
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                    ->setPriority(0.85)
                    ->addAlternate($appUrl . "/en/faq/" . $row->slug, "en"));
        }

        foreach (\Sirb\News::orderBy('id', 'DESC')->get() as $row) {
            echo "News-" . $row->id;
            $pageUrl = str_slug($row->{"name:en"});
            $this->sitemap
                ->add(Url::create($appUrl . "/ar/news/" . $row->id . "/" . $pageUrl)
                    ->setLastModificationDate(Carbon::createFromFormat('Y-m-d H:i:s', $row->updated_at))
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                    ->setPriority(0.85)
                    ->addAlternate($appUrl . "/en/news/" . $row->id . "/" . $pageUrl, "en"));
        }

        foreach (\Sirb\Page::get() as $row) {
            echo "Page-" . $row->id;
            $this->sitemap
                ->add(Url::create($appUrl . "/ar/page/" . $row->slug)
                    ->setLastModificationDate(Carbon::createFromFormat('Y-m-d H:i:s', $row->updated_at))
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                    ->setPriority(0.85)
                    ->addAlternate($appUrl . "/en/page/" . $row->slug, "en"));
        }


        foreach (\Sirb\Category::orderBy('id', 'DESC')->get() as $row) {

            $pageUrl = str_slug($row->{"name:en"});
            echo "Category-" . $row->id;

            $this->sitemap
                ->add(Url::create($appUrl . "/ar/guide/" . $row->id . "/" . $pageUrl)
                    ->setLastModificationDate(Carbon::createFromFormat('Y-m-d H:i:s', $row->updated_at))
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                    ->setPriority(0.85)
                    ->addAlternate($appUrl . "/en/guide/" . $row->id . "/" . $pageUrl, "en"));


            foreach ($row->articles()->orderBy('id', 'DESC')->get() as $topic) {
                echo "articles-" . $topic->id;
                $this->sitemap
                    ->add(Url::create($appUrl . "/ar/guide/" . $row->id . "/topic/" . $topic->id . "/" . str_slug($topic->{"name:en"}))
                        ->setLastModificationDate(Carbon::createFromFormat('Y-m-d H:i:s', $row->updated_at))
                        ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                        ->setPriority(0.85)
                        ->addAlternate($appUrl . "/en/guide/" . $row->id . "/topic/" . $topic->id . "/" . str_slug($topic->{"name:en"}), "en"));
            }

        }

        foreach (\Sirb\Country::orderBy('id', 'DESC')->get() as $row) {
            echo "Country-" . $row->id;
            $pageUrl = str_slug($row->{"name:en"});
            $this->sitemap
                ->add(Url::create($appUrl . "/ar/country/" . $row->id . "/" . $pageUrl)
                    ->setLastModificationDate(Carbon::createFromFormat('Y-m-d H:i:s', $row->updated_at))
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                    ->setPriority(0.85)
                    ->addAlternate($appUrl . "/en/country/" . $row->id . "/" . $pageUrl, "en"))
                ->add(Url::create($appUrl . "/ar/country/" . $row->id . "/" . $pageUrl . "/cities")
                    ->setLastModificationDate(Carbon::createFromFormat('Y-m-d H:i:s', $row->updated_at))
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                    ->setPriority(0.85)
                    ->addAlternate($appUrl . "/en/country/" . $row->id . "/" . $pageUrl . "/cities", "en"))
                ->add(Url::create($appUrl . "/ar/country/" . $row->id . "/" . $pageUrl . "/guide")
                    ->setLastModificationDate(Carbon::createFromFormat('Y-m-d H:i:s', $row->updated_at))
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                    ->setPriority(0.85)
                    ->addAlternate($appUrl . "/en/country/" . $row->id . "/" . $pageUrl . "/guide", "en"))
                ->add(Url::create($appUrl . "/ar/country/" . $row->id . "/" . $pageUrl . "/hotels")
                    ->setLastModificationDate(Carbon::createFromFormat('Y-m-d H:i:s', $row->updated_at))
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                    ->setPriority(0.85)
                    ->addAlternate($appUrl . "/en/country/" . $row->id . "/" . $pageUrl . "/hotels", "en"))
                ->add(Url::create($appUrl . "/ar/country/" . $row->id . "/" . $pageUrl . "/places")
                    ->setLastModificationDate(Carbon::createFromFormat('Y-m-d H:i:s', $row->updated_at))
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                    ->setPriority(0.85)
                    ->addAlternate($appUrl . "/en/country/" . $row->id . "/" . $pageUrl . "/places", "en"))
                ->add(Url::create($appUrl . "/ar/testimonials/videos/destination/" . $row->id . "/" . $pageUrl)
                    ->setLastModificationDate(Carbon::createFromFormat('Y-m-d H:i:s', $row->updated_at))
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                    ->setPriority(0.85)
                    ->addAlternate($appUrl . "/en/testimonials/videos/destination/" . $row->id . "/" . $pageUrl, "en"))
                ->add(Url::create($appUrl . "/ar/testimonials/destination/" . $row->id . "/" . $pageUrl)
                    ->setLastModificationDate(Carbon::createFromFormat('Y-m-d H:i:s', $row->updated_at))
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                    ->setPriority(0.85)
                    ->addAlternate($appUrl . "/en/testimonials/destination/" . $row->id . "/" . $pageUrl, "en"));
        }

        foreach (\Sirb\City::orderBy('id', 'DESC')->get() as $row) {
            echo "City-" . $row->id;
            $pageUrl = str_slug($row->{"name:en"});
            $this->sitemap
                ->add(Url::create($appUrl . "/ar/city/" . $row->id . "/" . $pageUrl)
                    ->setLastModificationDate(Carbon::createFromFormat('Y-m-d H:i:s', $row->updated_at))
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                    ->setPriority(0.85)
                    ->addAlternate($appUrl . "/en/city/" . $row->id . "/" . $pageUrl, "en"))
                ->add(Url::create($appUrl . "/ar/city/" . $row->id . "/" . $pageUrl . "/hotels")
                    ->setLastModificationDate(Carbon::createFromFormat('Y-m-d H:i:s', $row->updated_at))
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                    ->setPriority(0.85)
                    ->addAlternate($appUrl . "/en/city/" . $row->id . "/" . $pageUrl . "/hotels", "en"))
                ->add(Url::create($appUrl . "/ar/city/" . $row->id . "/" . $pageUrl . "/places")
                    ->setLastModificationDate(Carbon::createFromFormat('Y-m-d H:i:s', $row->updated_at))
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                    ->setPriority(0.85)
                    ->addAlternate($appUrl . "/en/city/" . $row->id . "/" . $pageUrl . "/places", "en"));

        }

        foreach (\Sirb\Hotel::orderBy('id', 'DESC')->get() as $row) {
            echo "Hotel-" . $row->id;
            $pageUrl = str_slug($row->{"name:en"});
            $this->sitemap
                ->add(Url::create($appUrl . "/ar/hotels/" . $row->id . "/" . $pageUrl)
                    ->setLastModificationDate(Carbon::createFromFormat('Y-m-d H:i:s', $row->updated_at))
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                    ->setPriority(0.85)
                    ->addAlternate($appUrl . "/en/hotels/" . $row->id . "/" . $pageUrl, "en"));

        }

        foreach (\Sirb\Place::orderBy('id', 'DESC')->get() as $row) {
            echo "Place-" . $row->id;
            $pageUrl = str_slug($row->{"name:en"});
            $this->sitemap
                ->add(Url::create($appUrl . "/ar/places/" . $row->id . "/" . $pageUrl)
                    ->setLastModificationDate(Carbon::createFromFormat('Y-m-d H:i:s', $row->updated_at))
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                    ->setPriority(0.85)
                    ->addAlternate($appUrl . "/en/places/" . $row->id . "/" . $pageUrl, "en"));

        }

        foreach (\Sirb\Package::orderBy('id', 'DESC')->get() as $row) {
            echo "Package-" . $row->id;
            $pageUrl = str_slug($row->{"name:en"});
            $this->sitemap
                ->add(Url::create($appUrl . "/ar/packages/" . $row->id . "/" . $pageUrl)
                    ->setLastModificationDate(Carbon::createFromFormat('Y-m-d H:i:s', $row->updated_at))
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                    ->setPriority(0.85)
                    ->addAlternate($appUrl . "/en/packages/" . $row->id . "/" . $pageUrl, "en"));


        }

        foreach (\Sirb\PackageType::orderBy('id', 'DESC')->get() as $row) {
            echo "PackageType-" . $row->id;
            $pageUrl = str_slug($row->{"name:en"});
            $this->sitemap
                ->add(Url::create($appUrl . "/ar/packages/type/" . $row->id . "/" . $pageUrl)
                    ->setLastModificationDate(Carbon::createFromFormat('Y-m-d H:i:s', $row->updated_at))
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                    ->setPriority(0.85)
                    ->addAlternate($appUrl . "/en/packages/type/" . $row->id . "/" . $pageUrl, "en"));
        }


        $this->sitemap->writeToFile(public_path('sitemap.xml'));


        \Log::info("sitemap generated successfully at :" . date("Y-m-d H:i:s"));


        function dosdos()
        {
            $sitemap_dosdos = App::make("sitemap");

            $itemap_dosdos->setCache('laravel.sitemap-hotels', 3600);

            $dosdos = \Sirb\dozdoz::orderBy('created_at', 'desc')->get();

            foreach ($dosdos as $row) {
                $pageSlug = str_slug($row->{"name:en"});
                $pageUrl = $appUrl . "/ar/dosdos/" . $row->id . "/" . $pageSlug;
                $pageUrl_en = $appUrl . "/en/dosdos/" . $row->id . "/" . $pageSlug;
                $translations = [
                    ['language' => 'en', 'url' => URL::to($pageUrl_en)],
                ];

                $sitemap_dosdos->add($pageUrl, Carbon::createFromFormat('Y-m-d H:i:s', $row->updated_at), '0.85', 'daily', [], null, $translations);
            }

            return $sitemap_dosdos->render('xml');

        }


    }
}
