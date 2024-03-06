<?php
/**
 * Created by PhpStorm.
 * User: mohammed
 * Date: 12/29/16
 * Time: 2:13 AM
 */

namespace Sirb\Http\Controllers;

use Sirb\Country;
use Sirb\Mail\NewTestimonialMessage;
use Sirb\Media;
use Sirb\Setting;
use Sirb\Testimonial;
use Sirb\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Waavi\ReCaptcha\Facades\ReCaptcha;

class TestimonialsController extends Controller
{

    function index()
    {
        $this->data['data'] = Testimonial::published()->whereType("text")->orderBy("updated_at", 'desc')->paginate(20);
        $this->data['title'] = trans("testimonials.page_title") . " - " . $this->data['title'];
        return view("frontend.testimonials.index", $this->data);
    }

    function destination($id = 0, $slug = null)
    {
        $country = Country::find($id);
        if (!$country)
            return abort(404);

        $this->data['data'] = $country->testimonials()->whereStatus(true)->whereType("text")->orderBy("updated_at", 'desc')->paginate(10);
        $this->data['country'] = $country;
        $this->data['title'] = trans("testimonials.page_title") . " - " . $this->data['title'];
        return view("frontend.testimonials.index", $this->data);
    }

    function videosDestination($id = 0, $slug = null)
    {
        $country = Country::find($id);
        if (!$country)
            return abort(404);

        $this->data['data'] = $country->testimonials()->whereStatus(true)->whereType("video")->orderBy("updated_at", 'desc')->paginate(10);
        $this->data['country'] = $country;
        $this->data['title'] = trans("testimonials.page_title") . " - " . $this->data['title'];
        return view("frontend.testimonials.videos", $this->data);
    }

    function create()
    {
        $this->data['title'] = trans("testimonials.frontend_title_create") . " - " . $this->data['title'];
        return view("frontend.testimonials.create", $this->data);
    }

    function videos()
    {
        $this->data['data'] = Testimonial::published()->whereType("video")->orderBy("updated_at", 'desc')->paginate(20);
        $this->data['title'] = trans("testimonials.page_title") . " - " . $this->data['title'];
        return view("frontend.testimonials.videos", $this->data);
    }

    function store(Request $request)
    {
        $rules = [];


        $rules["title"] = "required|max:255";
        $rules["name"] = "required|max:255";
        $rules["email"] = "required|max:255";
        $rules["nationality"] = "required|max:255";
        $rules["country"] = "required";

        $gResponse = ReCaptcha::parseInput($request->input('g-recaptcha-response'));

        if (!$gResponse->isSuccess()) {
            return redirect()->back()->with(['message' => trans("main.captcha_not_valid"), 'alert-type' => 'error'])->withInput();
        }
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $testimonial = new Testimonial();

        $testimonial->in_home = (boolean)$request->input('in_home');
        $testimonial->status = (boolean)$request->input('status');
        $testimonial->type = $request->input('type') == "video" ?: "text";
        $testimonial->email = $request->input('email') ?: null;
        $testimonial->trip_type = $request->input('trip_type') ?: 1;
        $testimonial->video_url = $request->input('video_url') ?: null;
        $testimonial->country_id = (int)$request->input('country');


        $testimonial->avatar = $request->input('avatar') ?: null;


        if ($testimonial->save()) {

            foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
                $testimonial->translateOrNew($locale)->title = $request->input('title');
                $testimonial->translateOrNew($locale)->visitor_name = $request->input('name');
                $testimonial->translateOrNew($locale)->nationality = $request->input('nationality');
                $testimonial->translateOrNew($locale)->description = $request->input('description');
            }

            $testimonial->save();

            if ($request->input("gallery") and is_array($request->input("gallery"))) {
                $gallery = [];
                foreach ($request->input("gallery") as $image) {

                    $upload_dir = config("settings.upload_dir");
                    $upload_path = config("settings.upload_path");

                    if (Storage::disk("public")->exists($upload_dir . "/$image")) {
                        $ext = File::extension($upload_path . "/$image");
                        $mim = File::mimeType($upload_path . "/$image");
                        $gallery[] = [
                            'title'     => $image,
                            'name'      => $image,
                            'full_path' => Storage::url($upload_dir . "/$image"),
                            'extension' => $ext,
                            'mime_type' => $mim,
                            'module'    => 'testimonials',
                            'key'       => 'testimonial-gallery',
                            'module_id' => $testimonial->id,
                        ];
                    }

                }

                Media::insert($gallery);
            }
            // send email notification to receivers in settings
            $emails = explode(PHP_EOL, settings("receivers_emails"));
            if ($emails && is_array($emails)) {
                $emails = array_map('trim', $emails);

                Mail::to($emails)->send(new NewTestimonialMessage($testimonial));
            }
        }

        return redirect("/testimonials/thank_you")->with(['testimonial_status' => true, 'message' => trans("testimonials.success_created"), 'alert-type' => 'success']);


    }

    function thank_you()
    {

        if (!Session::get("testimonial_status") == true) {
            return redirect("/");
        }
        return view("frontend.testimonials.thankyou", $this->data);
    }

}
