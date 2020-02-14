<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Team;
use App\Match;

class MatchesController extends Controller
{
    // Lists all teams available in the system
    public function index()
    {

    }

    // Displays the players and match-ups of a team as selected by user
    public function show($id)
    {
        if(!isset($id)) {
            return redirect()->intended('/teams')->with('error', 'No team found with this id');
        }
        $match = Match::with('team1', 'team2', 'players')->where('id', $id)->first();
        dd($match);

        if(!isset($match)) {
            return redirect()->intended('/teams')->with('error', 'No match found with this id');
        }

        $matches = Match::with('team1', 'team2')->where('team_id_1', $id)->orWhere('team_id_2', $id)->get();

        //dd($matches);
        return view('teams.show', ['matches' => $matches, 'team' => $team]);
    }
}
