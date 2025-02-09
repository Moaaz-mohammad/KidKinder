<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'url_1', 'url_2', 'url_3', 'main_techer', 'description'];

    // protected $fillable = ['name', 'description'];

    public function teachingContents()
    {
        return $this->hasMany(TeachingContent::class, 'teacher_id');
    }

    public function images() {
        return $this->morphToMany(Image::class, 'imageable');
    }
}
