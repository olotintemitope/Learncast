<?php

namespace App\Http\Requests;

class VideoRequest extends Request
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
           'title'        => 'required|max:50|unique:videos',
           'description'  => 'required|max:256',
           'category'     => 'required|max:5',
           'url'          => 'required|min:10,url,',
        ];
    }
}
