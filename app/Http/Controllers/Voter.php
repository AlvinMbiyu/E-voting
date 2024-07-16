<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\Vote;
use App\Models\Voter as ModelsVoter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Voter extends Controller
{
    //

    public function create()
    {
        return view('voterregister');
    }
    public function authRegister(Request $request)
    {


        $voter = new ModelsVoter();
        $voter->id = $request->National_id;
        $voter->firstname = $request->FirstName;
        $voter->lastname = $request->Lastname;
        $voter->county_id = $request->County;
        $voter->password = Hash::make($request->password);
        $voter->save();

        Auth::guard('voter')->login($voter);

        return redirect('voter/login')->with('status', "Your account is created successfully.");
    }

    public function login()
    {
        return view('voterlogin');
    }

    public function auth(Request $request)
    {
        // Validate the form data
        $credentials =  $request->validate([
            'id' => 'required',
            'password' => 'required',
        ]);
        if (Auth::guard('voter')->attempt($credentials)) {
            $voter = Auth::guard('voter')->user();
            return redirect('voter/dashboard');

            // Failed login
            return redirect('voter/login')->withErrors([
                'id' => 'Invalid ID or password',
            ]);
        }
    }

    public function voterDashboard()
    {
        $voter = Auth::guard('voter')->user();
        $title = config('app.election_title', ' 2027 Election');

        $votes = Vote::where('voters_id', Auth::guard('voter')->user()->id)->get();

        $positions = Position::orderBy('priority', 'asc')->with('candidates')->get();

        return view('voterdashboard', ['title' => $title, 'votes' => $votes, 'positions' => $positions]);
    }



    public function vote(Request $request)
    {
        $request->validate([
            'candidate_id' => 'required|exists:candidates,id',
        ]);

        $voterId = Auth::guard('voter')->user()->id;
        $candidateId = $request->input('candidate_id');

        // Check if the voter has already voted for this candidate
        $existingVote = Vote::where('voters_id', $voterId)
                            ->where('candidate_id', $candidateId)
                            ->first();

        if ($existingVote) {
            return redirect()->back()->withErrors(['message' => 'You have already voted for this candidate.']);
        }

        // Create a new vote
        Vote::create([
            'voters_id' => $voterId,
            'candidate_id' => $candidateId,
        ]);

        return redirect()->route('voter.dashboard')->with('success', 'Your vote has been cast successfully.');
    }
}
