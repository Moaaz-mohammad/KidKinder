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

    public function requests() {
        return $this->hasMany(ClassRequest::class);
    }

    public function users() {
        // A class can have MANY users THROUGH requests
        return $this->belongsToMany(User::class, 'class_requests');
    }

    public function teachers() {
        return $this->belongsToMany(Teacher::class, 'class_teacher', 'classs_id' ,'teacher_id')->withTimestamps();
    }
}
