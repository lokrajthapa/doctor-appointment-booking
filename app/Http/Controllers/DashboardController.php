<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

 public function index()
 {
    $numberOfDoctors=User::where('user_type','doctor')->get()->count();

     return view('dashboard',compact('numberOfDoctors'));
 }

}
