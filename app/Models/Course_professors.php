<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course_professors extends Model
{
    use HasFactory;
    protected $table="course_professors";
    public $timestamps=false;
}
