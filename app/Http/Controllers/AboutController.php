<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'nama' => ['required'],
            'deskripsi' => ['nullable'],
        ]);


        try {
            $about = new About();
            $about->nama = $request->nama;
            $about->deskripsi = $request->deskripsi;
            $about->save();

            return redirect()->back()->with(['success' => 'Data added successfully!']);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['failed' => $th->getMessage()]);
        }
    }

    public function setStatus(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'status' => ['required'],
        ]);

        try {
            $status = new Status();
            $status->status = $request->status;
            $status->save();

            return redirect()->back()->with(['success' => 'Status added successfully!']);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['failed' => $th->getMessage()]);
        }
    }

    public function updateStatus(Request $request)
    {
        // untuk get id status tanpa id dari route
        $getId = Status::first();
        $idStatus = $getId->id;
        // end get id
        
        $request->validate([
            'status' => ['required'],
        ]);

        try {
            $status = Status::findOrFail($idStatus);
            $status->status = $request->status;
            $status->save();
            return redirect()->back()->with(['success' => 'Status Edited successfully!']);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['failed' => $th->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => ['required'],
            'deskripsi' => ['nullable'],
        ]);

        try {
            $about = About::findOrFail($id);
            $about->nama = $request->nama;
            $about->deskripsi = $request->deskripsi;
            $about->save();
            return redirect()->back()->with(['success' => 'Status Edited successfully!']);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['failed' => $th->getMessage()]);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function show(About $about)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function edit(About $about)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
    
        try {

            $about = About::findOrFail($request->id);
            $about->delete();
            Session::flash('success', 'Data Successfully Deleted!');

            return redirect()->back()->with(['success' => 'Data Deleted successfully!']);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['failed' => $th->getMessage()]);
        }
    }
}
