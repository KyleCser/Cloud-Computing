<?php

namespace App\Http\Controllers;

use App\Models\Scorecard;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Log;

class ScorecardController extends Controller
{	
    public function index()
    {
    	//
    }

    public function __construct()
	{
        $this->middleware('auth');
    }

	public function create() {
		return view('createScorecard');
	}

    public function show($id) 
    {	
        $scorecards = DB::table('scorecards')->where('user_id', $id)->get();
        $results = array();

        if ($scorecards != null) {
            foreach ($scorecards as $key => $value) {
                $result = unserialize($value->{'results'});
                
                array_push($results, $result);
            }
        } else { 
            $results = null;
        }
        
        return view('scorecard', compact('results'));
	}

    public function store(Request $request)
    {
        $user = Auth::user();
        $results = $request['results'];

        $scorecard = new Scorecard();
        $scorecard->results = serialize($results);
        $scorecard->user_id = $user->id;

        $scorecard->save();
        
        return view('welcome');
    }
}
