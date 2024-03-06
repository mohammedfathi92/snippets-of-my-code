<?php

namespace App\Http\Controllers\backend;

use App\City;
use App\Country;
use App\Hotel;
use App\Http\Controllers\BreadController;
use App\Room;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Excel;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Setting;
use Illuminate\Http\Request;
use \Storage;
use Settings;

class SettingsController extends BackendBaseController
{
    protected $coreSettings = ['backend_uri', 'seo_tags', 'seo_description', 'title', 'logo', 'favicon'];

    public function index()
    {

        $this->data['settings'] = Setting::orderBy('order', 'ASC')->get();
        $this->data['core_settings'] = $this->coreSettings;
        return view('backend.settings.index', $this->data);
    }

    public function create(Request $request)
    {
        $last_setting = Setting::orderBy('order', 'DESC')->first();
        $order = intval($last_setting->order) + 1;
        $request->merge(['order' => $order]);
        $request->merge(['value' => '']);
        Setting::create($request->all());
        return redirect(Settings::get('backend_uri') . "/settings")->with(['message' => 'Successfully Created New Setting', 'alert-type' => 'success']);
    }

    public function delete(Request $request, $id)
    {

        $setting = Setting::find($id);

        if ($setting && !in_array($setting->key, $this->coreSettings)) {
            $setting->delete();
            return redirect(Settings::get('backend_uri') . "/settings")->with(['message' => 'Successfully Deleted Setting', 'alert-type' => 'success']);
        }

        return redirect(Settings::get('backend_uri') . "/settings")->with(['message' => "Not allowed to delete $setting->display_name  Setting", 'alert-type' => 'error']);
    }

    public function move_up(Request $request, $id)
    {
        $setting = Setting::find($id);
        $swap_order = $setting->order;

        $previous_setting = Setting::where('order', '<', $swap_order)->orderBy('order', 'DESC')->first();

        if (isset($previous_setting->order)) {
            $setting->order = $previous_setting->order;
            $setting->save();
            $previous_setting->order = $swap_order;
            $previous_setting->save();

            return redirect(Settings::get('backend_uri') . "/settings")->with(['message' => 'Moved ' . $setting->display_name . ' setting order up', 'alert-type' => 'success']);
        } else {
            return redirect(Settings::get('backend_uri') . "/settings")->with(['message' => 'This is already at the top of the list', 'alert-type' => 'error']);
        }
    }

    public function delete_value($id)
    {
        $setting = Setting::find($id);
        if (isset($setting->id)) {
            // If the type is an image... Then delete it
            if ($setting->type == 'image') {
                if (Storage::exists(config('settings.upload_path') . $setting->value)) {
                    Storage::delete(config('settings.upload_path') . $setting->value);
                }
            }
            $setting->value = '';
            $setting->save();
        }
        return redirect(Settings::get('backend_uri') . "/settings")->with(['message' => 'Successfully removed ' . $setting->display_name . ' value', 'alert-type' => 'success']);
    }

    public function move_down(Request $request, $id)
    {
        $setting = Setting::find($id);
        $swap_order = $setting->order;

        $previous_setting = Setting::where('order', '>', $swap_order)->orderBy('order', 'ASC')->first();

        if (isset($previous_setting->order)) {
            $setting->order = $previous_setting->order;
            $setting->save();
            $previous_setting->order = $swap_order;
            $previous_setting->save();

            return redirect(Settings::get('backend_uri') . "/settings")->with(['message' => 'Moved ' . $setting->display_name . ' setting order down', 'alert-type' => 'success']);
        } else {
            return redirect(Settings::get('backend_uri') . "/settings")->with(['message' => 'This is already at the bottom of the list', 'alert-type' => 'error']);
        }
    }

    public function save(Request $request)
    {

        $settings = Setting::all();
        $breadController = new BreadController($request);

        foreach ($settings as $setting) {
            $rows = [];
            $row = ['type' => $setting->type, 'field' => $setting->key, 'details' => $setting->details];
            $content = $breadController->getContentBasedOnType($request, 'settings', (object)$row);

            if ($content === NULL) {
                if (isset($setting->value)) {
                    $content = $setting->value;
                }
            }

            $setting->value = $content;
            $setting->save();
        }

        return redirect(Settings::get('backend_uri') . "/settings")->with(['message' => 'Successfully Saved Settings', 'alert-type' => 'success']);


    }

    public function importAllData(Request $request)
    {
        $rules = [
            'importExcel' => 'required',
        ];


        $validator = Validator::make($request->all(), $rules);
        // process the form
        if ($validator->fails()) {
            return redirect(Settings::get('backend_uri') . "/settings#import-site-data")->with(['message' => 'Importing Data Error', 'alert-type' => 'error'])->withErrors($validator);
        }

        try {
            $excelFile = $request->hasFile("importExcel") ? $request->file('importExcel')->getRealPath() : null;
            if ($excelFile !== null) {
                $sheets = [];
                \Maatwebsite\Excel\Facades\Excel::load($excelFile, function ($reader) {

                    $reader->each(function ($sheet) {

//                        Insert countries Data
                        if ("countries" == strtolower($sheet->getTitle())) {
                            foreach ($sheet->toArray() as $i => $row) {
                                $id = 0;

                                $photo = "default-data-photo.jpg";

                                if (isset($row['country_id'])) {
                                    $id = (int)$row['country_id'];
                                }

                                if ($id) {

                                    $record = Country::firstOrNew(['id' => $id]);
                                    $record->id = $id;
                                    $record->photo = $photo;
                                    $record->save();
                                    foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
                                        if (isset($row["name_$locale"]) && $row["name_$locale"]) {
                                            $record->translateOrNew($locale)->name = $row["name_$locale"];
                                        }
                                    }
                                    $record->save();
                                }
                            }

                        }


//                        Insert Cities Data
                        if ("cities" == strtolower($sheet->getTitle())) {
                            foreach ($sheet->toArray() as $i => $row) {
                                $id = 0;
                                $country_id = $i + 1;
                                $photo = "default-data-photo.jpg";

                                if (isset($row['city_id'])) {
                                    $id = (int)$row['city_id'];
                                }
                                if (isset($row['country_id'])) {
                                    $country_id = (int)$row['country_id'];
                                }
                                if ($id) {

                                    $record = City::firstOrNew(['id' => $id]);
                                    $record->id = $id;
                                    $record->photo = $photo;
                                    $record->country_id = $country_id;
                                    $record->save();
                                    foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
                                        if (isset($row["name_$locale"]) && $row["name_$locale"]) {
                                            $record->translateOrNew($locale)->name = $row["name_$locale"];
                                        }
                                    }
                                    $record->save();
                                }
                            }

                        }


//                        Insert Hotels Data
                        if ("hotels" == strtolower($sheet->getTitle())) {
                            foreach ($sheet->toArray() as $i => $row) {
                                $id = 0;
                                $country_id = $i + 1;
                                $city_id = $i + 1;
                                $address = "";
                                $photo = "default-data-photo.jpg";

                                if (isset($row['hotel_id'])) {
                                    $id = (int)$row['hotel_id'];
                                }

                                if (isset($row['city_id'])) {
                                    $city_id = (int)$row['city_id'];
                                }

                                if (isset($row['country_id'])) {
                                    $country_id = (int)$row['country_id'];
                                }
                                if (isset($row['address'])) {
                                    $address = (int)$row['address'];
                                }

                                if ($id) {

                                    $record = Hotel::firstOrNew(['id' => $id]);
                                    $record->id = $id;
                                    $record->photo = $photo;
                                    $record->country_id = $country_id;
                                    $record->city_id = $city_id;
                                    $record->address = $address;
                                    $record->save();
                                    foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
                                        if (isset($row["name_$locale"]) && $row["name_$locale"]) {
                                            $record->translateOrNew($locale)->name = $row["name_$locale"];
                                        }
                                    }
                                    $record->save();
                                }
                            }

                        }


//                        Insert Rooms Data
                        if ("rooms" == strtolower($sheet->getTitle())) {
                            foreach ($sheet->toArray() as $i => $row) {
                                $id = 0;
                                $hotel_id = $i + 1;
                                $photo = "default-data-photo.jpg";

                                if (isset($row['room_id'])) {
                                    $id = (int)$row['room_id'];
                                }

                                if (isset($row['hotel_id'])) {
                                    $hotel_id = (int)$row['hotel_id'];
                                }


                                if ($id) {
                                    $record = Room::firstOrNew(['id' => $id]);
                                    $record->id = $id;
                                    $record->photo = $photo;
                                    $record->hotel_id = $hotel_id;
                                    $record->save();
                                    foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
                                        if (isset($row["name_$locale"]) && $row["name_$locale"]) {
                                            $record->translateOrNew($locale)->name = $row["name_$locale"];
                                        }
                                        if (isset($row["description_$locale"]) && $row["description_$locale"]) {
                                            $record->translateOrNew($locale)->description = $row["description_$locale"];
                                        }
                                    }
                                    $record->save();
                                }
                            }

                        }


                    });

                });

                return redirect(Settings::get('backend_uri') . "/settings#import-site-data")->with(['message' => 'All Data Imported Successfully', 'alert-type' => 'success']);
            }

            return redirect(Settings::get('backend_uri') . "/settings#import-site-data")->with(['message' => 'Error: data not Imported .. tray again', 'alert-type' => 'error']);
        } catch (\Exception $e) {
            return redirect(Settings::get('backend_uri') . "/settings#import-site-data")->with(['message' => $e->getMessage(), 'alert-type' => 'error']);
        }

    }

}

