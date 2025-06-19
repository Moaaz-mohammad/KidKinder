<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Builder\Class_;
use Spatie\Permission\Traits\HasRoles;

class Student extends Model
{
    use HasFactory, HasRoles;

    protected $guard_name = 'web';


    protected $fillable = ['first_name', 'last_name', 'student_forign_id', 'age', 'description'];

    public function classses() {
        // return $this->belongsToMany(Classs::class;
        return $this->belongsToMany(Classs::class, 'classroom_student', 'student_id', 'classroom_id') 
        ->withPivot('joined_at') 
        ->withTimestamps();
    }

    public function images() {
        return $this->morphMany(Image::class, 'imageable');
    }
}
