<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view('admin.index');
    }

    public function verifypage(){
        return view('admin.verify');
    }

    public function home(){
        return view('home.index');
    }
    public function edit(){
        return view('home.edit');
    }
}
