<?php

namespace Modules\Components\CMS\Http\Requests;

use Modules\Foundation\Http\Requests\BaseRequest;
use Modules\Components\CMS\Models\Post;

class PostRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->setModel(Post::class);

        return $this->isAuthorized();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->setModel(Post::class);
        $rules = parent::rules();

        if ($this->isUpdate() || $this->isStore()) {
            $rules = array_merge($rules, [
                'title' => 'required|max:191',
                'content' => 'required',
                'categories' => 'required',
                'featured_image' => 'mimes:jpg,jpeg,png|max:' . maxUploadFileSize()
            ]);
        }

        if ($this->isStore()) {
            $rules = array_merge($rules, [
                'slug' => 'required|max:191|unique:posts,slug'
            ]);
        }

        if ($this->isUpdate()) {
            $post = $this->route('post');

            $rules = array_merge($rules, [
                'slug' => 'required|max:191|unique:posts,slug,' . $post->id,
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
            $data['slug'] = str_slug($data['slug']);
        }

        $data['published'] = array_get($data, 'published', false);
        $data['private'] = array_get($data, 'private', false);
        $data['internal'] = array_get($data, 'internal', false);

        $this->getInputSource()->replace($data);

        return parent::getValidatorInstance();
    }
}
