<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index()
    {
        return view('feedback.input');
    }

//    public function chart()
//    {
//        return view('dashboard.home');
//
//    }
}
