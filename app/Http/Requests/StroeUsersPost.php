<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class StroeUsersPost extends FormRequest
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
            'username' => [
                    'required',
                    // 'unique:User,username,'.request()->id
                    Rule::unique('user')->ignore(request()->id,'id')
                    ,function($attribute, $value, $fail){
                        $reg ="/^[a-z](\w|[\x{4e00}-\x{9fa5}]){2,11}$/u";
                        if(!preg_match($reg,$value)){
                            return $fail('用户名不能以数字、下划线开头的3-12位汉字');
                        }
                    }
                ],
            'pwd' => [
                'sometimes'
                ,'required'
                ,'min:2'
                ,'max:11'
            ],
            'repwd' => 'sometimes|required|same:pwd',
            'tel' => 'required|numeric|regex:/^1[3458]\d{9}$/',
            'email' => 'required|email'
        ];
    }
    public function messages()
    {
        return [
            'username.required' => '用户名不能为空',
            'username.unique' => '用户名已存在',
            'pwd.required' => '密码不能为空',
            'pwd.min' => '密码不能少于2位',
            'pwd.max' => '密码不能大于11位',
            'repwd.required' => '确认密码不能为空',
            'repwd.same' => '确认密码和密码不一致',
            'tel.required' => '电话不能为空',
            'tel.numeric' => '电话只能是数字',
            'tel.regex' => '手机格式不对',
            'email.required' => '邮箱不能为空',
            'email.email' => '邮箱格式不对',
            // 'headlogo.required' => '头像不能为空',
        ];
    }
}
