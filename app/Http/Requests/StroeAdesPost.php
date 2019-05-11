<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StroeAdesPost extends FormRequest
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
            'title'=>[
                    'required',
                    'regex:/^[a-zA-Z](\w|[\x{4e00}-\x{9fa5}]){6,100}$/u'
                ],
            'keyword'=>['required','regex:/^[a-zA-Z](\w|[\x{4e00}-\x{9fa5}]){1,100}$/u'],
            'content'=>['required'],
            // 'img'=>['required']
        ];
    }
    public function messages(){
        return [
            'title.required'=>'标题不能为空',
            'title.regex'=>'标题只能字母开头的字母数字下划线组成的7-101位',
            'keyword.required'=>'关键字不能为空',
            'keyword.regex'=>'关键字只能字母开头的字母数字下划线组成的7-101位',
            'content.required'=>'内容不能为空',

        ];
    }
}
