<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Category;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = Blog::all();
        $categories = Category::where('parent_id',0)->get();
        return view('admin.blog.index',compact('data','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $categories = Category::where('parent_id',0)->get();
        return view('admin.blog.create',compact('categories'));
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

            $blog = new Blog();
        

            $blog->title = $request->title;
            $blog->category_id = $request->category_id;
            $blog->description = $request->description;
            $blog->slug = str_slug($request->title);
            $blog->author = $request->author;
            $blog->meta_title = $request->meta_title;
            $blog->meta_keword = $request->meta_keword;
            $blog->meta_description = $request->meta_description;


            if($request->hasFile('image')){

                $imageName = time().'.'.request()->image->getClientOriginalExtension();

                request()->image->move(public_path('storage/blog'), $imageName);;

                $blog->image = $imageName;
            }



            $blog->save();

            return redirect()->route('blog.index')->with('flash_message','Blog Added Successfully');

        }
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
        $data = Blog::find($id);
         $categories = Category::where('parent_id',0)->get();
        return view('admin.blog.edit',compact('data','categories'));
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

            $blog = Blog::find($id);
         

            $blog->title = $request->title;
                   $blog->category_id = $request->category_id;
            $blog->description = $request->description;
             $blog->slug = str_slug($request->title);
            $blog->author = $request->author;
               $blog->meta_title = $request->meta_title;
            $blog->meta_keword = $request->meta_keword;
            $blog->meta_description = $request->meta_description;


            if($request->hasFile('image')){

                $imageName = time().'.'.request()->image->getClientOriginalExtension();

                request()->image->move(public_path('storage/blog'), $imageName);


                $blog->image = $imageName;
            }



            $blog->save();

            return redirect()->route('blog.index')->with('flash_message','Blog is Updated successfully');

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
        $blog = Blog::destroy($id);

        return redirect()->route('blog.index')->with('flash_message','Blog is deleted successfully');
    }


    public function blogStatus(Request $request)
    {
        $id = $request->id;
        $data = Blog::find($id);
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
