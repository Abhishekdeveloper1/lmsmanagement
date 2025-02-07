<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'category_id', 'description'];

    public function category()
    {
        return $this->belongsTo(CourseCategory::class, 'category_id');
    }

    public function enrollments()
    {
        return $this->hasMany(CourseEnrollment::class);
    }
}
