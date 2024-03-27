<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateStudentRequest extends FormRequest
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
            'name' => ['sometimes','string'],
            'email' => ['sometimes','email'],
            'address' => ['sometimes','string'],
            'phone' => ['sometimes'],
            'course_id' => ['sometimes','numeric']
        ];
    }



}