<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'avatar' => ['nullable', 'image', 'max:3000'],
            'name' => ['required','max:50'],
            'email' => ['required', 'email', 'max:200', 'unique:users,email,'.auth()->user()->id]
        ];
    }

    // public function withValidator($validator)
    // {
    //     $messages = $validator->messages();

    //     foreach ($messages->all() as $message)
    //     {
    //         toastr()->error ( $message, 'Error');
    //     }

    //     return $validator->errors()->all();

    // }
}
