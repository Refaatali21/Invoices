<?php

namespace App\Http\Controllers;

use App\Models\Sections;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $all_section = Sections::all();
        return view('Sections.Sections', ['all_section' => $all_section]);
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
            'section_name' => 'required|unique:sections',
        ],[
            'section_name.required' => 'يرجى ادخال القسم',
            'section_name.unique'   => 'القسم مسجل مسبقاً',
        ]);

            Sections::create([
                'section_name' => request('section_name'),
                'description'  => request('description'),
                'created_by'   => (Auth::user()->name),
            ]);
            session()->flash( 'Add' , 'تم أضافة القسم بنجاح');
            return redirect('Sections');
        }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function show(Sections $sections)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function edit(Sections $sections)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request,[
            'section_name' => 'required|unique:sections',
            'description'  => 'required|unique:sections',
        ],[
            'section_name.required' => 'يرجى تعديل القسم',
            'section_name.unique'   => 'القسم مسجل مسبقاً',
            'description.unique'  => 'الملاحظات مسجلة مسبقاً',
        ]);

        $id = $request->id;
        $Sections = Sections::find($id);
        $Sections->update([
            'section_name' => $request->section_name,
            'description'  => $request->description,
        ]);
        session()->flash( 'edit' , 'تم تعديل القسم بنجاح');
        return redirect('Sections');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        Sections::find($id)->delete();
        session()->flash( 'delete' , 'تم حذف القسم بنجاح');
        return redirect('Sections');
    }
}
