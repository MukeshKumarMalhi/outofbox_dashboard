<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use DB;
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
        $categories = Category::orderBy('updated_at','DESC')->paginate(10);
        if (request()->ajax()) {
          $view = view('admins.categories_listing', ['categories' => $categories]);
          return Response()->json(['status' => 'ok', 'listing' => $view->render()]);
        }
        return view('admins.view_categories', ['categories' => $categories]);
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
      $rules = array(
        'category_name' => 'required',
        'category_icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
      );

      $error = Validator::make($request->all(), $rules);
      if($error->fails()){
        return response()->json(['errors' => $error->errors()->all()]);
      }else{
        $id = uniqid();
        if($request->hasFile('category_icon')){
          $file=$request->file('category_icon')->store('public');
          $image=Storage::get($file);
          Storage::put($file,$image);
          $image_path=explode('/', $file);
          $image_path=$image_path[1];
        }
        else{
          $image_path="";
        }
        $form_data = array(
          'id' => $id,
          'category_name' => $request->category_name,
          'category_icon' => $image_path
        );
        $category = Category::create($form_data);
        return response()->json($category, 200);
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
        //
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
      $rules = array(
        'edit_category_name' => 'required'
      );

      $error = Validator::make($request->all(), $rules);
      if($error->fails()){
        return response()->json(['errors' => $error->errors()->all()]);
      }else{
        if($request->hasFile('edit_category_icon')){
          $file=$request->file('edit_category_icon')->store('public');
          $image=Storage::get($file);
          Storage::put($file,$image);
          $image_path=explode('/', $file);
          $image_path=$image_path[1];
          $category_image = Category::find($request->edit_fid);
          $category_image->category_icon = $image_path;
          $category_image->save();
        }
        $category = Category::find($request->edit_fid);
        $category->category_name = $request->edit_category_name;
        $category->save();

        return response()->json($category, 200);
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
      $category = Category::find($id)->delete();
      return response()->json("Category Deleted Succssfully", 200);
    }
}
