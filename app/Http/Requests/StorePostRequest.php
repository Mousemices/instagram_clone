<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{

    protected $redirectRoute = 'post.create';
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'image' => 'required|image',
            'description' => 'required|max:255',
        ];
    }

    public function messages()
    {
        return [
            'image.required' => 'The image field is required for your post.',
            'description.required' => 'description is required for your post.',
        ];

    }
}
