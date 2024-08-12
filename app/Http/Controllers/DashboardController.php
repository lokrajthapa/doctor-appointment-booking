<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

 public function index()
 {
    $numberOfDoctors=User::where('user_type','doctor')->get()->count();

     return view('dashboard',compact('numberOfDoctors'));
 }

  public function  myAppointment()
  {

      $userId=Auth::user()->id;
      $my_appointments=Appointment::where('user_id',$userId)->get();
      return view('appointments.my-appointments',compact('my_appointments'));

   }

}
