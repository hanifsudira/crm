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

    public function viewTR1()
    {
    	return view('ebis.tr1');
    }

    public function viewTR2()
    {
    	return view('ebis.tr2');
    }

    public function viewTR3()
    {
    	return view('ebis.tr3');
    }

    public function viewTR4()
    {
    	return view('ebis.tr4');
    }

    public function viewTR5()
    {
    	return view('ebis.tr5');
    }

    public function viewTR6()
    {
    	return view('ebis.tr6');
    }

    public function viewTR7()
    {
    	return view('ebis.tr7');
    }
}

?>