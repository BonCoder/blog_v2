<?php
namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRegisterRequest extends FormRequest
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
            'email' => 'required|email|unique:members,email',
            'name' => 'required|unique:members,name',
            'password' => 'required|string| between:6,16',
        ];
    }

    /**
     * Get rule messages.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required_without' => '请输入用户邮箱',
            'email.email' => '邮箱格式不正确',
            'email.unique' => '邮箱已经存在',
            'name.required' => '请输入用户名',
            'name.username' => '用户名只能以非特殊字符和数字开头，不能包含特殊字符',
            'name.display_length' => '用户名长度不合法',
            'name.unique' => '用户名已经被其他用户所使用',
            'password.required' => '请输入密码',
        ];
    }

    /**
     * 自定义错误返回格式.
     *
     * @param  Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'code'=>0,
            'message'=>$validator->errors()->first()
        ]));
    }
}
