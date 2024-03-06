<?php

namespace Corsata\Http\Controllers\backend;

use Corsata\Http\Controllers\BreadController;
use \Redirect as Redirect;
use Corsata\Setting;
use Illuminate\Http\Request;
use \Storage;
use Settings;

class SettingsController extends BackendBaseController
{
    protected $coreSettings = ['backend_uri', 'seo_tags', 'seo_description', 'title', 'logo','favicon'];

    public function index()
    {

        $this->data['settings'] = Setting::orderBy('order', 'ASC')->get();
        $this->data['core_settings']=$this->coreSettings;
        return view('backend.settings.index', $this->data);
    }

    public function create(Request $request)
    {
        $last_setting = Setting::orderBy('order', 'DESC')->first();
        $order = intval($last_setting->order) + 1;
        $request->merge(['order' => $order]);
        $request->merge(['value' => '']);
        Setting::create($request->all());
        return redirect(Settings::get('backend_uri') . "/settings")->with(array('message' => 'Successfully Created New Setting', 'alert-type' => 'success'));
    }

    public function delete(Request $request, $id)
    {

        $setting = Setting::find($id);

        if ($setting && !in_array($setting->key, $this->coreSettings)) {
            $setting->delete();
            return redirect(Settings::get('backend_uri') . "/settings")->with(array('message' => 'Successfully Deleted Setting', 'alert-type' => 'success'));
        }

        return redirect(Settings::get('backend_uri') . "/settings")->with(array('message' => "Not allowed to delete $setting->display_name  Setting", 'alert-type' => 'error'));
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

            return redirect(Settings::get('backend_uri') . "/settings")->with(array('message' => 'Moved ' . $setting->display_name . ' setting order up', 'alert-type' => 'success'));
        } else {
            return redirect(Settings::get('backend_uri') . "/settings")->with(array('message' => 'This is already at the top of the list', 'alert-type' => 'error'));
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
        return redirect(Settings::get('backend_uri') . "/settings")->with(array('message' => 'Successfully removed ' . $setting->display_name . ' value', 'alert-type' => 'success'));
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

            return redirect(Settings::get('backend_uri') . "/settings")->with(array('message' => 'Moved ' . $setting->display_name . ' setting order down', 'alert-type' => 'success'));
        } else {
            return redirect(Settings::get('backend_uri') . "/settings")->with(array('message' => 'This is already at the bottom of the list', 'alert-type' => 'error'));
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

        return redirect(Settings::get('backend_uri') . "/settings")->with(array('message' => 'Successfully Saved Settings', 'alert-type' => 'success'));


    }

}

