<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course_categorie extends Model
{
    protected $fillable = ['name'];

    use HasFactory;

    public function courses()
    {
        return $this->hasMany(Course::class, 'category_id');
    }
}
