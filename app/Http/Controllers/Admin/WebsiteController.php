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
use App\Models\Website;

class WebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $websites = Website::orderBy('updated_at','DESC')->paginate(10);
      if (request()->ajax()) {
        $view = view('admins.websites_listing', ['websites' => $websites]);
        return Response()->json(['status' => 'ok', 'listing' => $view->render()]);
      }
      return view('admins.view_websites', ['websites' => $websites]);
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
        'website_name' => 'required',
        'website_slug' => 'required',
        'website_url' => 'required'
      );

      $error = Validator::make($request->all(), $rules);
      if($error->fails()){
        return response()->json(['errors' => $error->errors()->all()]);
      }else{
        $id = uniqid();
        $form_data = array(
          'id' => $id,
          'website_name' => $request->website_name,
          'website_slug' => $request->website_slug,
          'website_url' => $request->website_url,
        );
        $website = Website::create($form_data);
        return response()->json($website, 200);
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
        'edit_website_name' => 'required',
        'edit_website_slug' => 'required',
        'edit_website_url' => 'required'
      );

      $error = Validator::make($request->all(), $rules);
      if($error->fails()){
        return response()->json(['errors' => $error->errors()->all()]);
      }else{
        $website = Website::find($request->edit_fid);
        $website->website_name = $request->edit_website_name;
        $website->website_slug = $request->edit_website_slug;
        $website->website_url = $request->edit_website_url;
        $website->save();

        return response()->json($website, 200);
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
      $website = Website::find($id)->delete();
      return response()->json("Website Deleted Succssfully", 200);
    }
}
