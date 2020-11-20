<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use DB;
use App\Models\User;
use DateTime;

class AdminController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('admin');
  }

  //////////////// dashboard ///////////////////
  public function admin_dashboard()
  {
      return view('admins.dashboard');
  }
  //////////////// dashboard end ///////////////////
}
