<?php
/**
 * Created by PhpStorm.
 * User: mohammed
 * Date: 12/29/16
 * Time: 2:13 AM
 */

namespace Sirb\Http\Controllers;


use Sirb\News;
use Sirb\Package;
use Sirb\Setting;
use Sirb\Http\Controllers\Controller;
use Sirb\Testimonial;
use Illuminate\Support\Facades\Storage;
use Spatie\SchemaOrg\Schema;

class HomeController extends Controller
{
    function index()
    {
        $this->data['googleSchema'] = $this->googleSchemaScript();
        $this->data['packages'] = Package::inHome()->get();

        $this->data['testimonials_videos'] = Testimonial::whereType('video')->inHome()->get();
        $this->data['testimonials_text'] = Testimonial::published()
            ->whereType("text")
            ->orderBy("updated_at", 'desc')
            ->limit(10)->get();
        $this->data['news'] = News::inHome()->get();

        return view("frontend.home.index", $this->data);
    }

    function googleSchemaScript()
    {
        return Schema::localBusiness()
            ->name(settings("title"))
            ->email(settings('site_email'))
            ->contactPoint(Schema::contactPoint()
                ->telephone($this->phone)
                ->email(settings("help_email"))
                ->areaServed('Worldwide')
                ->contactType("customer support"))
            ->setProperty('openingHoursSpecification', [
                'dayOfWeek' => [
                    "Monday",
                    "Tuesday",
                    "Wednesday",
                    "Thursday",
                    "Friday",
                    "Saturday",
                    "Sunday"
                ],
                "opens"     => "10:00",
                "closes"    => "23:00"
            ])
            ->telephone($this->phone)
            ->url(url("/"))
            ->image(url(Storage::url(settings("logo"))))
            ->logo(url(Storage::url(settings("logo"))));
    }

}
