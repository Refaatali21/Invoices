<?php

namespace App\Http\Controllers;

use App\Models\invoices_details;
use App\Models\invoices_attachments;
use App\Models\invoices;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class InvoicesDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\invoices_details  $invoices_details
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $all_invoices = invoices::where('id' , $id)->first();
        $all_details = invoices_details::where('id_invoice' , $id)->get();
        $all_attachments = invoices_attachments::where('invoice_id' , $id)->get();
        return view('invoices.details_invoice' , compact('all_invoices' , 'all_details' , 'all_attachments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\invoices_details  $invoices_details
     * @return \Illuminate\Http\Response
     */
    public function edit(invoices_details $invoices_details)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\invoices_details  $invoices_details
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, invoices_details $invoices_details)
    {
        //
    }

public function open_file($invoice_number,$file_name)
{
$st="Attachments";
$pathToFile = public_path($st.'/'.$invoice_number.'/'.$file_name);
return response()->file($pathToFile);
}

public function download_file($invoice_number,$file_name)
{
$st="Attachments";
$pathToFile = public_path($st.'/'.$invoice_number.'/'.$file_name);
return response()->download($pathToFile);
}
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invoices_details  $invoices_details
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $invoices = invoices_attachments::findOrFail($request->id_file);
        $invoices->delete();
        Storage::disk('public_uploads')->delete($request->invoice_number.'/'.$request->file_name);
        session()->flash('delete', 'تم حذف المرفق بنجاح');
        return back();
    }
}
