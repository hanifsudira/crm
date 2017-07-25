<?php

namespace App\Http\Controllers;

use App\Rekapkomplain;
use Yajra\Datatables\Datatables;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void

    public function __construct()
    {
        $this->middleware('auth');
    }
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.data');
    }

    public function chart()
    {
        return view('dashboard.home');

    }

    public function getall(){
        return Datatables::of(Rekapkomplain::all())->make(true);
    }
}
