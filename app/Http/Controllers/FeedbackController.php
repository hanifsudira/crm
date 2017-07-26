<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\DB;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Storage;
use File;
use App\Feedback;
use Session;

class FeedbackController extends Controller
{
    public function index()
    {
        return view('feedback.input');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    	$last = \DB::table('feedback')->orderBy('created_at', 'desc')->first();

    	$file = $request->image;
		$extension = $file->getClientOriginalExtension();
		Storage::disk('public')->put((string)((int)$last->id+1).'_'.$request->nik.'_'.$file->getClientOriginalName(),  File::get($file));

    	$feedback = new Feedback;
    	$feedback->nik = $request->nik;
    	$feedback->nama = $request->nama;
    	$feedback->feedback = $request->feedback;
    	$feedback->mime = $file->getClientMimeType();
    	$feedback->original_filename = $file->getClientOriginalName();
    	$feedback->filename = $file->getFilename().'.'.$extension;

    	$feedback->save();

    	return redirect()->route('feedback.input');
    }
    /*
    public function chart()
    {
        return view('dashboard.home');

    }*/
}
