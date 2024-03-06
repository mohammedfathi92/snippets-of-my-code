<?php

namespace Sirb\Jobs;


use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;


class AddUrlToSitemap implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $url;
    protected $lastUpdate;
    protected $periority;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($url, $lastUpdate, $periority = "0.9")
    {
        $this->url = $url;
        $this->lastUpdate = $lastUpdate;
        $this->periority = $periority;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $pageUrl = trim($this->url, "/");
        $appUrl = env('APP_URL') ?: \Settings::get('url');
        $replacedWords = ["www.", "http://", "https://"];
        $newWords = ["", "", ""];
        $newAppUrl = str_replace($replacedWords, $newWords, $appUrl);


        $varItems = [
            ["prot" => 'https://', 'locale' => '/ar/'],
            ["prot" => 'https://', 'locale' => '/en/'],
            ["prot" => 'http://', 'locale' => '/ar/'],
            ["prot" => 'http://', 'locale' => '/en/']
        ];

        $file = public_path('sitemap.xml');

        $xml = simplexml_load_file($file);

//  foreach ($varItems as $item) {
// // $url = $xml->addChild('url');
// // $url->addChild('loc', $item["prot"] . $newAppUrl . $item["locale"] . $pageUrl);
// // $url->addChild('lastmod', Carbon::createFromFormat('Y-m-d H:i:s', $this->lastUpdate));
// // $url->addChild('changefreq', 'daily');
// // $url->addChild('priority', '0.9');
// // $xml->asXML($file);
// }  


// $site = "https://" . trim(trim(env("APP_URL", Setting::get("url")), "http://"), "https://");
//         SitemapGenerator::create($site)
//             ->getSitemap()
//             ->add(Url::create("/ar/" . trim($this->url, "/"))
//                 ->setPriority($this->periority)
//                 ->addAlternate("/en/" . trim($this->url, "/"),"en")
//                 ->writeToFile("sitemap.xml");


        $urlForms = ['https://' . $newAppUrl . '/ar/' . $pageUrl, 'http://' . $newAppUrl . '/ar/' . $pageUrl, 'https://' . $newAppUrl . '/en/' . $pageUrl, 'http://' . $newAppUrl . '/en/' . $pageUrl];

        foreach ($xml->children() as $urls) {


            if (in_array($urls->loc, $urlForms)) {

                foreach ($varItems as $item) {

                    $urls->loc = $item["prot"] . $newAppUrl . $item["locale"] . $pageUrl;
                    $urls->lastmod = Carbon::createFromFormat('Y-m-d H:i:s', $this->lastUpdate);

                    $xml->asXML($file);
                }
//}


            }

        }

    }
}
