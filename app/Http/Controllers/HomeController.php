<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
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

    //get data
    public function getall(){
        return Datatables::of(Rekapkomplain::all())->make(true);
    }

    public function getbydate(){
        $temp = DB::table('crm')
            ->select(DB::raw('count(*) as count, date'))
            ->groupBy('date')->get();
        return $temp;
    }

    public function getbystatus(){
        $temp = DB::table('crm')
            ->select(DB::raw('count(*) as count, status'))
            ->groupBy('status')->get();
        return $temp;
    }

    public function getbysumber(){
        $temp = DB::table('crm')
            ->select(DB::raw('count(*) as count, sumber'))
            ->groupBy('sumber')->get();
        return $temp;
    }

    public function getbykategori(){
        $temp = DB::table('crm')
            ->select(DB::raw('count(*) as count, kategori'))
            ->groupBy('kategori')->get();
        return $temp;
    }

}

