<?php

namespace Modules\Components\LMS\Http\Requests;

use Modules\Foundation\Http\Requests\BaseRequest;
use Modules\Components\LMS\Models\Book;

class BookRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */


    public function authorize()
    {
        $this->setModel(Book::class, 'books-management');

        return $this->isAuthorized();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->setModel(Book::class);
        $rules = parent::rules();

        if ($this->isUpdate() || $this->isStore()) {
            $rules = array_merge($rules, [
                'title' => 'required',
                // 'content' => 'required',
                // 'book_file' => 'required',
                'status' => 'required',
            ]);
        }

            if ($this->isStore()) {
            $rules = array_merge($rules, [
                // 'slug' => 'required|max:191|unique:lms_books,slug'
            ]);
        }

        if ($this->isUpdate()) {
            $book = $this->route('book');

            $rules = array_merge($rules, [
                // 'slug' => 'required|max:191|unique:lms_books,slug,' . $book->id,
            ]);
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
