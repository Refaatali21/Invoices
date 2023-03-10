<?php

namespace App\Http\Controllers;

use App\Models\products;
use App\Models\Sections;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_section = Sections::all();
        $all_Products = products::all();
        return view('products.products' , ['all_Products' => $all_Products] , ['all_section' => $all_section]);
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
        $validatedDate = $request->validate([
            'products_name' => 'required|unique:products',
        ],[
            'products_name.required' => 'يرجى ادخال المنتج',
            'products_name.unique'   => 'المنتج مسجل مسبقاً',
        ]);

            products::create([
                'products_name' => request('products_name'),
                'description'   => request('description'),
                'section_id'    => request('section_id'),
                'created_by'    => (Auth::user()->name),
            ]);
            session()->flash( 'Add' , 'تم أضافة المنتج بنجاح');
            return redirect('products');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request,[
            'products_name' => 'required|unique:products',
            'description'  => 'required|unique:products',
        ],[
            'products_name.required' => 'يرجى تعديل المنتج',
            'products_name.unique'   => 'المنتج مسجل مسبقاً',
            'description.unique'  => 'الملاحظات مسجلة مسبقاً',
        ]);



        $id = sections::where('section_name', $request->section_name)->first()->id;

        $Products = Products::findOrFail($request->pro_id);
        $Products->update([
        'products_name' => $request->products_name,
        'description' => $request->description,
        'section_id' => $id,
        ]);
        session()->flash('edit', 'تم تعديل المنتج بنجاح');
        return redirect('products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->pro_id;
        products::findOrFail($id)->delete();
        session()->flash( 'delete' , 'تم حذف المنتج بنجاح');
        return redirect('products');
    }
}
