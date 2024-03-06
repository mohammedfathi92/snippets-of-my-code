<?php

namespace App\Http\Controllers;

use App\Contact;
use Event;
use App\Events\MessageSent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Http\Requests;

class ContactController extends Controller
{
    function index()
    {
        $this->data['page_title'] = trans("contacts.page_title");
        $this->data['page_header'] = trans("contacts.page_header");
        return view("contacts.form_send", $this->data);
    }

    function send(Request $request)
    {
        $rules = [
            'subject' => "required|max:255",
            'message' => "required"
        ];
        $messages = [
            'subject.required' => trans("contacts.validation_subject_required"),
            'message.required' => trans("contacts.validation_message_required"),

        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $contact = new Contact();
        $contact->subject = $request->input("subject");
        $contact->message = $request->input("message");
        $contact->user_id = Auth::user()->id;
        $contact->save();
        Event::fire(new MessageSent($contact));
        flash(trans("contacts.sent_successfully"),'success');

        return redirect()->back();

    }
}
