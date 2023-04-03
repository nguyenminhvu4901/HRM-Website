<?php

namespace App\Http\Requests\Students;

use App\Models\Course;
use Illuminate\Validation\Rule;
use App\Enums\StudentStatusEnum;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'name' => ['max:255'],
            'email' => ['email', 'max:255', 'unique:students,email,' . $this->id],
            'password' => ['min:6'],
            'birthdate' => ['date'],
            'gender' => [
                Rule::in([0, 1]),
            ],
            'status' => [
                'integer',
                Rule::in(StudentStatusEnum::asArray()),
            ],
            'course_id' => [
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
