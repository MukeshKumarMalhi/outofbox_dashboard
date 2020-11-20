<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use DB;
use App\Models\Industry;

class IndustryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $industries = Industry::orderBy('updated_at','DESC')->paginate(10);
      if (request()->ajax()) {
        $view = view('admins.industries_listing', ['industries' => $industries]);
        return Response()->json(['status' => 'ok', 'listing' => $view->render()]);
      }
      return view('admins.view_industries', ['industries' => $industries]);
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
        'industry_name' => 'required',
        'industry_icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
      );

      $error = Validator::make($request->all(), $rules);
      if($error->fails()){
        return response()->json(['errors' => $error->errors()->all()]);
      }else{
        $id = uniqid();
        if($request->hasFile('industry_icon')){
          $file=$request->file('industry_icon')->store('public');
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
          'industry_name' => $request->industry_name,
          'industry_icon' => $image_path
        );
        $industry = Industry::create($form_data);
        return response()->json($industry, 200);
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
        'edit_industry_name' => 'required'
      );

      $error = Validator::make($request->all(), $rules);
      if($error->fails()){
        return response()->json(['errors' => $error->errors()->all()]);
      }else{
        if($request->hasFile('edit_industry_icon')){
          $file=$request->file('edit_industry_icon')->store('public');
          $image=Storage::get($file);
          Storage::put($file,$image);
          $image_path=explode('/', $file);
          $image_path=$image_path[1];
          $industry_image = Industry::find($request->edit_fid);
          $industry_image->industry_icon = $image_path;
          $industry_image->save();
        }
        $industry = Industry::find($request->edit_fid);
        $industry->industry_name = $request->edit_industry_name;
        $industry->save();

        return response()->json($industry, 200);
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
      $category = Industry::find($id)->delete();
      return response()->json("Industry Deleted Succssfully", 200);
    }
}
