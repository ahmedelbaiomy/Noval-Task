<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title'=>'required|unique:posts,content|min:5|max:30',
            'content'=>'required|min:20',
            'image'=>'required_without:author|image|mimes:jpeg,png,jpg,webp|max:2048',
            'author'=>'required|exists:users,id'
        ];
    }
    public function messages()
    {
        return[
          'title.required' => 'Title is required',
          'title.unique' => 'Title is already exists',
          'title.min' => 'Title must be at least 5 letters',
          'title.max' => 'Title is long, maximum 30 letters',
          'content.required' => 'content is required',
          'content.min' => 'content must be at least 20 letters',
          'image.required' => 'image is required',
          'image.max' => 'max size allowed 2MB',
        ];
    }
}
