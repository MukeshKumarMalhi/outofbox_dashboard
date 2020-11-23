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
use App\Models\PortfolioImage;

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
      $portfolios = DB::table('portfolios')
                    ->leftJoin('categories', 'categories.id', '=', 'portfolios.category_id')
                    ->leftJoin('industries', 'industries.id', '=', 'portfolios.industry_id')
                    ->select('portfolios.*', 'categories.category_name', 'industries.industry_name')
                    ->orderBy('updated_at','DESC')
                    ->paginate(10);
                    foreach ($portfolios as $key => $value) {
                      $images = PortfolioImage::where('portfolio_id', '=', $value->id)->get()->toArray();
                      $value->images = $images;
                    }

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

        $form_data = array(
          'id' => $id,
          'category_id' => $request->category_id,
          'industry_id' => $request->industry_id,
          'title' => $request->title,
          'sub_title' => $request->sub_title,
          'body_text' => $request->body_text
        );
        $portfolio = Portfolio::create($form_data);

        if($request->has('images')){
          $files = $request->file('images');
          foreach ($files as $file) {
            $name=$file->getClientOriginalName();
            $file1=$file->store('public');
            $image=Storage::get($file1);
            Storage::put($file1,$image);
            $image_path=explode('/', $file1);
            $image_path=$image_path[1];
            $type=$file->getClientOriginalExtension();
            $size=$file->getSize();
            $image_id = uniqid();

            $image = new PortfolioImage();
            $image->id = $image_id;
            $image->portfolio_id = $id;
            $image->image_url = $image_path;
            $image->image_name = $name;
            $image->image_type = $type;
            $image->image_size = $size;
            $image->save();
          }
        }
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
      $categories = Category::all();
      $industries = Industry::all();
      $portfolio = Portfolio::find($id);
      $images = PortfolioImage::where('portfolio_id', '=', $id)->get()->toArray();
      $portfolio->images = $images;
      return view('admins.edit_portfolio', ['portfolio' => $portfolio, 'industries' => $industries, 'categories' => $categories]);
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
      $portfolio = Portfolio::find($id);
      $portfolio->category_id = $request->category_id;
      $portfolio->industry_id = $request->industry_id;
      $portfolio->title = $request->title;
      $portfolio->sub_title = $request->sub_title;
      $portfolio->body_text = $request->body_text;
      $portfolio->save();

      if($request->has('images')){
        $files = $request->file('images');
        foreach ($files as $file) {
          $name=$file->getClientOriginalName();
          $file1=$file->store('public');
          $image=Storage::get($file1);
          Storage::put($file1,$image);
          $image_path=explode('/', $file1);
          $image_path=$image_path[1];
          $type=$file->getClientOriginalExtension();
          $size=$file->getSize();
          $image_id = uniqid();

          $image = new PortfolioImage();
          $image->id = $image_id;
          $image->portfolio_id = $id;
          $image->image_url = $image_path;
          $image->image_name = $name;
          $image->image_type = $type;
          $image->image_size = $size;
          $image->save();
        }
      }

      return response()->json($portfolio, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $portfolio = Portfolio::find($id)->delete();
      return response()->json("Portfolio Deleted Succssfully", 200);
    }

    public function delete_portfolio_image(Request $request)
    {
      $portfolio = PortfolioImage::find($request->id)->delete();
      return response()->json("Portfolio Image Deleted Succssfully", 200);
    }


}
