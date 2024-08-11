<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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
    public function store(Request $request)
    {

        $request->validate([
            'department_id' => 'required|max:255',
            'doctor_id' => 'required',
            'appointment_time' => 'required',

        ]);
        $appointment = new Appointment([
            'user_id'=>$request->get('user_id'),
            'appointment_type' => $request->get('appointment_type'),
            'department_id' => $request->get('department_id'),
            'doctor_id' => $request->get('doctor_id'),
            'appointment_time' => $request->get('appointment_time'),
        ]);

        $appointment->save();

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
         $appointment->delete();

         return redirect('/appointments')->with('success', 'Appointment has been deleted');

    }
}
