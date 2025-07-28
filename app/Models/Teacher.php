<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'url_1', 'url_2', 'url_3', 'main_techer', 'description'];

    // protected $fillable = ['name', 'description'];

    public function teachingContents()
    {
        return $this->hasMany(TeachingContent::class, 'teacher_id');
    }

    public function images() {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function classses() {
        return $this->belongsToMany(Classs::class, 'class_teacher', 'teacher_id', 'classs_id')->withTimestamps();
    }
}
