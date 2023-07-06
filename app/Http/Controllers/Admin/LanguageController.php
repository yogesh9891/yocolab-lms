<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Language;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = language::all();;
        return view('admin.language.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('admin.language.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
           $data =  new Language;
       $data->name = $request->name;
       $data->value = $request->name;
    
       $data->save();
        return redirect()->back()->with('flash_message','Language is added successfully');
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
        $data = Language::find($id);
        return view('admin.language.edit',compact('data'));
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
        $data =   Language::find($id);
       $data->name = $request->name;
       $data->value = $request->name;
    
       $data->save();
        return redirect()->route('language.index')->with('flash_message','Language is updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         Language::destroy($id);
          return redirect()->back()->with('flash_message','Language is deleted successfully');
    }


    public function languageStatus(Request $request)
    {
        $id = $request->id;
        $data = Language::find($id);
        if($data->status==1)
        {
            $data->status = 0;
        }
        else
        {
            $data->status = 1;
        }
        $data->update();
    }
}
