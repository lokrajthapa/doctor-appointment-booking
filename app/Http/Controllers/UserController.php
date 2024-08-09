<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
     // Display a listing of the resource.
     public function index()
     {
         $users = User::all();
         return view('users.index', compact('users'));
     }

     // Show the form for creating a new resource.
     public function create()
     {
         return view('users.create');
     }

     // Store a newly created resource in storage.
     public function store(Request $request)
     {
         $request->validate([
             'name' => 'required|string|max:255',
             'email' => 'required|string|email|max:255|unique:users',
             'password' => 'required|string|min:8',
             'user_type' => 'required|in:patient,doctor,admin',
         ]);

         $user = new User([
             'name' => $request->get('name'),
             'email' => $request->get('email'),
             'password' => bcrypt($request->get('password')),
             'user_type' => $request->get('user_type'),
             'age' => $request->get('age'),
             'profile_image' => $request->get('profile_image'),
             'address' => $request->get('address'),
             'phone' => $request->get('phone'),
             'gender' => $request->get('gender'),
         ]);

         $user->save();

         return redirect('/users')->with('success', 'User has been added');
     }

     // Display the specified resource.
    //  public function show($id)
    //  {
    //      $user = User::find($id);
    //      return view('users.show', compact('user'));
    //  }

     // Show the form for editing the specified resource.
     public function edit($id)
     {

         $user = User::find($id);
         return view('users.edit', compact('user'));
     }

     // Update the specified resource in storage.
     public function update(Request $request, $id)
     {



         $request->validate([
             'name' => 'required|string|max:255',
             'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            //   'user_type' => 'required|in:patient,doctor,admin',
             'age'=>'required|integer',
             'gender'=>'in:male,female,other'

         ]);

         $user = User::find($id);
         if ($request->hasFile('profile_image')) {

            if ($user->profile_image) {
                Storage::disk('public')->delete($user->profile_image);
            }

            // Store the uploaded image in the 'profile_images' directory in 'public' disk
            $path = $request->file('profile_image')->store('profile_images', 'public');

            // Save the new profile image path to the user
            $user->image = $path;
        }
         $user->name = $request->get('name');
         $user->email = $request->get('email');

         if ($request->filled('password')) {
             $user->password = bcrypt($request->get('password'));
         }
        //  $user->user_type = $request->get('user_type');
         $user->age = $request->get('age');
         $user->profile_image = $request->get('profile_image');
         $user->address = $request->get('address');
         $user->phone = $request->get('phone');
         $user->gender = $request->get('gender');

         $user->save();

         return redirect('/users')->with('success', 'User Profile  has been updated');
     }

     // Remove the specified resource from storage.
     public function destroy($id)
     {
         $user = User::find($id);
         $user->delete();

         return redirect('/users')->with('success', 'User has been deleted');
     }
}
