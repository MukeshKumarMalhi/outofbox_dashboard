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
use App\Models\Page;
use App\Models\BuildingBlock;
use App\Models\Layout;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        'page_name' => 'required'
      );

      $error = Validator::make($request->all(), $rules);
      if($error->fails()){
        return response()->json(['errors' => $error->errors()->all()]);
      }else{
        $id = uniqid();
        $form_data = array(
          'id' => $id,
          'website_id' => $request->website_id,
          'parent_page_id' => $request->parent_page_id,
          'page_name' => $request->page_name
        );
        $page = Page::create($form_data);
        return response()->json($page, 200);
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
      $page = Page::find($id);
      $blocks = BuildingBlock::orderBy('updated_at', 'DESC')->get()->toArray();
      // $blocks = BuildingBlock::where('page_id','=', $id)->orderBy('updated_at', 'DESC')->paginate(10);
      return view('admins.show_page', ['page' => $page, 'blocks' => $blocks]);
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
        'edit_page_name' => 'required'
      );

      $error = Validator::make($request->all(), $rules);
      if($error->fails()){
        return response()->json(['errors' => $error->errors()->all()]);
      }else{
        $page_id = Page::find($request->edit_fid);
        $page_id->page_name = $request->edit_page_name;
        $page_id->parent_page_id = $request->edit_parent_page_id;
        $page_id->save();

        $page = DB::table('pages')
        ->leftjoin('pages as parents', 'parents.id', '=', 'pages.parent_page_id')
        ->select('pages.*', 'parents.page_name as parent_page_name', 'parents.id as parent_page_id')
        ->where('pages.id', $page_id->id)
        ->where('pages.website_id', $request->website_id)
        ->first();

        return response()->json($page, 200);
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
      $page = Page::find($id)->delete();
      return response()->json("Page Deleted Succssfully", 200);
    }
}
