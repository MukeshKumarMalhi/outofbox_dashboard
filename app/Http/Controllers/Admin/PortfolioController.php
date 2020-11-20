<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use DB;
use App\Models\Category;
use App\Models\Industry;
use App\Models\Portfolio;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $categories = Category::all();
      $industries = Industry::all();
      $portfolios = Portfolio::orderBy('updated_at','DESC')->paginate(10);
      if (request()->ajax()) {
        $view = view('admins.portfolios_listing', ['portfolios' => $portfolios]);
        return Response()->json(['status' => 'ok', 'listing' => $view->render()]);
      }
      return view('admins.view_portfolios', ['portfolios' => $portfolios, 'industries' => $industries, 'categories' => $categories]);
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
        'title' => 'required',
        'category_id' => 'required',
        'industry_id' => 'required',
      );

      $error = Validator::make($request->all(), $rules);
      if($error->fails()){
        return response()->json(['errors' => $error->errors()->all()]);
      }else{
        $id = uniqid();
        $image_array = array();
        $images_path = "";
        if($request->has('images')){
          $files = $request->file('images');
          foreach ($files as $file) {
            $file1=$file->store('public');
            $image=Storage::get($file1);
            Storage::put($file1,$image);
            $image_path=explode('/', $file1);
            array_push($image_array, $image_path[1]);
          }
        }

        if(count($image_array) > 0){
          $images_path = implode(",",$image_array);
        }
        $form_data = array(
          'id' => $id,
          'category_id' => $request->category_id,
          'industry_id' => $request->category_id,
          'title' => $request->title,
          'sub_title' => $request->sub_title,
          'body_text' => $request->body_text,
          'images' => $images_path,
        );
        $portfolio = Portfolio::create($form_data);
        return response()->json($portfolio, 200);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
