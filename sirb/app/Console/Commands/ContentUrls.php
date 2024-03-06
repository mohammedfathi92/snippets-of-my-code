<?php

namespace Sirb\Console\Commands;

use Sirb\City;
use Sirb\Country;
use Sirb\Hotel;
use Sirb\Place;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ContentUrls extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'content-urls:update {type?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'content urls updater';

    private $domains = ["shawatetravel.com"];

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $updateType = $this->argument('type');
        if (!$updateType) {
            //        Types List
            $typesList = ['hotels', 'places', 'cities', 'countries', 'articles', 'packages', 'news', 'faq'];
            $updateType = $name = $this->anticipate('What you want to update?', $typesList);

        }

        switch ($updateType) {
            case "hotels":
                $hotels = DB::table('hotel_translations')->where('locale', 'ar')->get();
                $bar = $this->output->createProgressBar(count($hotels));

                if ($hotels) {
                    foreach ($hotels as $item) {
                        $content = $item->description;
                        preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $content, $match);

                        $content = $this->updateContent($match[0], $content);

                        // update content with new urls.
                        DB::table('hotel_translations')
                            ->where('locale', 'ar')
                            ->where('id', $item->id)
                            ->update(['description' => $content]);
                        $bar->advance();

                    }
                    $bar->finish();
                }
                break;
            case "places":
                $places = DB::table('place_translations')->where('locale', 'ar')->get();
                $bar = $this->output->createProgressBar(count($places));
                if ($places) {
                    foreach ($places as $item) {
                        $content = $item->description;
                        preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $content, $match);
                        $content = $this->updateContent($match[0], $content);
                        // update content with new urls.
                        DB::table('place_translations')
                            ->where('locale', 'ar')
                            ->where('id', $item->id)
                            ->update(['description' => $content]);
                        $bar->advance();
                    }
                    $bar->finish();
                }
                break;
            case "cities":
                $cities = DB::table('city_translations')->where('locale', 'ar')->get();
                $bar = $this->output->createProgressBar(count($cities));
                if ($cities) {
                    foreach ($cities as $item) {
                        $content = $item->description;
                        preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $content, $match);
                        $content = $this->updateContent($match[0], $content);
                        // update content with new urls.
                        DB::table('city_translations')
                            ->where('locale', 'ar')
                            ->where('id', $item->id)
                            ->update(['description' => $content]);
                        $bar->advance();
                    }
                    $bar->finish();
                }
                break;
            case "countries":
                $countries = DB::table('country_translations')->where('locale', 'ar')->get();
                $bar = $this->output->createProgressBar(count($countries));
                if ($countries) {
                    foreach ($countries as $item) {
                        //update description
                        $content = $item->description;
                        preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $content, $match);
                        $content = $this->updateContent($match[0], $content);

                        // update guide description
                        $guide = $item->guide;
                        preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $guide, $match2);
                        $guide = $this->updateContent($match2[0], $guide);

                        // update content with new urls.
                        DB::table('country_translations')
                            ->where('locale', 'ar')
                            ->where('id', $item->id)
                            ->update(['description' => $content, 'guide' => $guide]);
                        $bar->advance();
                    }
                    $bar->finish();
                }
                break;
            case "articles":
                $articles = DB::table('article_translations')->where('locale', 'ar')->get();
                $bar = $this->output->createProgressBar(count($articles));
                if ($articles) {
                    foreach ($articles as $item) {
                        $content = $item->description;
                        preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $content, $match);
                        $content = $this->updateContent($match[0], $content);
                        // update content with new urls.
                        DB::table('article_translations')
                            ->where('locale', 'ar')
                            ->where('id', $item->id)
                            ->update(['description' => $content]);
                        $bar->advance();
                    }
                    $bar->finish();
                }
                break;
            case "packages":
                $packages = DB::table('package_translations')->where('locale', 'ar')->get();
                $bar = $this->output->createProgressBar(count($packages));
                if ($packages) {
                    foreach ($packages as $item) {
                        $content = $item->description;
                        preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $content, $match);
                        $content = $this->updateContent($match[0], $content);
                        // update content with new urls.
                        DB::table('package_translations')
                            ->where('locale', 'ar')
                            ->where('id', $item->id)
                            ->update(['description' => $content]);
                        $bar->advance();
                    }
                    $bar->finish();
                }
                break;
            case "news":
                $news = DB::table('news_translations')->where('locale', 'ar')->get();
                $bar = $this->output->createProgressBar(count($news));
                if ($news) {
                    foreach ($news as $item) {
                        $content = $item->description;
                        preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $content, $match);
                        $content = $this->updateContent($match[0], $content);
                        // update content with new urls.
                        DB::table('news_translations')
                            ->where('locale', 'ar')
                            ->where('id', $item->id)
                            ->update(['description' => $content]);
                        $bar->advance();
                    }
                    $bar->finish();
                }
                break;
            case "faq":
                $faq = DB::table('faq_question_translations')->where('locale', 'ar')->get();
                $bar = $this->output->createProgressBar(count($faq));
                if ($faq) {
                    foreach ($faq as $item) {
                        $content = $item->answer;
                        preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $content, $match);
                        $content = $this->updateContent($match[0], $content);
                        // update content with new urls.
                        DB::table('faq_question_translations')
                            ->where('locale', 'ar')
                            ->where('id', $item->id)
                            ->update(['answer' => $content]);
                        $bar->advance();
                    }
                    $bar->finish();
                }
                break;
            default:
                $this->error("$updateType option not available");

        }


    }

    private function updateContent($urls, $content)
    {
        $content = $this->translateHotelsUrl($urls, $content);
        $content = $this->translatePlacesUrl($urls, $content);
        $content = $this->translateCitiesUrl($urls, $content);
        $content = $this->translateCountriesUrl($urls, $content);
        return $content;
    }

    private function translateHotelsUrl($urls, $content = null)
    {
        //  if no matches urls return false
        if (!$urls) return $content;

        // loop all founded urls
        foreach ($urls as $url) {
            $urlItems = explode("/", $url);
            // check if the current url is the target url.
            if (isset($urlItems[2]) && in_array($urlItems[2], $this->domains)) {

//                check if the current url is hotel url in arabic language.
                if ((isset($urlItems[4]) && $urlItems[4] == 'hotels') && (isset($urlItems[3]) && $urlItems[3] == 'ar') && isset($urlItems[5])) {
//                    replace the current with new translated url
                    $id = $urlItems[5];
                    $urlData = Hotel::find($id);
                    $newUrl = $urlItems[0] . "//" . $urlItems[2] . "/hotels/" . $urlData->id . "/" . make_slug($urlData->{"name:ar"});
                    $this->info("Hotel url updated");
                    $this->line($url . " => " . $newUrl);
                    return str_replace($url, $newUrl, $content);

                }
            }
        }

    }

    private function translatePlacesUrl($urls, $content = null)
    {
        //  if no matches urls return false
        if (!$urls) return $content;

        // loop all founded urls
        foreach ($urls as $url) {
            $urlItems = explode("/", $url);
            // check if the current url is the target url.
            if (isset($urlItems[2]) && in_array($urlItems[2], $this->domains)) {

//                check if the current url is hotel url in arabic language.
                if ((isset($urlItems[4]) && $urlItems[4] == 'places') && (isset($urlItems[3]) && $urlItems[3] == 'ar') && isset($urlItems[5])) {
//                    replace the current with new translated url
                    $id = $urlItems[5];
                    $urlData = Place::find($id);
                    $newUrl = $urlItems[0] . "//" . $urlItems[2] . "/places/" . $urlData->id . "/" . make_slug($urlData->{"name:ar"});
                    $this->info("Place url updated");
                    $this->line($url . " => " . $newUrl);
                    return str_replace($url, $newUrl, $content);
                }
            }
        }

    }

    private function translateCitiesUrl($urls, $content = null)
    {
        //  if no matches urls return false
        if (!$urls) return $content;

        // loop all founded urls
        foreach ($urls as $url) {
            $urlItems = explode("/", $url);
            // check if the current url is the target url.
            if (isset($urlItems[2]) && in_array($urlItems[2], $this->domains)) {

//                check if the current url is hotel url in arabic language.
                if ((isset($urlItems[4]) && $urlItems[4] == 'city') && (isset($urlItems[3]) && $urlItems[3] == 'ar') && isset($urlItems[5])) {
//                    replace the current with new translated url
                    $id = $urlItems[5];
                    $urlData = City::find($id);
                    $newUrl = $urlItems[0] . "//" . $urlItems[2] . "/city/" . $urlData->id . "/" . make_slug($urlData->{"name:ar"});

                    if (isset($urlItems[7])) {
                        $newUrl .= "/" . $urlItems[7];
                    }
                    $this->info("City url updated");
                    $this->line($url . " => " . $newUrl);
                    return str_replace($url, $newUrl, $content);
                }
            }
        }

    }

    private function translateCountriesUrl($urls, $content = null)
    {
        //  if no matches urls return false
        if (!$urls) return $content;

        // loop all founded urls
        foreach ($urls as $url) {
            $urlItems = explode("/", $url);
            // check if the current url is the target url.
            if (isset($urlItems[2]) && in_array($urlItems[2], $this->domains)) {

//                check if the current url is hotel url in arabic language.
                if ((isset($urlItems[4]) && $urlItems[4] == 'country') && (isset($urlItems[3]) && $urlItems[3] == 'ar') && isset($urlItems[5])) {
//                    replace the current with new translated url
                    $id = $urlItems[5];
                    $urlData = Country::find($id);
                    $newUrl = $urlItems[0] . "//" . $urlItems[2] . "/country/" . $urlData->id . "/" . make_slug($urlData->{"name:ar"});

                    if (isset($urlItems[7])) {
                        $newUrl .= "/" . $urlItems[7];
                    }
                    $this->info("Country url updated");
                    $this->line($url . " => " . $newUrl);
                    return str_replace($url, $newUrl, $content);
                }
            }
        }

    }


}
