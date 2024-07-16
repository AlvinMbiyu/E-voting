<?php

namespace App\Http\Controllers;

use App\Models\Admin as ModelsAdmin;
use App\Models\Candidate;
use App\Models\Voter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Admin extends Controller
{
    //

    public function create()
    {
        return view('adminregister');
    }
    public function authRegister(Request $request)
    {


        $voter = new ModelsAdmin();
        $voter->id = $request->National_id;
        $voter->username = $request->Username;
        $voter->firstname = $request->FirstName;
        $voter->lastname = $request->Lastname;
        $voter->password = Hash::make($request->password);
        $voter->save();

        Auth::guard('admin')->login($voter);

        return redirect('admin/login')->with('status', "Your account is created successfully.");
    }

    public function login()
    {
        return view('adminlogin');
    }

    public function auth(Request $request)
    {
        // Validate the form data
        $credentials =  $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        if (Auth::guard('admin')->attempt($credentials)) {
            $admin = Auth::guard('admin')->user();
            return redirect('admin/dashboard');

            // Failed login
            return redirect('admin/login')->withErrors([
                'username' => 'Invalid username or password',
            ]);
        }
    }

    public function adminDashboard()
    {
        $voters = Voter::all(); // Fetch all voters
        $candidates = Candidate::all();
        return view('layouts.navigation', compact('voters', 'candidates'));
    }
    
    

    public function votersCount()
    {
        return Voter::all();
    }

    public function candidatesCount()
    {
        return Candidate::all();
    }
}
