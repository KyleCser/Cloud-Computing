<?php

namespace App\Http\Controllers;

use App\Models\Scorecard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $scorecard = Scorecard::find($id);
        return view('scorecard', compact('scorecard'));
	}

    public function store(Request $request)
    {
        $scorecard = new Scorecard();
        
        $scorecard->results = $request['results'];
        
        $scorecard->save();
        
        return redirect('scorecard');
    }
}
