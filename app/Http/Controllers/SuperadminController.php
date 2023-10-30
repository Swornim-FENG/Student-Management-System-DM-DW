<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuperadminController extends Controller
{
    //show admin dashboard
    public function showsuperadmin(){
        return view('superadmindashboard.superadmindashboard');
    }
}
