<?php

namespace Corsata\Http\Controllers;

use Corsata\Media;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Image;
use Illuminate\Http\Request;

use Corsata\Http\Requests;
use Corsata\Http\Controllers\Controller;

class UploaderController extends Controller
{
    function upload(Request $request)
    {
        $file = null;
        $filename = null;
        $file_prefix = "";
        $allowed_extensions = config("settings.allowed_extensions");
        $uploadIAllowed = false;
        $response = [
            'success' => false,
            'file' => null,
            'ext' => null,
            'mimeType' => null,
            'type' => null
        ];
        if ($request->input('prefix')) {
            $file_prefix = $request->input('prefix');
        }
        $file_resize = [100, 100];//w×h
        if ($request->input('resize') and is_array($request->input('resize'))) {
            $file_resize = $request->input('resize');
        }

        $file = $request->file('file');
        $mime = pathinfo($file->getClientMimeType(), PATHINFO_FILENAME);
        $ext = $file->getClientOriginalExtension();
        $filename = Str::lower(
            $file_prefix . str_replace(' ', '-', pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME))
            . '-'
            . uniqid()
            . '.'
            . $ext
        );
        $mime = strtolower($mime);

        if (in_array($mime, $allowed_extensions['images'])) {
            $response['type'] = 'image';
            $uploadIAllowed = true;
        } elseif (in_array($mime, $allowed_extensions['videos'])) {
            $response['type'] = 'video';
            $uploadIAllowed = true;
        } elseif (in_array($mime, $allowed_extensions['documents'])) {
            $response['type'] = 'document';
            $uploadIAllowed = true;
        } else {
            $response['message'] = "Not Allowed File";
            $response['type'] = $mime;
        }

        if ($request->hasFile('file') && $file->isValid() && $uploadIAllowed) {

            $file->move(config('settings.upload_path'), $filename);


            // check if file is image
            if ($response['type'] == 'image') {
                // resize it
                $thumbnails_dir = config("settings.thumbnails_dir");
                $thumbnails_destination = config('settings.upload_path') . "/$thumbnails_dir/";
                //check if directory exists
                if (!File::exists($thumbnails_destination))
                    File::makeDirectory($thumbnails_destination, 0775);

                $image = Image::make(config('settings.upload_path') . "/" . $filename);

                if ($image->width() >= $file_resize[0] || $image->height() >= $file_resize[1]) {
                    $image->resize($file_resize[0], $file_resize[1]);
                }


                $image->save($thumbnails_destination . $filename);

                $response['success'] = true;
                $response['file'] = $filename;
                $response['ext'] = $ext;
                $response['mimeType'] = $mime;
                $response['small'] = $thumbnails_destination . $filename;

            } elseif ($response['type'] == 'video' || $response['type'] == 'document') {
                $response['success'] = true;
                $response['file'] = $filename;
                $response['ext'] = $ext;
                $response['mimeType'] = $mime;

            } else {
                $response['success'] = true;
                $response['file'] = $filename;
                $response['ext'] = $ext;
                $response['mimeType'] = $mime;
            }


        }

        return response()->json($response);
    }

    function delete($file = null)
    {
        if ($file) {
            if (Storage::disk("public")->exists(config("settings.upload_dir") . "/$file")) {

                Storage::disk('public')->delete(config("settings.upload_dir") . "/$file");
                if (Storage::disk("public")->exists(config("settings.upload_dir") . "/" . config("settings.thumbnails_dir") . "/$file")) {

                    Storage::disk('public')->delete(config("settings.upload_dir") . "/" . config("settings.thumbnails_dir") . "/$file");

                }

                // check if file is stored in database
                $dbFile = Media::where("name", $file)->first();
                if ($dbFile) {
                    $dbFile->delete();
                }
                return response()->json(['success' => true, 'message' => 'File deleted successfully']);
            }
            return response()->json(['success' => false, 'message' => 'File not exists']);
        }
        return response()->json(['success' => false, 'message' => 'base request']);
    }
}
