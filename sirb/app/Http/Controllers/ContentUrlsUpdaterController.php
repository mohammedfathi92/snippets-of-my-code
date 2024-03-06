<?php

namespace Sirb\Http\Controllers;

use Sirb\Article;
use Sirb\Category;
use Sirb\City;
use Sirb\Country;
use Sirb\Hotel;
use Sirb\Package;
use Sirb\PackageType;
use Sirb\Place;
use Illuminate\Support\Facades\DB;

class ContentUrlsUpdaterController extends Controller
{
    private $domains = ["shawatetravel.com"];

    public function index($type = null)
    {

        $updateType = $type;
        if (!$updateType) {
            die("no type selected");
        }

        switch ($updateType) {
            case "hotels":

                $hotels = DB::table('hotel_translations')->where('locale', 'ar')->get();
//                $bar = $this->output->createProgressBar(count($hotels));

                if ($hotels) {
                    foreach ($hotels as $item) {

                        $content = $item->description;
                        /*echo "content before anything <br/>";
                        echo $content;
                        echo "<br/>";*/
                        preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $content, $match);

                        $content = $this->updateContent($match[0], $content);

                        if ($content) {

                            // update content with new urls.
                            DB::table('hotel_translations')
                                ->where('locale', 'ar')
                                ->where('id', $item->id)
                                ->update(['description' => $content]);

                        }


//                        dd($item->id);
//                        $bar->advance();

                    }
//                    $bar->finish();
                }
                break;
            case "places":
                $places = DB::table('place_translations')->where('locale', 'ar')->get();
//                $bar = $this->output->createProgressBar(count($places));
                if ($places) {
                    foreach ($places as $item) {
                        $content = $item->description;
                        preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $content, $match);
                        $content = $this->updateContent($match[0], $content);
                        // update content with new urls.
                        if ($content) {
                            DB::table('place_translations')
                                ->where('locale', 'ar')
                                ->where('id', $item->id)
                                ->update(['description' => $content]);
                        }

//                        $bar->advance();
                    }
//                    $bar->finish();
                }
                break;
            case "cities":
                $cities = DB::table('city_translations')->where('locale', 'ar')->get();
//                $bar = $this->output->createProgressBar(count($cities));
                if ($cities) {
                    foreach ($cities as $item) {
                        $content = $item->description;
                        preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $content, $match);
                        $content = $this->updateContent($match[0], $content);
                        // update content with new urls.
                        if ($content) {
                            DB::table('city_translations')
                                ->where('locale', 'ar')
                                ->where('id', $item->id)
                                ->update(['description' => $content]);
                        }
//                        $bar->advance();
                    }
//                    $bar->finish();
                }
                break;
            case "countries":
                $countries = DB::table('country_translations')->where('locale', 'ar')->get();
//                $bar = $this->output->createProgressBar(count($countries));
                if ($countries) {
                    foreach ($countries as $item) {
                        //update description
                        $content = $item->description;
                        preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $content, $match);
                        $content = $this->updateContent($match[0], $content);
                        if ($content) {
                            DB::table('country_translations')
                                ->where('locale', 'ar')
                                ->where('id', $item->id)
                                ->update(['description' => $content]);
//

                        }
                        // update guide description
                        $guide = $item->guide;
                        preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $guide, $match2);
                        $guide = $this->updateContent($match2[0], $guide);
                        if ($guide) {
                            DB::table('country_translations')
                                ->where('locale', 'ar')
                                ->where('id', $item->id)
                                ->update(['guide' => $guide]);
//

                        }
                        // update content with new urls.

//                        $bar->advance();
                    }
//                    $bar->finish();
                }
                break;
            case "guides":
                $categories = DB::table('category_translations')->where('locale', 'ar')->get();
//                $bar = $this->output->createProgressBar(count($categories));
                if ($categories) {
                    foreach ($categories as $item) {
                        //update description
                        $content = $item->description;
                        preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $content, $match);
                        $content = $this->updateContent($match[0], $content);
                        if ($content) {
                            DB::table('category_translations')
                                ->where('locale', 'ar')
                                ->where('id', $item->id)
                                ->update(['description' => $content]);
                        }

//                        $bar->advance();
                    }
//                    $bar->finish();
                }
                break;
            case "articles":
                $articles = DB::table('article_translations')->where('locale', 'ar')->get();
//                $bar = $this->output->createProgressBar(count($articles));
                if ($articles) {
                    foreach ($articles as $item) {
                        $content = $item->description;
                        preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $content, $match);
                        $content = $this->updateContent($match[0], $content);
                        // update content with new urls.
                        if ($content) {
                            DB::table('article_translations')
                                ->where('locale', 'ar')
                                ->where('id', $item->id)
                                ->update(['description' => $content]);
                        }
//                        $bar->advance();
                    }
//                    $bar->finish();
                }
                break;
            case "packages":
                $packages = DB::table('package_translations')->where('locale', 'ar')->get();
                if ($packages) {
                    foreach ($packages as $item) {
                        $content = $item->description;
                        preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $content, $match);
                        $content = $this->updateContent($match[0], $content);
                        // update content with new urls.
                        if ($content) {

                            DB::table('package_translations')
                                ->where('locale', 'ar')
                                ->where('id', $item->id)
                                ->update(['description' => $content]);
                        }
                    }
                }
                break;
            case "pages":
                $pages = DB::table('page_translations')->where('locale', 'ar')->get();
//                $bar = $this->output->createProgressBar(count($pages));
                if ($pages) {
                    foreach ($pages as $item) {
                        $content = $item->content;
                        preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $content, $match);
                        $content = $this->updateContent($match[0], $content);
                        // update content with new urls.
                        if ($content) {
                            DB::table('page_translations')
                                ->where('locale', 'ar')
                                ->where('id', $item->id)
                                ->update(['content' => $content]);
                        }
//                        $bar->advance();
                    }
//                    $bar->finish();
                }
                break;
            case "news":
                $news = DB::table('news_translations')->where('locale', 'ar')->get();
//                $bar = $this->output->createProgressBar(count($news));
                if ($news) {
                    foreach ($news as $item) {
                        $content = $item->description;
                        preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $content, $match);
                        $content = $this->updateContent($match[0], $content);
                        // update content with new urls.
                        if ($content) {
                            DB::table('news_translations')
                                ->where('locale', 'ar')
                                ->where('id', $item->id)
                                ->update(['description' => $content]);
                        }
//                        $bar->advance();
                    }
//                    $bar->finish();
                }
                break;
            case "faq":
                $faq = DB::table('faq_question_translations')->where('locale', 'ar')->get();
//                $bar = $this->output->createProgressBar(count($faq));
                if ($faq) {
                    foreach ($faq as $item) {
                        $content = $item->answer;
                        preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $content, $match);
                        $content = $this->updateContent($match[0], $content);
                        // update content with new urls.
                        if ($content) {
                            DB::table('faq_question_translations')
                                ->where('locale', 'ar')
                                ->where('id', $item->id)
                                ->update(['answer' => $content]);
                        }
//                        $bar->advance();
                    }
//                    $bar->finish();
                }
                break;
            default:
                die("$updateType option not available");

        }


    }

    private function updateContent($urls, $content = null)
    {
        $content = $this->translateHotelsUrl($urls, $content);
        $content = $this->translatePlacesUrl($urls, $content);
        $content = $this->translateCitiesUrl($urls, $content);
        $content = $this->translateCountriesUrl($urls, $content);
        $content = $this->translatePackagesUrl($urls, $content);
        $content = $this->translatGuidesUrl($urls, $content);

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
                    echo("Hotel url updated <br/>");
                    echo ($url . " => " . $newUrl) . " <br/>";
                    $content = str_replace($url, $newUrl, $content);

                }

                //main hotels page
                if (isset($urlItems[4]) && $urlItems[4] == 'hotels' && !isset($urlItems[5])) {
                    $newUrl = $urlItems[0] . "//" . $urlItems[2] . "/hotels";
                    echo("Main Hotels url updated <br/>");
                    echo ($url . " => " . $newUrl) . " <br/>";
                    $content = str_replace($url, $newUrl, $content);

                }
                //in case no language in url
                if ((isset($urlItems[3]) && $urlItems[3] == 'hotels') && isset($urlItems[4])) {
//                    replace the current with new translated url
                    $id = $urlItems[4];

                    $urlData = Hotel::find($id);
                    $newUrl = $urlItems[0] . "//" . $urlItems[2] . "/hotels/" . $urlData->id . "/" . make_slug($urlData->{"name:ar"});
                    echo("Hotel url updated <br/>");
                    echo ($url . " => " . $newUrl) . " <br/>";
                    $content = str_replace($url, $newUrl, $content);

                }

            }
        }
        return $content;
    }

    private function translatePackagesUrl($urls, $content = null)
    {
        //  if no matches urls return false
        if (!$urls) return $content;

        // loop all founded urls
        foreach ($urls as $url) {
            $urlItems = explode("/", $url);
            // check if the current url is the target url.
            if (isset($urlItems[2]) && in_array($urlItems[2], $this->domains)) {

//                check if the current url is package url in arabic language.
                if ((isset($urlItems[4]) && $urlItems[4] == 'packages') && (isset($urlItems[3]) && $urlItems[3] == 'ar') && isset($urlItems[5]) && !$urlItems[5]=='type') {
//                    replace the current with new translated url
                    $id = $urlItems[5];

                    $urlData = Package::find($id);
                    if($urlData){

                        $newUrl = $urlItems[0] . "//" . $urlItems[2] . "/packages/" . $urlData->id . "/" . make_slug($urlData->{"name:ar"});
                        echo("Package url updated <br/>");
                        echo ($url . " => " . $newUrl) . " <br/>";
                        $content = str_replace($url, $newUrl, $content);
                    }

                }
                // update packages types
                if ((isset($urlItems[4]) && $urlItems[4] == 'packages') && (isset($urlItems[3]) && $urlItems[3] == 'ar') && isset($urlItems[5]) && $urlItems[5]=='type' && isset($urlItems[6])) {
//                    replace the current with new translated url
                    $id = $urlItems[6];

                    $urlData = PackageType::find($id);
                    if($urlData){

                        $newUrl = $urlItems[0] . "//" . $urlItems[2] . "/packages/type/" . $urlData->id . "/" . make_slug($urlData->{"name:ar"});
                        echo("Package type url updated <br/>");
                        echo ($url . " => " . $newUrl) . " <br/>";
                        $content = str_replace($url, $newUrl, $content);
                    }

                }

                //main packages page
                if (isset($urlItems[4]) && $urlItems[4] == 'packages' && !isset($urlItems[5])) {
                    $newUrl = $urlItems[0] . "//" . $urlItems[2] . "/packages";
                    echo("Main Packages url updated <br/>");
                    echo ($url . " => " . $newUrl) . " <br/>";
                    $content = str_replace($url, $newUrl, $content);

                }
            }
        }
        return $content;
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
                    echo("Place url updated <br/>");
                    echo ($url . " => " . $newUrl) . "  <br/>";

                    $content = str_replace($url, $newUrl, $content);
                }

//                check if the current url is hotel url in arabic language.
                if ((isset($urlItems[3]) && $urlItems[3] == 'places') && isset($urlItems[4])) {
//                    replace the current with new translated url

                    $id = $urlItems[4];
                    $urlData = Place::find($id);
                    $newUrl = $urlItems[0] . "//" . $urlItems[2] . "/places/" . $urlData->id . "/" . make_slug($urlData->{"name:ar"});
                    echo("Place url updated <br/>");
                    echo ($url . " => " . $newUrl) . "  <br/>";

                    $content = str_replace($url, $newUrl, $content);
                }

                //main places page
                if (isset($urlItems[4]) && $urlItems[4] == 'places' && !isset($urlItems[5])) {
                    $newUrl = $urlItems[0] . "//" . $urlItems[2] . "/places";
                    echo("Main Places url updated <br/>");
                    echo ($url . " => " . $newUrl) . " <br/>";
                    $content = str_replace($url, $newUrl, $content);

                }
            }
        }
        return $content;
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
                    echo("City url updated  <br/>");
                    echo ($url . " => " . $newUrl) . "  <br/>";
                    $content = str_replace($url, $newUrl, $content);
                }

//                in case no language in url
                if ((isset($urlItems[3]) && $urlItems[3] == 'city') && isset($urlItems[4])) {
//                    replace the current with new translated url
                    $id = $urlItems[4];
                    $urlData = City::find($id);
                    $newUrl = $urlItems[0] . "//" . $urlItems[2] . "/city/" . $urlData->id . "/" . make_slug($urlData->{"name:ar"});

                    // append any more segements in the url
                    if (isset($urlItems[6])) {
                        $newUrl .= "/" . $urlItems[6];
                    }
                    echo("City url updated  <br/>");
                    echo ($url . " => " . $newUrl) . "  <br/>";
                    $content = str_replace($url, $newUrl, $content);
                }

            }
        }
        return $content;
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
                    echo("Country url updated <br/>");
                    echo ($url . " => " . $newUrl) . "  <br/>";
                    $content = str_replace($url, $newUrl, $content);
                }

//                do same previos code in case no language in url.
                if (isset($urlItems[3]) && $urlItems[3] == 'country' && isset($urlItems[4])) {
//                    replace the current with new translated url
                    $id = $urlItems[4];
                    $urlData = Country::find($id);
                    $newUrl = $urlItems[0] . "//" . $urlItems[2] . "/country/" . $urlData->id . "/" . make_slug($urlData->{"name:ar"});

                    if (isset($urlItems[6])) {
                        $newUrl .= "/" . $urlItems[6];
                    }
                    echo("Country url updated <br/>");
                    echo ($url . " => " . $newUrl) . "  <br/>";
                    $content = str_replace($url, $newUrl, $content);
                }

            }


        }
        return $content;
    }

    private function translatGuidesUrl($urls, $content = null)
    {

        //  if no matches urls return false
        if (!$urls) return $content;

        // loop all founded urls
        foreach ($urls as $url) {
            $urlItems = explode("/", $url);
            // check if the current url is the target url.
            if (isset($urlItems[2]) && in_array($urlItems[2], $this->domains)) {

//                check if the current url is hotel url in arabic language.
                if ((isset($urlItems[3]) && $urlItems[3] == 'ar') && (isset($urlItems[4]) && $urlItems[4] == 'guide') && (isset($urlItems[5]) && $urlItems[5] !='type' )  ) {
//                    replace the current with new translated url

                    $id = $urlItems[5];
                    $urlData = Category::find($id);
                    $newUrl = $urlItems[0] . "//" . $urlItems[2] . "/guide/" . $urlData->id . "/" . make_slug($urlData->{"name:ar"});
                    echo("Guide url updated <br/>");
                    echo ($url . " => " . $newUrl) . "  <br/>";

                    $content = str_replace($url, $newUrl, $content);
                }
                //it's a topic url not guide url.
                if ((isset($urlItems[3]) && $urlItems[3] == 'ar') && isset($urlItems[6]) && $urlItems[6] == 'topic' && isset($urlItems[7])) {
                    $id = $urlItems[7];
                    $urlData = Article::find($id);
                    $newUrl = $urlItems[0] . "//" . $urlItems[2] . "/guide/" . $urlItems[5] . "/topic/".$id."/" . make_slug($urlData->{"name:ar"});
                    echo("topic url updated <br/>");
                    echo ($url . " => " . $newUrl) . "  <br/>";

                    $content = str_replace($url, $newUrl, $content);
                }
            }
        }
        return $content;
    }

}
