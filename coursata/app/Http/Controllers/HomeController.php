<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 12/29/16
 * Time: 2:13 AM
 */

namespace Corsata\Http\Controllers;

use Corsata\Country;
use Corsata\Course;
use Corsata\Http\Controllers\Controller;
use Corsata\Institute;

class HomeController extends Controller
{
    function index()
    {
        $this->data['topCountries'] = Country::whereHas("institutes", function ($query) {
            $query->whereStatus(true);
        })->whereStatus(true)->take(6)->get();

        $this->data['featuredCourses'] = Course::whereStatus(true)
            ->where("in_home", true)->take(6)->get();
        $this->data['homeInstitutes'] = Institute::where("in_home", true)->orderBy("updated_at", "desc")->take(6)->get();
        return view("frontend.home.index", $this->data);
    }
}