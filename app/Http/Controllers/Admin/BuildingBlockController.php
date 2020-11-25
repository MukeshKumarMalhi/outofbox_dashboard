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

class BuildingBlockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $building_blocks = BuildingBlock::orderBy('updated_at','DESC')->paginate(10);
      if (request()->ajax()) {
        $view = view('admins.building_blocks_listing', ['building_blocks' => $building_blocks]);
        return Response()->json(['status' => 'ok', 'listing' => $view->render()]);
      }
      return view('admins.view_building_blocks', ['building_blocks' => $building_blocks]);
    }

    public function view_block_code($id)
    {
      $block = BuildingBlock::find($id);
      return view('admins.view_block_code', ['block' => $block]);
    }

    public function get_blocks_ajax()
    {
      $building_blocks = BuildingBlock::orderBy('updated_at','DESC')->get()->toArray();
      return response()->json($building_blocks, 200);
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
        'building_block_name' => 'required',
        'building_block_html_code' => 'required'
      );

      $error = Validator::make($request->all(), $rules);
      if($error->fails()){
        return response()->json(['errors' => $error->errors()->all()]);
      }else{
        $id = uniqid();
        $form_data = array(
          'id' => $id,
          'building_block_name' => $request->building_block_name,
          'building_block_html_code' => $request->building_block_html_code
        );
        $block = BuildingBlock::create($form_data);
        return response()->json($block, 200);
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
        'edit_building_block_name' => 'required'
      );

      $error = Validator::make($request->all(), $rules);
      if($error->fails()){
        return response()->json(['errors' => $error->errors()->all()]);
      }else{
        $block = BuildingBlock::find($request->edit_fid);
        $block->building_block_name = $request->edit_building_block_name;
        $block->building_block_html_code = $request->edit_building_block_html_code;
        $block->save();

        return response()->json($block, 200);
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
      $block = BuildingBlock::find($id)->delete();
      return response()->json("Block Deleted Succssfully", 200);
    }
}
