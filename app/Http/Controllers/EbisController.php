<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Rekapkomplain;
use Yajra\Datatables\Datatables;

class EbisController extends Controller
{
	/**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('ebis.home');
    }

    public function viewDES()
    {
    	return view('ebis.des');
    }

    public function viewDBS()
    {
    	return view('ebis.dbs');
    }

    public function viewDGS()
    {
    	return view('ebis.dgs');
    }
}

?>