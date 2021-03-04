<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use\App\Blogs;

class blogController extends Controller

{

    public function show () {
        $blogs = Blogs::all();

        return view ('blog')->with("blogs", $blogs);
    }


    public function index () {
        $blogs = Blogs::all();

        return view ('aadmin')->with("blogs", $blogs);
    }


    public function store(Request $request) {

        $validateData = request()->validate([
            'title'=>'required|alpha_spaces|min:8|max:20|',
            'description'=>'required|min:30|max:255||',
            'date'=>'required',
            'image'=>'required',
        ]);
         $blogs = new Blogs();

         $blogs->title = $request->input('title');
         $blogs->description = $request->input('description');
         $blogs->date = $request->input('date');
         $blogs->category = $request->input('category');

         if($request->hasfile('image')){
         $file = $request->file('image');
         $filerealname = $file->getClientOriginalName(); // getting image extension
         $filename =$filerealname;
         $file->move('uploads/blogs/',$filename);
         $blogs->image = $filename;
         } else{
             return $request;
             $blogs->image='';
         }
         $blogs->save();

        return redirect('aaddblog')->with('success' , 'Added successfully! ');

     }

     public function edit ($id) {
        $blogs = Blogs::find($id);
        return view('editblogs')->with('blogs',$blogs);
    }


     public function update(Request $request, $id) {
        $validateData = request()->validate([
            'title'=>'required|alpha_spaces|min:8|max:20|',
            'description'=>'required|min:30|max:255||',
            'date'=>'required',
            'image'=>'required',
        ]);

         $blogs =  Blogs::find($id);

         $blogs->title = $request->input('title');
         $blogs->description = $request->input('description');
         $blogs->date = $request->input('date');
         $blogs->category = $request->input('category');

         if($request->hasfile('image')){
         $file = $request->file('image');
         $extension = $file->getClientOriginalExtension(); // getting image extension
         $filename =time().'.'.$extension;
         $file->move('uploads/blogs/',$filename);
         $blogs->image = $filename;
         } else{
             return $request;
             $blogs->image='';
         }
         $blogs->save();

        return redirect('aadmin')->with('success' , 'Updated successfully! ');

     }

     public function destroy ($id) {
        $blogs = Blogs::destroy($id);
        return redirect('/aadmin')->with('error' ,'', 'Deleted succesfully! ');
    }



}
