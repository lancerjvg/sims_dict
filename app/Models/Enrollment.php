<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Enrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'subject_id',
        'school_year',
        'semester',
        'enrollment_date',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'enrollment_date' => 'date',
        ];
    }

    // An enrollment belongs to one student
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    // An enrollment belongs to one subject
    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }
}
