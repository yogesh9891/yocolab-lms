<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::where('parent_id',0)->with('subcategory')->get();
        return view('admin.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          $categories = Category::where('parent_id',0)->get();
        return view('admin.category.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->isMethod('post')){

            $category = new Category;

           $request->validate([
                    'name' => 'required',
                    'image' => 'image|dimensions:width=307,height=160',
                ],['image.dimensions' =>'Images must be 307 X 160']);

             $slug=preg_replace('/[^A-Za-z0-9-]+/', '-', $request->name);
            $category->name = $request->name;
            $category->parent_id = $request->parent_id;
            $category->slug = $slug;
            if($request->hasFile('image')){

                 $imageName = time().'.'.request()->image->getClientOriginalExtension();

                request()->image->move('storage/img/category', $imageName);;
                 
                 $category->image = $imageName;
            }

            $category->save();

        }

          return redirect()->route('category.create')->with('flash_message','Categroy is create successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categories = Category::where('parent_id',$id)->with('subcategory')->get();
        return view('admin.category.index',compact('categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $category  = Category::with('subcategory')->find($id);

        $categories = Category::where('parent_id',0)->get();

        return view('admin.category.edit',compact('category','categories'));
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
          if($request->isMethod('put')){
      

        $category = Category::find($id);


         $request->validate([
                    'name' => 'required',
                    'image' => 'image|dimensions:width=307,height=160',
                ],['image.dimensions' =>'Images must be 307 X 160']);

         $slug=preg_replace('/[^A-Za-z0-9-]+/', '-', $request->name);
        $category->name = $request->name;
        $category->parent_id = $request->parent_id;
        $category->slug = $slug;

        if($request->hasFile('image')){


                 $imageName = time().'.'.request()->image->getClientOriginalExtension();

                request()->image->move('storage/img/category', $imageName);;
                 
                 $category->image = $imageName;
                 
                 if(!empty($request->oldimage)) {
                      $old_path = public_path('storage/img/category/'.$request->oldimage);

                    unlink($old_path);
                 }

                
            }

          

            $category->save();

            return redirect()->route('category.index')->with('flash_message','Categroy is update successfully');

       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
          $category = Category::find($id);

      
         if(!empty($category->image)){

               $old_path = public_path('storage/img/category/'.$category->image);

                    unlink($old_path);
         }

        $category->destroy($id);

         return redirect()->route('category.index')->with('flash_message','Categroy is delete successfully');
    }


         public function categoryStatus(Request $request)
    {
        $id = $request->id;
        $data = Category::find($id);
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

           public function categoryTop(Request $request)
    {
        $id = $request->id;
        $data = Category::find($id);
        if($data->top==1)
        {
            $data->top = 0;
        }
        else
        {
            $data->top = 1;
        }
        $data->update();
    }
}
