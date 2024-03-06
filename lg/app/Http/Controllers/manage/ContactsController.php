<?php

namespace App\Http\Controllers\manage;

use App\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class ContactsController extends ManageController
{
    function index()
    {
        $this->data['page_title'] = trans("contacts.page_title");
        $this->data['page_header'] = trans("contacts.page_header");
        $this->data['data']=Contact::latest()->paginate(15);
        return view("manage.contacts.index", $this->data);
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
        flash(trans("contacts.sent_successfully"),'success');
        return redirect()->back();

    }
    function message(Request $request,$id=0){
        $message=Contact::find($id);
        if(!$message)
            return redirect()->back()->withErrors(trans("contacts.error_id_not_found"));

        $message->opened=1;
        $message->save();

        $this->data['page_title'] = trans("contacts.page_title");
        $this->data['page_header'] = trans("contacts.page_header");
        $this->data['data']=$message;
        return view("manage.contacts.show", $this->data);


    }
}
