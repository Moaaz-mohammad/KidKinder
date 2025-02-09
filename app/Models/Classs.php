<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classs extends Model
{
    use HasFactory;

    protected $fillable = ['class_content_name', 'class_number', 'from_age', 'to_age', 'total_seats', 'tution_fee', 'from_time', 'to', 'description'];

    public function students() {
        // return $this->belongsToMany(Student::class);

        return $this->belongsToMany(Student::class, 'classroom_student', 'classroom_id', 'student_id') 
        ->withPivot('joined_at') 
        ->withTimestamps();
    }
}
