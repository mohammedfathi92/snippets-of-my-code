<?php
/**
 * Created by Ahmed Zidan.
 * email: php.ahmedzidan@gmail.com
 * Project: Alrabeh LMS
 * Date: 8/16/18
 * Time: 9:08 AM
 */

namespace Modules\Components\LMS\Http\Controllers\Frontend;

use Modules\Foundation\Http\Controllers\PublicBaseController;
use Illuminate\Http\Request;
use Modules\Components\Chat\Models\Chat;
use Nahid\Talk\Facades\Talk;
use Modules\User\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use View;

class MessangerController extends PublicBaseController
{
   protected $authUser;
    public function __construct()
    {

        $this->middleware('auth');
        // Talk::setAuthUserId(Auth::id());
        View::composer('messanger.partials.peoplelist', function($view) {
            $threads = Talk::threads();
            $view->with(compact('threads'));
        });
         parent::__construct();
    }

    public function index()
    {
        $show_conversation = false;
        Talk::setAuthUserId(Auth::id());
        $conversations = null;
        $user = New User;
        $messages = [];

        if (count($messages) > 0) {
            $messages = $messages->sortBy('id');
        }

        return view('messanger.messages.conversations', compact('messages', 'user', 'show_conversation'));
    }

    public function chatHistory($hashed_id)
    {

        $id = hashids_decode($hashed_id);
        Talk::setAuthUserId(Auth::id());
        $conversations = Talk::getMessagesByUserId($id, 0, 100000);
        $conversation = null;
        $user = '';
        $messages = [];
        if(!$conversations) {
            $user = User::find($id);
        } else {
            $user = $conversations->withUser;
            $messages = $conversations->messages;

        }

        if (count($messages) > 0) {
            $messages = $messages->sortBy('id');
        }
        $show_conversation = true;
        return view('messanger.messages.conversations', compact('messages', 'user', 'show_conversation'));
    }



public function storeAudioMessage(Request $request)
    {

        Talk::setAuthUserId(Auth::id());
        $rules = [
                'audio_message'=>'required',
                'reciever_id'=>'required'
            ];

        $this->validate($request, $rules);

        $messageBlob = $request->file('audio_message');
        // dd($request->all());
         $data = str_replace("data:audio/wav;base64,","",$messageBlob);
  Storage::put('file.wav', base64_decode($data), 'public');

        // dd($messageBlob);
        $reciever_id = hashids_decode($request->get('reciever_id'));
        $soredLink = 'messanger/audio/'.user()->hashed_id.'/'.uniqid().$reciever_id.'.wav';
        //     //save the wav file to 'storage/app/audio' path with fileanme test.wav
        // file_put_contents('/', $messageBlob);
       
        Storage::put($soredLink, file_get_contents($messageBlob));

         if ($message = Talk::sendMessageByUserId($reciever_id, '')) {
            $message->media_url = $soredLink;
            $message->type = 'audio';
            $message->save();
         $html = view('messanger.ajax.newMessageHtml', compact('message'))->render();
                return response()->json(['status'=>'success', 'html'=>$html], 200);
        }


    }

        public function ajaxSendMessage(Request $request)
    {
        Talk::setAuthUserId(Auth::id());


        if ($request->ajax()) {
            $rules = [
                'message-data'=>'required',
                '_id'=>'required'
            ];

            $this->validate($request, $rules);

            $body = $request->input('message-data');
            $userId = $request->input('_id');


            if ($message = Talk::sendMessageByUserId($userId, $body)) {
                $html = view('messanger.ajax.newMessageHtml', compact('message'))->render();
                return response()->json(['status'=>'success', 'html'=>$html], 200);
            }
        }
    }

    public function ajaxAskTeacher(Request $request)
    {
        Talk::setAuthUserId(Auth::id());

        if ($request->ajax()) {
            $rules = [
                'message-data'=>'required',
                '_id'=>'required'
            ];

            $this->validate($request, $rules);

            $teacher_id = hashids_decode($request->input('_id'));
            $quiz_id = hashids_decode($request->input('quiz_id'));
            $question_id = hashids_decode($request->input('question_id'));
            $question_content = $request->input('question_content');
            $question_url = '<a style="color:#fff;" href="'.route('quizzes.question_preview', ['quiz_id' => $request->input('quiz_id'), 'question_id' => $request->input('question_id')]).'" target="_blank"><div style="background-color:#6689ab; padding:20px;"><strong>'.$question_content.'</strong></div></a>';
             $message_content = $question_url.'<br>'.$request->input('message-data');
             

            $body = $message_content;


            if ($message = Talk::sendMessageByUserId($teacher_id, $body)) {

                $html = view('messanger.ajax.newMessageHtml', compact('message'))->render();
                return response()->json(['success'=> true, 'html'=>$html], 200);
            }
        }
    }

    public function ajaxDeleteMessage(Request $request, $id)
    {
        Talk::setAuthUserId(Auth::id());
        if ($request->ajax()) {
            if(Talk::deleteMessage($id)) {
                return response()->json(['status'=>'success'], 200);
            }

            return response()->json(['status'=>'errors', 'msg'=>'something went wrong'], 401);
        }
    }

    public function tests()
    {
        dd(Talk::channel());
    }
}
