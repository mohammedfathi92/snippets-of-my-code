<?php

namespace Modules\Components\LMS\Http\Requests;

use Modules\Foundation\Http\Requests\BaseRequest;
use Modules\Components\LMS\Models\Question;

class QuestionRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->setModel(Question::class);

        return $this->isAuthorized();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->setModel(Question::class);
        $rules = parent::rules();

        if ($this->isUpdate() || $this->isStore()) {
            $rules = array_merge($rules, [
                'title' => 'required',
                'status' => 'required',
                'content' => 'required',
                'question_type' => 'required',

            ]);


                        if($this->get('question_type') != 'paragraph'){

                $correct_answers = [];

            foreach ($this->get('answers', []) as $id => $item) {
                $rules = array_merge($rules, [
                    "answers.{$id}.title" => 'required',

                ]);


                               if($this->input("answers.".$id.".is_correct") > 0){

                    $correct_answers[] = 1;

                }


            }
                            if(!count($correct_answers)){

             $rules = array_merge($rules, [
                    "answers.*.is_correct" => 'required',

                ]);

            }



            }




        }

        return $rules;
    }

    /**
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function getValidatorInstance()
    {
        $data = $this->all();

        $this->getInputSource()->replace($data);

        return parent::getValidatorInstance();
    }
}
