<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Super_admins extends Model
{
    use HasFactory;
    protected $table="super_admins";
    protected $primaryKey="user_id";
    public $timestamps=false;
}
