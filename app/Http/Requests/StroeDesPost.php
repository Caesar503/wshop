<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StroeDesPost extends FormRequest
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
            'name'=>[
                    'required',
                    'regex:/^(\w|[\x{4e00}-\x{9fa5}]){1,100}$/u',
                    'unique:des'
                ],
            'http'=>['required','regex:/^http:\/\/(\w|[\x{4e00}-\x{9fa5}]){1,100}$/u'],
            'desc'=>['required'],
            // 'img'=>['required']
        ];
    }
    public function messages(){
        return [
            'name.required'=>'名称不能为空',
            'name.regex'=>'名称由中文字母数字下划线组成',
            'name.unique'=>'名称已经存在',
            'http.required'=>'网站不能为空',
            'http.regex'=>'网站由http://开头',
            'desc.required'=>'内容不能为空',

        ];
    }
}
