<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePostRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            "title"     => ["required", "min:2", "max:255"],
            "body"      => ["required", "min:10"],
            "images"    => ["max:5"],
            "images.*"  => ["image", "mimes:png,jpg,jpeg,gif,svg", "max:5000"]
        ];
    }
    public function messages()
    {
        return [
            "images.max" => "the maximum of files can be upload is 5 files",
            "images.*.image" => "The file uploaded must be images Only",
            "images.*.mimes" => "The extentions of images allowed is Png, Jpeg, Jpg, gif, Svg only",
            "images.*.max" => "The Maximum allowed size for an image is 5 MB",
        ];
    }
}
