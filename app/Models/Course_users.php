<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course_users extends Model
{
    use HasFactory;
    protected $table="course_user";
    protected $primaryKey="user_id";
    public $timestamps=false;
}
