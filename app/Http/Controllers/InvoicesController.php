<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;
use App\Notifications\OffersNotification;
use Illuminate\Http\Request;
use App\Exports\InvoicesExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\invoices;
use App\Models\Sections;
use App\Models\products;
use App\Models\invoices_attachments;
use App\Models\invoices_details;
use App\Notifications\InvoicePaid;
use App\Models\User;

class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $all_invoices = invoices::all();
        return view('invoices.invoices' , ['all_invoices' => $all_invoices]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $all_section = Sections::all();
        return view('invoices.add_invoices' , ['all_section' => $all_section]);
    }
    // invoices paid  //

    public function invoices_paid()
    {
        $all_invoices = invoices::where('value_status', 1)->get();

        return view('invoices.invoices_paid' , compact('all_invoices'));
    }

    public function invoices_unpaid()
    {
        $all_invoices = invoices::where('value_status', 2)->get();
        return view('invoices.invoices_unpaid' , compact('all_invoices'));
    }


    public function invoices_Partially()
    {
        $all_invoices = invoices::where('value_status', 3)->get();
        return view('invoices.invoices_Partially' , compact('all_invoices'));
    }

    // end invoices paid  //
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        invoices::create([
            'invoice_number' => request('invoice_number'),
            'invoice_Date' => request('invoice_Date'),
            'Due_date' => request('Due_date'),
            'product' => request('product'),
            'section_id' => request('Section'),
            'number' => request('number'),
            'email' => request('email'),
            'customer_name' => request('customer_name'),
            'Amount_Commission' => request('Amount_Commission'),
            'Amount_collection' => request('Amount_collection'),
            'Discount' => request('Discount'),
            'Rate_VAT' => request('Rate_VAT'),
            'Value_VAT' => request('Value_VAT'),
            'Total' => request('Total'),
            'status' => 'غير مدفوعة',
            'value_status' => 2,
            'note' => request('note'),
        ]);


// open invoices_details   //
        $invoice_id = invoices::latest()->first()->id;
        invoices_details::create([
            'invoice_number' => request('invoice_number'),
            'product' => request('product'),
            'id_invoice' => $invoice_id,
            'Section' => request('Section'),
            'status' => 'غير مدفوعة',
            'value_status' => 2,
            'note' => request('note'),
            'user' => (Auth::user()->name),
        ]);
// End invoices_details   //

// open invoices_attachments   //

if($request->hasFile('pic')){

    $invoice_id = invoices::latest()->first()->id;
    $image = $request->file('pic');
    $file_name = $image->getClientOriginalName();
    $invoice_number = $request->invoice_number;


    $attachments = new invoices_attachments();
    $attachments->file_name = $file_name;
    $attachments->invoice_number = $invoice_number;
    $attachments->created_by = (Auth::user()->name);
    $attachments->invoice_id = $invoice_id;
    $attachments->save();

    $imageName = $request->pic->getClientOriginalName();
    $request->pic->move(public_path( 'Attachments/' . $invoice_number) , $imageName);
}

// End invoices_attachments   //
$users = User::get();
$invoice_id = invoices::latest()->first()->id;
Notification::send($users, new InvoicePaid($invoice_id));

$user = User::get();
$invoice_id = invoices::latest()->first()->id;

Notification::send($user, new OffersNotification($invoice_id));

        session()->flash( 'Add' , 'تم أضافة الفاتورة بنجاح');
        return back();
    }





    /**
     * Display the specified resource.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $all_invoices = invoices::where('id' , $id)->first();
        $all_section = Sections::all();
        return view('invoices.Status_Update' , compact('all_invoices', 'all_section'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $all_invoices = invoices::where('id' , $id)->first();
        $all_section = Sections::all();
        return view('invoices.edit_invoice' , compact('all_invoices', 'all_section'));
    }

    public function showDate($id)
    {
        $invoices = invoices::where('id' , $id)->first();
        return view('invoices.Print_invoice' , compact('invoices'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $invoices = invoices::findOrFail($request->invoice_id);
        $invoices->update([
            'invoice_number' => request('invoice_number'),
            'invoice_Date' => request('invoice_Date'),
            'Due_date' => request('Due_date'),
            'product' => request('product'),
            'section_id' => request('Section'),
            'number' => request('number'),
            'email' => request('email'),
            'customer_name' => request('customer_name'),
            'Amount_Commission' => request('Amount_Commission'),
            'Amount_collection' => request('Amount_collection'),
            'Discount' => request('Discount'),
            'Rate_VAT' => request('Rate_VAT'),
            'Value_VAT' => request('Value_VAT'),
            'Total' => request('Total'),
            'status' => 'غير مدفوعة',
            'value_status' => 2,
            'note' => request('note'),
        ]);

        session()->flash( 'edit' , 'تم تعديل الفاتورة بنجاح');
        return back();
    }

    public function Status_update($id ,Request $request)
    {
        $invoices = invoices::findOrFail($id);

        if($request->status === 'مدفوعة'){

            $invoices->update([
                'value_status' => 1,
                'status' => request('status'),
                'payment_date' => request('payment_date'),
            ]);


            // open invoices_details   //
        invoices_details::create([
            'id_invoice' => $request->invoice_id,
            'invoice_number' => request('invoice_number'),
            'product' => request('product'),
            'Section' => request('Section'),
            'status' => request('status'),
            'value_status' => 1,
            'note' => request('note'),
            'payment_date' => request('payment_date'),
            'user' => (Auth::user()->name),
        ]);
// End invoices_details   //
        }else{

            $invoices->update([
                'value_status' => 3,
                'status' => request('status'),
                'payment_date' => request('payment_date'),
            ]);


            // open invoices_details   //
        invoices_details::create([
            'id_invoice' => $request->invoice_id,
            'invoice_number' => request('invoice_number'),
            'product' => request('product'),
            'Section' => request('Section'),
            'status' => request('status'),
            'value_status' => 3,
            'note' => request('note'),
            'payment_date' => request('payment_date'),
            'user' => (Auth::user()->name),
        ]);
// End invoices_details   //
        }
        session()->flash('Status_Update');
        return redirect('invoices');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->invoice_id;
        $invoices = invoices::where('id' , $id)->first();
        $details = invoices_attachments::where('invoice_id' , $id)->first();
        if(!empty($details->invoice_number)){
        Storage::disk('public_uploads')->deleteDirectory($details->invoice_number);
    }
        $invoices->forceDelete();
        session()->flash('delete_invoice');
        return redirect('invoices');
    }

    public function trached(Request $request)
    {
        $id = $request->invoice_id;
        $invoices = invoices::where('id' , $id)->first();
        $invoices->delete();
        session()->flash('archive_invoice');
        return redirect('invoices');
    }

    public function getproducts($id)
    {
        $Products = DB::table("products")->where('section_id' ,$id)->pluck("products_name" , "id");
        return json_encode($Products);
    }

    public function export()
    {
        return \Excel::download(new InvoicesExport, 'users.xlsx');
    }

    public function MarkAsRead_all()
    {
        $unRed = Auth::user()->unreadNotifications;
        if($unRed){
            $unRed->markAsRead();
            return back();
        }
    }

}
