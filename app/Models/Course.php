<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $table = 'courses';

    protected $fillable = [

        'category_id',
        'course_title',
        'course_description',
        'course_requirements',
        'slug',
        'course_image',
        'course_price',
        'teacher_id'

    ];

    //one to Many inverse
    public function teacher(){

        return $this->belongsTo(Teacher::class);
    }

    //one to Many inverse
    public function category(){

        return $this->belongsTo(Category::class);
    }

    //Many to many
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'course_tag');
    }
}
