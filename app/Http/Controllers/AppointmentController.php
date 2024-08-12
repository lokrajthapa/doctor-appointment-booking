<?php

namespace App\Http\Controllers;

use App\Http\Requests\appointment\AppointmentStoreRequest;
use App\Models\Appointment;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppointmentBookedEmail;
use Illuminate\Support\Facades\Gate;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $appointments = Appointment::all();
        return view('appointments.index', compact('appointments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
      $departments=  Department::with('doctors')->get();
      return view('appointments.create',compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AppointmentStoreRequest $request)
    {

        $appointment = new Appointment([
            'user_id'=>$request->get('user_id'),
            'appointment_type' => $request->get('appointment_type'),
            'department_name' => $request->get('department_name'),
            'doctor_name' => $request->get('doctor_name'),
            'appointment_time' => $request->get('appointment_time'),
        ]);

        $appointment->save();
        Mail::to(Auth::user())->queue(new AppointmentBookedEmail($appointment));
        return redirect('/appointments')->with('success', 'Appointments has booked');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $appointment = Appointment::find($id);

        Gate::authorize('delete',$appointment);
         $appointment->delete();

         return redirect('/appointments')->with('success', 'Appointment has been deleted');

    }
}
