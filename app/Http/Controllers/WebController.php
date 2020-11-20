<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use DB;
use App\Models\User;

class WebController extends Controller
{
  public function __construct()
  {
    $this->middleware('guest')->except('logout');
  }

  public function admin_login()
  {
    return view('auth.login');
  }
}
