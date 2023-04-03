<?php

namespace App\Models;

use App\Enums\StudentStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'students';

    protected $guarded = [];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    public function gender($gender)
    {
        if ($gender == 0) {
            return 'Male';
        } else {
            return 'Female';
        }
    }

    public function getStatus($status)
    {
        return StudentStatusEnum::getKeyByValues($status);
    }
}
