<?php

namespace Modules\Components\LMS\Http\Requests;

use Modules\Components\LMS\Models\Category;
use Modules\Foundation\Http\Requests\BaseRequest;

class CategoryRequest extends BaseRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->setModel(Category::class);

        return $this->isAuthorized();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $this->setModel(Category::class);
        $rules = parent::rules();

        if ($this->isUpdate() || $this->isStore()) {
            $rules = array_merge($rules, [
                // 'status' => 'required',
            ]);
        }

        if ($this->isStore()) {
            $rules = array_merge($rules, [
                'name' => 'required|max:191|unique:categories,name',
                // 'slug' => 'required|max:191|unique:categories,slug'
            ]);
        }

        if ($this->isUpdate()) {
            $category = $this->route('category');
            $rules = array_merge($rules, [
                'name' => 'required|max:191|unique:categories,name,' . $category->id,
                // 'slug' => 'required|max:191|unique:categories,slug,' . $category->id,
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

        if (isset($data['slug'])) {
            $data['slug'] = make_slug($data['slug']);
        }

        $this->getInputSource()->replace($data);
        return parent::getValidatorInstance();
    }
}
