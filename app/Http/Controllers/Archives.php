<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use App\Models\invoices_attachments;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class Archives extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_invoices = invoices::onlyTrashed()->get();
        return view('invoices.invoices_archive' , ['all_invoices' => $all_invoices]);
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
    //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->invoice_id;
        $invoices = invoices::withTrashed()->where('id' , $id)->restore();
        session()->flash('restore_invoice');
        return redirect('invoices');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->invoice_id;
        $all_invoices = invoices::withTrashed()->where('id' , $id)->first();
        $details = invoices_attachments::where('invoice_id' , $id)->first();
        if(!empty($details->invoice_number)){
        Storage::disk('public_uploads')->deleteDirectory($details->invoice_number);
    }
        $all_invoices->forceDelete();
        session()->flash('delete_invoice');
        return redirect('invoices');
    }
}
