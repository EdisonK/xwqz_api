<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends BaseRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     *
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:16',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed|min:6|max:16',

        ];
    }

    public function messages(): array
    {
        return [
          'name.required' => '名字 不能为空',
          'name.max' => '名字 字符长度不能超过16',


        ];
    }
}
