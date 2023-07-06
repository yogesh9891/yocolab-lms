<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Studymaterial;

class StudyMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = StudyMaterial::with('teacher')->get();
      return view('admin.material.index',compact('datas'));
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
        $data = StudyMaterial::with('teacher')->find($id);
      return view('admin.material.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
            $data  =  StudyMaterial::find($id); 

             $data->title = $request->title;
        
            if($request->hasFile('file')){

             $imageName = time().'.'.request()->file->getClientOriginalExtension();

                request()->file->move(public_path('storage/material'), $imageName);

                 
                 $data->file = $imageName;
            }

            

            $data->save();

              return redirect()->back()->with('flash_message','StudyMaterial is Updated successfully'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        StudyMaterial::destroy($id);

        return redirect()->back()->with('flash_message','StudyMaterial is Updated successfully'); 
    }

}
