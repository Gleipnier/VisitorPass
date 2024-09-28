<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function view_category(){
        return view('admin.category');
    }

    public function visitors(){
        return view('admin.visitors');
    }

    public function visitorverify(){
        return view('admin.visitorverify');
    }
}
