<?php

namespace App\Http\Controllers;

use App\Models\invoices_attachments;
use App\Models\invoices;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class InvoicesAttachmentsController extends Controller
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
        // open invoices_attachments   //

if($request->hasFile('file_name')){

//     $this->validate($request,[

//         'file_name' => 'mimes:png,jpg,jpeg,pdf'],
// ['file_name.mimes' => 'خطأ في أضافة الملف , يجب ان يضمن الملف من نوع  pdf , jpeg , jpg , png ']);


    $invoice_id = invoices::latest()->first()->id;
    $image = $request->file('file_name');
    $file_name = $image->getClientOriginalName();
    $invoice_number = $request->invoice_number;


    $attachments = new invoices_attachments();
    $attachments->file_name = $file_name;
    $attachments->invoice_number = $invoice_number;
    $attachments->created_by = (Auth::user()->name);
    $attachments->invoice_id = $invoice_id;
    $attachments->save();

    $imageName = $request->file_name->getClientOriginalName();
    $request->file_name->move(public_path( 'Attachments/' . $invoice_number) , $imageName);
}
// End invoices_attachments   //

        session()->flash( 'Add' , 'تم أضافة الفاتورة بنجاح');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\invoices_attachments  $invoices_attachments
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
    //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\invoices_attachments  $invoices_attachments
     * @return \Illuminate\Http\Response
     */
    public function edit(invoices_attachments $invoices_attachments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\invoices_attachments  $invoices_attachments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, invoices_attachments $invoices_attachments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invoices_attachments  $invoices_attachments
     * @return \Illuminate\Http\Response
     */
    public function destroy(invoices_attachments $invoices_attachments)
    {
        //
    }
}
