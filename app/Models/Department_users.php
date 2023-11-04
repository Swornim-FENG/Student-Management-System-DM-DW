<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department_users extends Model
{
    use HasFactory;
    protected $table="department_users";
    protected $primaryKey="dep_id";
    public $timestamps=false;
}
