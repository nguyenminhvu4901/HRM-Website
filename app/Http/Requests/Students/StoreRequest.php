<?php

namespace App\Http\Requests\Students;

use App\Models\Course;
use Illuminate\Validation\Rule;
use App\Enums\StudentStatusEnum;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:students,email'],
            'password' => ['required', 'min:6'],
            'birthdate' => ['required'],
            'gender' => [
                'required',
                Rule::in([0, 1]),
            ],
            'status' => [
                'integer',
                Rule::in(StudentStatusEnum::asArray()),
            ],
            'course_id' => [
                'required',
                Rule::exists(Course::class, 'id'),
            ],
            'avatar' => [
                'nullable',
                'file',
                'image',
            ],
        ];
    }
}
