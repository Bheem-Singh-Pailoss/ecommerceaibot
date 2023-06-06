<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
   public function userdashboard(){
    return view('Frontend.dashboard');
   }



   public function Homepage(){
    return view('welcome');
   }
}
