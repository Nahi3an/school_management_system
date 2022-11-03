<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;


    protected $table ='teachers';
    protected $fillable = [

        'name',
        'email',
        'phone',
        'address',
        'image',
        'password'
    ];

    //One to Many
    public function courses(){

        return $this->hasMany(Course::class);
    }

}
