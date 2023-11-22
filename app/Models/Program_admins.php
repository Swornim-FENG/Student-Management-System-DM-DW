<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program_admins extends Model
{
    use HasFactory;
    protected $table="program_admins";
    protected $primaryKey="admin_id";
    public $timestamps=false;
}
